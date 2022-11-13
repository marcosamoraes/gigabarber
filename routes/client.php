<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
  Route::post('/register', [AuthController::class, 'register'])->name('register');
  Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('login');
  Route::get('/reset-password', [AuthController::class, 'reset_password_view'])->name('password.reset.view');
  Route::post('/reset-password', [AuthController::class, 'reset_password'])->name('password.reset');
});

Route::middleware(['auth'])->group(function () {
  Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
  Route::put('/settings', [ClientController::class, 'settings_update'])->name('settings.update');
  Route::resource('categories', CategoryController::class);
  Route::resource('services', ServiceController::class);
  Route::resource('images', ClientImageController::class);
  Route::resource('appointment', AppointmentController::class)->only(['index', 'view']);
  Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
