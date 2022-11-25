<?php

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\User;
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

    $user = User::where('whatsapp', $whatsapp)->first();
    if (!$user)
        return back()->withErrors('Você precisa de um pré-cadastro feito pelo Administrador para realizar um agendamento.');

    return view('appointment', compact('client', 'user'));
})->name('appointment');

Route::post('/{uuid}', function (StoreAppointmentRequest $request, $uuid) {
    $validated = $request->safe()->all();

    try {
        DB::transaction(function () use ($uuid, $validated) {
            $client = Client::findOrFail($uuid);
            $user = User::updateOrCreate(['cpf' => $validated['user']['cpf']], $validated['user']);

            $validated['client_uuid'] = $client->uuid;
            $validated['user_uuid'] = $user->uuid;

            $appointment = Appointment::create($validated);
            $appointment->sendNewAppointment();
        });

        return response()->json(['Agendamento realizado com sucesso!'], 201);
    } catch (Exception $e) {
        logError($e, $request->all(), ['uuid' => $uuid]);
        return response()->json(['error' => 'Falha ao realizar agendamento, tente novamente.'], 400);
    }
})->name('make.appointment');
