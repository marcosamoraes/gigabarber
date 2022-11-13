<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{slug}', function () {
    return view('index');
});

Route::name('client.')->prefix('client')->group(function () {
    Route::middleware(['guest'])->group(function () {
    });
    Route::middleware(['auth'])->group(function () {
    });
});

Route::name('admin.')->prefix('admin')->group(function () {
    Route::middleware(['guest'])->group(function () {
    });
    Route::middleware(['auth:admin'])->group(function () {
    });
});