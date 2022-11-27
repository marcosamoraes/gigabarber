<?php

namespace App\Http\Controllers\Client;

use App\Models\Appointment;
use App\Models\ClientHours;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::where('client_uuid', Auth::id())
            ->whereDate('date', '>=', today())
            ->orderBy('date', 'asc')
            ->get();
        return view('client.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('client_uuid', Auth::id())->get()->toArray();
        $appointments = Appointment::where('client_uuid', Auth::id())->get()->toArray();

        $reserveds = array_map(function($appointment) {
            $dates = explode(' ', $appointment['date']);
            return [
                'date' => $dates[0],
                'time' => \Carbon\Carbon::createFromFormat('H:i:s',$dates[1])->format('H:i')
            ];
        }, $appointments);

        $times = [];
        $open_time = new Carbon('8:00');
        $close_time = new Carbon('23:00');

        while ($open_time < $close_time) {
            $times[] = $open_time->format('H:i');

            $open_time->addMinutes(Auth::user()->attributes->time_interval);
        }

        return view('client.appointments.create', compact('users', 'reserveds', 'times'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_uuid' => ['required', 'exists:users,uuid'],
            'date.0' => ['required', 'date'],
            'date.1' => ['required'],
        ]);

        $validated['date'] = implode(' ', $validated['date']);

        try {
            $validated['client_uuid'] = Auth::id();
            Appointment::create($validated);
            return redirect(route('client.appointments.index'))->with('success', 'Agendamento criado com sucesso!');
        } catch (Exception $e) {
            logError($e, $validated);
            return back()->withErrors('Erro ao cadastrar agendamento, tente novamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        try {
            $appointment->delete();
            return back()->with('success', 'Agendamento deletado com sucesso!');
        } catch (Exception $e) {
            logError($e);
            return back()->withErrors('Erro ao deletar agendamento, tente novamente.');
        }
    }

    public function calendar()
    {
        return view('client.appointments.calendar');
    }

    public function calendarTimes($date)
    {
        $date = new Carbon($date);
        $weekday = $this->getWeekdays($date->format('l'));

        $reserveds = Appointment::where('client_uuid', Auth::id())
            ->with(['user'])
            ->whereDate('date', $date)->get()->toArray();

        $reserveds = array_map(function ($reserved) {
            $time = new Carbon($reserved['date']);

            return [
                'time' => $time->format('H:i'),
                'user' => explode(' ', $reserved['user']['name'])[0],
                'whatsapp' => $reserved['user']['whatsapp'],
                'link' => preg_replace('/[^0-9]/', '', $reserved['user']['whatsapp'])
            ];
        }, $reserveds);

        $opening_hours = ClientHours::where('client_uuid', Auth::id())->where('day', $weekday)->get()->toArray();
        $times = [];
        foreach ($opening_hours as $opening_hour) {
            $open_time = new Carbon($opening_hour['open_time']);
            $close_time = new Carbon($opening_hour['close_time']);

            while ($open_time < $close_time) {
                $reservedKey = null;

                foreach ($reserveds as $key => $reserved) {
                    if ($open_time->format('H:i') == $reserved['time']) {
                        $reservedKey = $key;
                        break;
                    }
                }

                if ($reservedKey !== null) {
                    $times[] = [
                        'time' => $open_time->format('H:i'),
                        'user' => $reserveds[$reservedKey]['user'],
                        'whatsapp' => $reserveds[$reservedKey]['whatsapp'],
                        'link' => $reserveds[$reservedKey]['link']
                    ];
                } else {
                    $times[] = [
                        'time' => $open_time->format('H:i'),
                        'user' => false,
                        'whatsapp' => false
                    ];
                }

                $open_time->addMinutes(Auth::user()->attributes->time_interval);
            }
        }

        return response()->json($times);
    }
}
