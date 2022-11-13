<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
  public function dashboard()
  {
    return view('admin.dashboard');
  }
}
