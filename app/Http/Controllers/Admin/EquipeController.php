<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EquipeController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check()) {
                abort(403, 'Acesso não autorizado.');
            }

            $user = Auth::user();

            // Verificação simplificada de administrador (suporta método, flag ou role)
            $isAdmin = false;
            if ($user) {
                // se houver um método isAdmin no modelo, chame-o dinamicamente
                if (is_callable([$user, 'isAdmin'])) {
                    $isAdmin = (bool) call_user_func([$user, 'isAdmin']);
                    // senão verifique um campo booleano is_admin
                } elseif (isset($user->is_admin)) {
                    $isAdmin = (bool) $user->is_admin;
                    // senão verifique um campo role igual a 'admin'
                } elseif (isset($user->role)) {
                    $isAdmin = ($user->role === 'admin');
                }
            }
            if (!$isAdmin) {
                abort(403, 'Acesso não autorizado.');
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipes = Equipe::orderBy('ordem', 'asc')->get();
        return view('admin.equipe.index', compact('equipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.equipe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cargo' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'descricao' => 'nullable|string',
            'links' => 'nullable|string',
            'ordem' => 'nullable|integer|min:0', // Validação garantida
        ]);

        $data = $request->only(['nome', 'cargo', 'descricao', 'links', 'ordem']);

        // Se a ordem for enviada vazia, definimos como 0 para não quebrar o banco
        $data['ordem'] = $request->filled('ordem') ? (int)$request->ordem : 0;

        // Processar links para salvar como JSON no banco caso usem o formato correto
        if ($request->has('links') && !empty($request->links)) {
            $linksArray = array_map('trim', explode(',', $request->links));
            $data['links'] = json_encode($linksArray);
        } else {
            $data['links'] = null;
        }

        // Upload da foto
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('equipe', 'public_images');
            $data['foto'] = $fotoPath;
        }

        Equipe::create($data);

        return redirect()->route('admin.equipe.index')->with('success', 'Membro da equipe adicionado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipe $equipe)
    {
        return view('admin.equipe.edit', compact('equipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipe $equipe)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cargo' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'descricao' => 'nullable|string',
            'links' => 'nullable|string',
            'ordem' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['nome', 'cargo', 'descricao', 'ordem']);

        $data['ordem'] = $request->filled('ordem') ? (int)$request->ordem : 0;

        // Passa array direto — o cast do modelo faz o json_encode
        $data['links'] = $request->filled('links')
            ? array_map('trim', explode(',', $request->links))
            : null;

        if ($request->hasFile('foto')) {
            if ($equipe->foto && Storage::disk('public_images')->exists($equipe->foto)) {
                Storage::disk('public_images')->delete($equipe->foto);
            }
            $data['foto'] = $request->file('foto')->store('equipe', 'public_images');
        }

        $equipe->update($data);

        return redirect()->route('admin.equipe.index')->with('success', 'Membro da equipe atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipe $equipe)
    {
        // Deletar foto se existir, usando o mesmo disco do ImagemController
        if ($equipe->foto && Storage::disk('public_images')->exists($equipe->foto)) {
            Storage::disk('public_images')->delete($equipe->foto);
        }

        $equipe->delete();

        return redirect()->route('admin.equipe.index')->with('success', 'Membro da equipe deletado com sucesso!');
    }

    /**
     * Obtém a URL pública para uma foto da equipe
     */
    public function getUrlFor(Equipe $equipe): string
    {
        if (!$equipe->foto) {
            return asset('images/default-avatar.png'); // Imagem padrão caso não tenha foto
        }

        // Build the public URL from the disk config if present, otherwise fall back to asset()
        $baseUrl = config('filesystems.disks.public_images.url');
        if ($baseUrl) {
            return rtrim($baseUrl, '/') . '/' . ltrim($equipe->foto, '/');
        }

        return asset($equipe->foto);
    }
}
