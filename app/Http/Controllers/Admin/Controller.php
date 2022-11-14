<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Http\Request;

class Controller extends BaseController
{
  public function dashboard()
  {
    $totalClients = Client::count();
    $totalServices = Service::count();
    $totalViews = Client::sum('views');
    $totalAppointments = Appointment::count();
    return view('admin.dashboard', compact('totalClients', 'totalServices', 'totalViews', 'totalAppointments'));
  }
}
