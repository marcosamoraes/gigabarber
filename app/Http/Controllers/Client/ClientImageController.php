<?php

namespace App\Http\Controllers\Client;

use App\Models\ClientImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClientImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = ClientImage::where('client_uuid', Auth::id())->get();
        return view('client.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'image' => ['required', 'image']
        ]);

        try {
            $validated['client_uuid'] = Auth::id();
            $validated['name'] = $this->storageFile($validated['image'], 'client_images');
            ClientImage::create($validated);
            return redirect(route('client.images.index'))->with('success', 'Imagem criada com sucesso!');
        } catch (Exception $e) {
            logError($e, $validated);
            return back()->withErrors('Erro ao criar imagem, tente novamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        try {
            $image = ClientImage::findOrFail($uuid);
            Storage::delete(str_replace('/storage/', '', $image->name));
            $image->delete();
            
            return back()->with('success', 'Imagem deletada com sucesso!');
        } catch (Exception $e) {
            logError($e);
            return back()->withErrors('Erro ao deletar imagem, tente novamente.');
        }
    }
}
