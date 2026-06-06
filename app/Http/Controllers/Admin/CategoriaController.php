<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Show the admin categories index.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categorias = Categoria::orderBy('nome')->get();
        return view('admin.categoria.index', compact('categorias'));
    }

    /**
     * Store a newly created category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:categorias,nome'
        ], [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.max' => 'O nome da categoria não pode ter mais de 255 caracteres.',
            'nome.unique' => 'Já existe uma categoria com este nome.'
        ]);

        try {
            Categoria::create([
                'nome' => $request->nome
            ]);

            return redirect()->route('admin.categoria.index')
                ->with('success', 'Categoria criada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.categoria.index')
                ->with('error', 'Erro ao criar categoria. Tente novamente.');
        }
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\View\View
     */
    public function edit(Categoria $categoria)
    {
        return view('admin.categoria.editar_form', compact('categoria'));
    }

    /**
     * Update the specified category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Categoria $categoria)
    {
        $dataToUpdate = [
            'nome' => $request->nome,
            'updated_at' => now()
        ];

        DB::update('UPDATE categorias SET nome = ?, updated_at = ? WHERE id = ?', [$dataToUpdate['nome'], $dataToUpdate['updated_at'], $categoria->id]);

        return redirect()->route('admin.categoria.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified category.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Categoria $categoria)
    {
        try {
            $categoria->delete();
            return redirect()->route('admin.categoria.index')
                ->with('success', 'Categoria excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.categoria.index')
                ->with('error', 'Erro ao excluir categoria. Verifique se não há produtos vinculados a esta categoria.');
        }
    }
}
