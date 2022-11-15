<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\ClientAddress;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::get();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states_json = json_decode(file_get_contents(public_path() . '/json/states.json'), false);
        $all_states = collect($states_json)->map(function ($state_json) {
            return [
                'id' => $state_json->id,
                'uf' => $state_json->sigla,
                'name' => $state_json->nome
            ];
        })->unique();
        return view('admin.clients.create', compact('all_states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $validated = $request->safe()->all();

        try {
            $validated['logo'] = $this->storageFile($validated['logo'], 'clients');
            
            if (isset($validated['favicon'])) {
                $validated['favicon'] = $this->storageFile($validated['favicon'], 'clients');
            }

            $client = Client::create($validated);
            $client->attributes()->create($validated['attributes']);
            $client->addresses()->create($validated['address']);
            return redirect(route('admin.clients.index'))->with('success', 'Cliente cadastrado com sucesso!');
        } catch (Exception $e) {
            logError($e, $validated);
            return back()->withErrors('Erro ao cadastrar cliente, tente novamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('admin.clients.view', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
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
            ->filter(function($city_json) use ($client) {
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
        return view('admin.clients.edit', compact('client', 'all_states', 'all_cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $validated = $request->safe()->all();

        try {
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
            return redirect(route('admin.clients.index'))->with('success', 'Cliente editado com sucesso!');
        } catch (Exception $e) {
            logError($e, $validated);
            return back()->withErrors('Erro ao editar cliente, tente novamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        try {
            $client->delete();
            return back()->with('success', 'Cliente deletado com sucesso!');
        } catch (Exception $e) {
            logError($e, false, ['client' => json_encode($client)]);
            return back()->withErrors(['error' => 'Erro ao deletar cliente, tente novamente.']);
        }
    }

    public function impersonate($uuid)
    {
        Auth::guard('web')->loginUsingId($uuid);

        return redirect('/client/dashboard')->with([
            'success' => 'Cliente impersonado!',
        ]);
    }
}
