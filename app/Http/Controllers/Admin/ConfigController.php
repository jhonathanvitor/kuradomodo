<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ConfigController extends Controller
{
    public function __construct()
    {
        // Aplica o middleware admin a todos os métodos
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            if (!$user || !$user->isAdmin()) {
                abort(403, 'Acesso não autorizado.');
            }
            return $next($request);
        });
    }

    /**
     * Display the configuration settings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('admin.config.index', compact('users'));
    }

    public function create()
    {
        return view('admin.config.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'string', 'in:admin,user'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.config.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user)
    {
        return view('admin.config.index', compact('user'));
    }

    // Atualiza nome, e-mail e role
    public function updateDetails(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'string', 'in:admin,user'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.config.index')->with('success', 'Dados do usuário atualizados com sucesso!');
    }

    // Atualiza a senha
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.config.index')->with('success', 'Senha do usuário atualizada com sucesso!');
    }
    public function destroy(User $user)
    {
        // Impedir que o usuário delete a si mesmo
        if ($user->getKey() === Auth::id()) {
            return redirect()->route('admin.config.index')->with('error', 'Você não pode deletar seu próprio usuário.');
        }

        $user->delete();

        return redirect()->route('admin.config.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
