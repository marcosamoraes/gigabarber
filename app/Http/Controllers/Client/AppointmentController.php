<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
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
        $appointments = Appointment::where('client_uuid', Auth::id())->get();
        return view('client.appointments.index', compact('appointments'));
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
