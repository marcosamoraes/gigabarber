<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('client_uuid', Auth::id())->get();
        return view('client.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->safe()->all();

        try {
            Category::create($validated);
            return redirect(route('client.categories.index'))->with('success', 'Categoria criado com sucesso!');
        } catch (Exception $e) {
            logError($e, $validated);
            return back()->withErrors('Erro ao cadastrar categoria, tente novamente.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('client.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->safe()->all();

        try {
            $category->update($validated);
            return redirect(route('client.categories.index'))->with('success', 'Categoria editado com sucesso!');
        } catch (Exception $e) {
            logError($e, $validated);
            return back()->withErrors('Erro ao editar categoria, tente novamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return back()->with('success', 'Categoria deletada com sucesso!');
        } catch (Exception $e) {
            logError($e);
            return back()->withErrors('Erro ao deletar categoria, tente novamente.');
        }
    }
}
