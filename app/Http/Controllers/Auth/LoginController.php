<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Exibe o formulário de login
     */
    public function showLoginForm()
    {
        return view('admin.login.index');
    }

    /**
     * Processa o login do usuário
     */
    public function login(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Informe um email válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        // Credenciais para autenticação
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // Tentativa de login
        if (Auth::attempt($credentials, $remember)) {
            // Login bem-sucedido
            $request->session()->regenerate();

            // Redireciona para página pretendida ou dashboard
            return redirect()->intended('/admin')->with('success', 'Login realizado com sucesso!');
        }

        // Login falhou
        return redirect()->back()
            ->withErrors(['email' => 'Credenciais inválidas.'])
            ->withInput($request->except('password'));
    }

    /**
     * Realiza o logout do usuário
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout realizado com sucesso!');
    }

    /**
     * Método alternativo usando DB diretamente (sem Eloquent)
     */
    public function loginComSQL(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Buscar usuário com SQL
        $usuario = DB::select('SELECT * FROM users WHERE email = ? LIMIT 1', [$request->email]);

        if (empty($usuario)) {
            return redirect()->back()->withErrors(['email' => 'Usuário não encontrado.']);
        }

        $usuario = $usuario[0];

        // Verificar senha
        if (!Hash::check($request->password, $usuario->password)) {
            return redirect()->back()->withErrors(['email' => 'Credenciais inválidas.']);
        }

        // Login manual
        Auth::loginUsingId($usuario->id, $request->has('remember'));

        // ✅ CORRIGIDO - estava com erro aqui também
        return redirect()->intended('/admin')->with('success', 'Login realizado!');
    }
}
