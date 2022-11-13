<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientAttributeRequest;
use App\Http\Requests\UpdateClientAttributeRequest;
use App\Models\ClientAttribute;

class ClientAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientAttributeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientAttributeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientAttribute  $clientAttribute
     * @return \Illuminate\Http\Response
     */
    public function show(ClientAttribute $clientAttribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientAttribute  $clientAttribute
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientAttribute $clientAttribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientAttributeRequest  $request
     * @param  \App\Models\ClientAttribute  $clientAttribute
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientAttributeRequest $request, ClientAttribute $clientAttribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientAttribute  $clientAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientAttribute $clientAttribute)
    {
        //
    }
}
