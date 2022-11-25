<?php

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\ClientHours;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $client = Client::inRandomOrder()->firstOrFail();
    return redirect(route('index', ['slug' => $client->slug]));
});
Route::get('/{slug}', function ($slug) {
    try {
        $client = Client::where('slug', $slug)->firstOrFail();
        $client->increment('views');
    } catch (Exception $e) {
        logError($e, false, ['slug' => $slug]);
        abort(404);
    }

    return view('index', compact('client'));
})->name('index');

Route::get('/{slug}/agendamento', function (Request $request, $slug) {
    $whatsapp = $request->only('whatsapp');

    $client = Client::where('slug', $slug)->first();

    $user = User::where('client_uuid', $client->uuid)->where('whatsapp', $whatsapp)->first();
    if (!$user)
        return back()->withErrors('Você precisa de um pré-cadastro feito pelo Administrador para realizar um agendamento.');

    return view('appointment', compact('client', 'user'));
})->name('appointment');

Route::get('/available-times/{uuid}/{date}', function ($uuid, $date) {
    $client = Client::findOrFail($uuid);
    $date = new Carbon($date);
    $weekday = getWeekdays($date->format('l'));

    $reserveds = Appointment::where('client_uuid', $client->uuid)->whereDate('date', $date)->get()->toArray();
    $reserveds = array_map(function ($reserved) {
        $time = new Carbon($reserved['date']);
        return $time->format('H:i');
    }, $reserveds);

    $opening_hours = ClientHours::where('client_uuid', $client->uuid)->where('day', $weekday)->get()->toArray();
    $times = [];
    foreach ($opening_hours as $opening_hour) {
        $open_time = new Carbon($opening_hour['open_time']);
        $close_time = new Carbon($opening_hour['close_time']);

        while ($open_time < $close_time) {
            if (!in_array($open_time->format('H:i'), $reserveds))
                $times[] = $open_time->format('H:i');

            $open_time->addMinutes(30);
        }
    }

    return response()->json($times);
});

function getWeekdays($weekday) {
    switch ($weekday) {
        case 'Monday':
            return 'segunda';
        case 'Tuesday':
            return 'terça';
        case 'Wednesday':
            return 'quarta';
        case 'Thursday':
            return 'quinta';
        case 'Friday':
            return 'sexta';
        case 'Saturday':
            return 'sábado';
        case 'Sunday':
            return 'domingo';
    }
}

Route::post('/agendar/{user_uuid}', function (StoreAppointmentRequest $request, $user_uuid) {
    $validated = $request->safe()->all();
    $validated['services'] = array_unique(json_decode($validated['services'], true));
    $validated['services'] = json_encode($validated['services']);
    $validated['date'] = new Carbon($validated['date'] . ' ' . $validated['time']);
    $validated['date'] = $validated['date']->format('Y-m-d H:i');
    unset($validated['time']);

    try {
        DB::transaction(function () use ($validated, $user_uuid) {
            $client = Client::findOrFail($validated['uuid']);
            $user = User::findOrFail($user_uuid);
            unset($validated['uuid']);
            $validated['client_uuid'] = $client->uuid;
            $validated['user_uuid'] = $user->uuid;

            $appointment = Appointment::create($validated);
            $appointment->sendNewAppointment();
        });

        return response()->json(['message' => 'Agendamento realizado com sucesso!'], 201);
    } catch (Exception $e) {
        logError($e, $request->all(), ['uuid' => $validated['uuid']]);
        return response()->json(['error' => 'Falha ao realizar agendamento, tente novamente.'], 400);
    }
})->name('make.appointment');
