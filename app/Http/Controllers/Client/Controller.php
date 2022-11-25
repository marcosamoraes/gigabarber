<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\ClientAddress;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
  public function dashboard()
  {
    $totalServices = Service::where('client_uuid', Auth::id())->count();
    $totalViews = Auth::user()->views;
    $totalAppointments = Appointment::where('client_uuid', Auth::id())->count();
    return view('client.dashboard', compact('totalServices', 'totalViews', 'totalAppointments'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function settings()
  {
    $client = Client::findOrFail(Auth::id());

    $states_json = json_decode(file_get_contents(public_path() . '/json/states.json'), false);
    $all_states = collect($states_json)->map(function ($state_json) {
      return [
        'id' => $state_json->id,
        'uf' => $state_json->sigla,
        'name' => $state_json->nome
      ];
    })->unique();

    $cities_json = json_decode(file_get_contents(public_path() . '/json/cities.json'), false);
    $all_cities = collect($cities_json)
      ->filter(function ($city_json) use ($client) {
        if (isset($client->address[0])) {
          return $city_json->nome === $client->address[0]->city;
        } else return false;
      })
      ->map(function ($city_json) {
        return [
          'id' => $city_json->id,
          'name' => $city_json->nome
        ];
      })->unique();

    return view('client.settings', compact('client', 'all_states', 'all_cities'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateClientRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function settings_update(UpdateClientRequest $request)
  {
    $validated = $request->safe()->all();

    try {
      DB::beginTransaction();
      $client = Client::findOrFail(Auth::id());

      if (isset($validated['logo'])) {
        $validated['logo'] = $this->storageFile($validated['logo'], 'clients');
      }
      if (isset($validated['favicon'])) {
        $validated['favicon'] = $this->storageFile($validated['favicon'], 'clients');
      }
      if (isset($validated['password'])) {
        $validated['password'] = Hash::make($validated['password']);
      }

      $client->update($validated);
      $client->attributes()->updateOrCreate(['client_uuid' => $client->uuid], $validated['attributes']);
      ClientAddress::updateOrCreate(['client_uuid' => $client->uuid], $validated['address']);

      $client->hours()->delete();
      foreach ($validated['hours'] as $clientHour)
        $client->hours()->create($clientHour);

      DB::commit();
      return back()->with('success', 'Dados editado com sucesso!');
    } catch (Exception $e) {
      DB::rollBack();
      logError($e, $validated);
      return back()->withErrors('Erro ao editar dados, tente novamente.');
    }
  }
}
