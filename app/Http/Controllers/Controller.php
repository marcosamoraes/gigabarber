<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\ClientHours;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function storageFile($file, $location = '')
    {
        if ($file->isValid()) {
            $name = $file->hashName();

            if (!$file->storeAs("public/$location", $name))
                throw new Exception("Falha ao salvar arquivo", 1);

            return "/storage/$location/$name";
        }
    }

    public function clientView($slug)
    {
        try {
            $client = Client::where('slug', $slug)->firstOrFail();
            $client->increment('views');
        } catch (Exception $e) {
            logError($e, false, ['slug' => $slug]);
            abort(404);
        }

        return view('index', compact('client'));
    }

    public function appointment(Request $request, $slug)
    {
        $whatsapp = $request->only('whatsapp');

        $client = Client::where('slug', $slug)->first();

        $user = User::where('client_uuid', $client->uuid)->where('whatsapp', $whatsapp)->first();

        if (!$user)
            return redirect(route('pre.register', [$slug, $whatsapp['whatsapp']]));

        return view('appointment', compact('client', 'user'));
    }

    public function preRegister($slug, $whatsapp)
    {
        $client = Client::where('slug', $slug)->first();
        return view('pre-register', compact('client', 'whatsapp'));
    }

    public function makePreRegister(StoreUserRequest $request, Client $client)
    {
        $validated = $request->safe()->all();
        $validated['active'] = 0;
        $validated['client_uuid'] = $client->uuid;

        try {
            User::create($validated);
        } catch (Exception $e) {
            logError($e, $validated);
            return back()->withErrors('Erro ao realizar pré cadastro, tente novamente.');
        }

        return redirect(route('index', $client->slug))->with('success', 'Pré cadastro realizado com sucesso. Aguarde o administrador aprovar.');
    }

    public function availableTimes(Request $request, $uuid, $date)
    {
        $user_uuid = $request->only('u');
        $client = Client::findOrFail($uuid);
        $date = new Carbon($date);
        $weekday = $this->getWeekdays($date->format('l'));

        $reserveds = Appointment::where('client_uuid', $client->uuid)->whereDate('date', $date)->get()->toArray();
        $reserveds = array_map(function ($reserved) {
            $time = new Carbon($reserved['date']);
            return $time->format('H:i');
        }, $reserveds);

        $reservedsUser = Appointment::where('client_uuid', $client->uuid)
            ->where('user_uuid', $user_uuid)
            ->whereDate('date', $date)
            ->get()
            ->toArray();
        $reservedsUser = array_map(function ($reservedUser) {
            $time = new Carbon($reservedUser['date']);
            return $time->format('H:i');
        }, $reservedsUser);

        $opening_hours = ClientHours::where('client_uuid', $client->uuid)->where('day', $weekday)->get()->toArray();
        $times = [];
        foreach ($opening_hours as $opening_hour) {
            $open_time = new Carbon($opening_hour['open_time']);
            $close_time = new Carbon($opening_hour['close_time']);

            while ($open_time < $close_time) {
                if (in_array($open_time->format('H:i'), $reservedsUser)) {
                    $times[] = [
                        'time' => $open_time->format('H:i'),
                        'reserved' => 2
                    ];
                } else {
                    $times[] = [
                        'time' => $open_time->format('H:i'),
                        'reserved' => in_array($open_time->format('H:i'), $reserveds) ? 1 : 0
                    ];
                }

                $open_time->addMinutes($client->attributes->time_interval);
            }
        }

        return response()->json($times);
    }

    public function getWeekdays($weekday)
    {
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

    public function makeAppointment(StoreAppointmentRequest $request, $user_uuid)
    {
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
    }

    public function cancelAppointment(Request $request, $user_uuid)
    {
        $date = new Carbon($request->date . ' ' . $request->time);
        $date = $date->format('Y-m-d H:i');

        try {
            $appointment = Appointment::where('user_uuid', $user_uuid)->where('date', $date)->first();
            $appointment->cancelAppointment();
            $appointment->delete();
            return response()->json(['message' => 'Agendamento cancelado com sucesso!'], 200);
        } catch (Exception $e) {
            logError($e, $request->all());
            return response()->json(['error' => 'Falha ao cancelar agendamento, tente novamente.'], 400);
        }
    }
}
