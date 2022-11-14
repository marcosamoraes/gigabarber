<?php

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
Route::get('/', function () {
    $client = Client::inRandomOrder()->firstOrFail();
    return redirect(route('index', ['slug' => $client->slug]));
});
Route::get('/{slug}', function ($slug) {
    try {
        $client = Client::where('slug', $slug)->firstOrFail();
        $client->increment('views');
        return view('index', compact('client'));
    } catch (Exception $e) {
        logError($e, false, ['slug' => $slug]);
        abort(404);
    }
})->name('index');

Route::post('/{uuid}', function (Request $request, $uuid) {
    try {
        $client = Client::findOrFail($uuid);
        return back()->with('success', 'Agendamento realizado com sucesso!');
    } catch (Exception $e) {
        logError($e, $request->all(), ['uuid' => $uuid]);
        return back()->withErrors('Falha ao realizar agendamento, tente novamente.');
    }
})->name('make.appointment');