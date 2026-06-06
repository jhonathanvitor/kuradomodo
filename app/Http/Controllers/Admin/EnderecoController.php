<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Endereco;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function index()
    {
        $enderecos = DB::select('SELECT * FROM endereco');
        return view('admin.endereco.index', compact('enderecos'));
    }

    /**
     * Show the form for creating a new endereco.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.endereco.form');
    }

    /**
     * Store a newly created endereco.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'endereco' => 'required|string',
            'telefone' => 'required|string|max:20',
            'email' => 'required|string|max:255',
            'horario_atendimento' => 'required|string|max:255'
        ], [
            'endereco.required' => 'O endereço é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
            'telefone.max' => 'O telefone não pode ter mais de 20 caracteres.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ter um formato válido.',
            'email.max' => 'O email não pode ter mais de 255 caracteres.',
            'horario_atendimento.required' => 'O horário de atendimento é obrigatório.',
            'horario_atendimento.max' => 'O horário de atendimento não pode ter mais de 255 caracteres.'
        ]);

        try {
            Endereco::create($request->all());

            return redirect()->route('admin.endereco.index')
                ->with('success', 'Endereço criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.endereco.index')
                ->with('error', 'Erro ao criar endereço. Tente novamente.');
        }
    }

    /**
     * Show the form for editing the specified endereco.
     *
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\View\View
     */
    public function edit(Endereco $endereco)
    {
        return view('admin.endereco.editar', compact('endereco'));
    }

    /**
     * Update the specified endereco.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Http\RedirectResponse
     */
    // App\Http\Controllers\Admin\EnderecoController.php
    public function update(Request $request, $id)
    {
        $request->validate([
            'endereco' => 'required|string|max:65535',
            'telefone' => 'required|string|max:20',
            'email' => 'required|string|max:100',
            'horario_atendimento' => 'required|string|max:65535',
        ]);

        $endereco = Endereco::findOrFail($id);

        // Limpar HTML vazio
        $enderecoContent = $request->endereco;
        $horarioContent = $request->horario_atendimento;

        // Remover divs vazias que o Trix pode criar
        if (in_array($enderecoContent, ['<div><br></div>', '<br>', ''])) {
            $enderecoContent = '';
        }

        if (in_array($horarioContent, ['<div><br></div>', '<br>', ''])) {
            $horarioContent = '';
        }

        $endereco->update([
            'endereco' => $enderecoContent,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'horario_atendimento' => $horarioContent,
        ]);

        return redirect()->back()->with('success', 'Endereço atualizado com sucesso!');
    }

    /**
     * Remove the specified endereco.
     *
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Endereco $endereco)
    {
        try {
            $endereco->delete();
            return redirect()->route('admin.endereco.index')
                ->with('success', 'Endereço excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.endereco.index')
                ->with('error', 'Erro ao excluir endereço. Tente novamente.');
        }
    }
    // Outros métodos relacionados a Endereço podem ser adicionados aqui
}
