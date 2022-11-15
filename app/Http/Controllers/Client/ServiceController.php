<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Category;
use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::where('client_uuid', Auth::id())->get();
        return view('client.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('client_uuid', Auth::id())->where('active', true)->get();
        return view('client.services.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        $validated = $request->safe()->all();

        try {
            Service::create($validated);
            return redirect(route('client.services.index'))->with('success', 'Serviço criado com sucesso!');
        } catch (Exception $e) {
            logError($e, $validated);
            return back()->withErrors('Erro ao cadastrar serviço, tente novamente.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $categories = Category::where('client_uuid', Auth::id())->where('active', true)->get();
        return view('client.services.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $validated = $request->safe()->all();

        try {
            $service->update($validated);
            return redirect(route('client.services.index'))->with('success', 'Serviço editado com sucesso!');
        } catch (Exception $e) {
            logError($e, $validated);
            return back()->withErrors('Erro ao editar serviço, tente novamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return back()->with('success', 'Serviço deletada com sucesso!');
        } catch (Exception $e) {
            logError($e);
            return back()->withErrors('Erro ao deletar serviço, tente novamente.');
        }
    }
}
