<?php

use App\Http\Controllers\Client\AppointmentController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\ClientImageController;
use App\Http\Controllers\Client\Controller;
use App\Http\Controllers\Client\ServiceController;
use App\Http\Controllers\Client\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:web'])->group(function () {
  Route::get('/', function() { return view('client.login'); })->name('login');
  Route::get('/register', function() { return view('client.register'); })->name('register');
  Route::post('/register', [AuthController::class, 'register'])->name('register.post');
  Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
  Route::get('/forgot-password', [AuthController::class, 'forgot_password_view'])->name('password.forgot.view');
  Route::post('/forgot-password', [AuthController::class, 'forgot_password'])->name('password.forgot');
  Route::get('/reset-password', [AuthController::class, 'reset_password_view'])->name('password.reset.view');
  Route::post('/reset-password', [AuthController::class, 'reset_password'])->name('password.reset');
});

Route::middleware(['auth:web'])->group(function () {
  Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');
  Route::get('/settings', [Controller::class, 'settings'])->name('settings');
  Route::put('/settings', [Controller::class, 'settings_update'])->name('settings.update');
  Route::resource('users', UserController::class)->except(['show']);
  Route::resource('categories', CategoryController::class)->except(['show']);
  Route::resource('services', ServiceController::class)->except(['show']);
  Route::resource('images', ClientImageController::class)->except(['show']);
  Route::resource('appointments', AppointmentController::class)->except(['show', 'edit', 'update']);
  Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
