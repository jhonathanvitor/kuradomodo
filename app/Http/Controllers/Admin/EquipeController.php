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

            $user    = Auth::user();
            $isAdmin = false;

            if ($user) {
                if (is_callable([$user, 'isAdmin'])) {
                    $isAdmin = (bool) call_user_func([$user, 'isAdmin']);
                } elseif (isset($user->is_admin)) {
                    $isAdmin = (bool) $user->is_admin;
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

    public function index()
    {
        $equipes = Equipe::orderBy('ordem', 'asc')->get();
        return view('admin.equipe.index', compact('equipes'));
    }

    public function create()
    {
        return view('admin.equipe.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'   => 'required|string|max:255',
            'cargo'  => 'nullable|string|max:255',
            'foto'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'descricao' => 'nullable|string',
            'links'  => 'nullable|string',
            'ordem'  => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['nome', 'cargo', 'descricao', 'ordem']);

        $data['ordem'] = $request->filled('ordem') ? (int) $request->ordem : 0;

        $data['links'] = $request->filled('links')
            ? array_map('trim', explode(',', $request->links))
            : null;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('equipe', 'public_images');
        }

        Equipe::create($data);

        return redirect()->route('admin.equipe.index')
            ->with('success', 'Membro da equipe adicionado com sucesso!');
    }

    public function edit(Equipe $equipe)
    {
        return view('admin.equipe.edit', compact('equipe'));
    }

    public function update(Request $request, Equipe $equipe)
    {
        $request->validate([
            'nome'   => 'required|string|max:255',
            'cargo'  => 'nullable|string|max:255',
            'foto'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'descricao' => 'nullable|string',
            'links'  => 'nullable|string',
            'ordem'  => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['nome', 'cargo', 'descricao', 'ordem']);

        $data['ordem'] = $request->filled('ordem') ? (int) $request->ordem : 0;

        $data['links'] = $request->filled('links')
            ? array_map('trim', explode(',', $request->links))
            : null;

        // ── Foto: nova upload, remover ou manter ──────────────────────────
        if ($request->hasFile('foto')) {
            // Apaga a foto antiga antes de salvar a nova
            $this->deleteFoto($equipe);
            $data['foto'] = $request->file('foto')->store('equipe', 'public_images');

        } elseif ($request->input('remover_foto') === '1') {
            // Usuário clicou em "Remover foto"
            $this->deleteFoto($equipe);
            $data['foto'] = null;
        }
        // Caso contrário, não toca no campo foto (mantém a existente)
        // ─────────────────────────────────────────────────────────────────

        $equipe->update($data);

        return redirect()->route('admin.equipe.index')
            ->with('success', 'Membro da equipe atualizado com sucesso!');
    }

    public function destroy(Equipe $equipe)
    {
        $this->deleteFoto($equipe);
        $equipe->delete();

        return redirect()->route('admin.equipe.index')
            ->with('success', 'Membro da equipe deletado com sucesso!');
    }

    /**
     * Salva a nova ordem recebida via drag-and-drop (AJAX).
     * Rota: POST /admin/equipe/reorder   name: admin.equipe.reorder
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer|exists:equipes,id',
        ]);

        foreach ($request->ids as $index => $id) {
            Equipe::where('id', $id)->update(['ordem' => $index]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Obtém a URL pública para uma foto da equipe.
     */
    public function getUrlFor(Equipe $equipe): string
    {
        if (!$equipe->foto) {
            return asset('images/default-avatar.png');
        }

        $baseUrl = config('filesystems.disks.public_images.url');
        if ($baseUrl) {
            return rtrim($baseUrl, '/') . '/' . ltrim($equipe->foto, '/');
        }

        return asset($equipe->foto);
    }

    // ── Helpers ──────────────────────────────────────────────────────────

    private function deleteFoto(Equipe $equipe): void
    {
        if ($equipe->foto && Storage::disk('public_images')->exists($equipe->foto)) {
            Storage::disk('public_images')->delete($equipe->foto);
        }
    }
}
