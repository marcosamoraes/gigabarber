<?php

namespace App\Http\Controllers\Client;

use App\Models\Appointment;
use App\Models\User;
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

        return view('client.appointments.create', compact('users', 'reserveds'));
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
}
