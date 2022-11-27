<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\Client;

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

Route::get('/', function () {
    $client = Client::inRandomOrder()->firstOrFail();
    return redirect(route('index', ['slug' => $client->slug]));
});

Route::get('/{slug}', [Controller::class, 'clientView'])->name('index');
Route::get('/{slug}/agendamento', [Controller::class, 'appointment'])->name('appointment');
Route::get('/{slug}/pre-cadastro/{whatsapp}', [Controller::class, 'preRegister'])->name('pre.register');
Route::post('/{client}/pre-cadastro', [Controller::class, 'makePreRegister'])->name('make.pre.register');
Route::get('/available-times/{uuid}/{date}', [Controller::class, 'availableTimes']);
Route::post('/agendar/{user_uuid}', [Controller::class, 'makeAppointment'])->name('make.appointment');
Route::post('/cancelar/{user_uuid}', [Controller::class, 'cancelAppointment'])->name('cancel.appointment');