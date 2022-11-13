<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', function() { return view('admin.login'); })->name('login');
    Route::post('/authenticate', [Admin\AuthController::class, 'authenticate'])->name('login');
});
Route::middleware(['auth:admin'])->group(function () {
  Route::get('/dashboard', [Admin\AdminController::class, 'dashboard'])->name('dashboard');
  Route::resource('clients', 'ClientController');
  Route::get('/logout', [Admin\AdminController::class, 'logout'])->name('logout');
});
