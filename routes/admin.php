<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\Controller;
use App\Http\Controllers\Admin\ClientController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', function() { return view('admin.login'); })->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
});
Route::middleware(['auth:admin'])->group(function () {
  Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');
  Route::resource('clients', ClientController::class);
  Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
