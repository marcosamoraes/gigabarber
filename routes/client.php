<?php

use App\Http\Controllers\Client\AppointmentController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\ClientImageController;
use App\Http\Controllers\Client\Controller;
use App\Http\Controllers\Client\ServiceController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
  Route::get('/', function() { return view('client.login'); })->name('login');
  Route::post('/register', [AuthController::class, 'register'])->name('register');
  Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
  Route::get('/reset-password', [AuthController::class, 'reset_password_view'])->name('password.reset.view');
  Route::post('/reset-password', [AuthController::class, 'reset_password'])->name('password.reset');
});

Route::middleware(['auth'])->group(function () {
  Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');
  Route::put('/settings', [Controller::class, 'settings_update'])->name('settings.update');
  Route::resource('categories', CategoryController::class);
  Route::resource('services', ServiceController::class);
  Route::resource('images', ClientImageController::class);
  Route::resource('appointment', AppointmentController::class)->only(['index', 'view']);
  Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
