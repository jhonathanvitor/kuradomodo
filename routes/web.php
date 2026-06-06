<?php

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Exibir formulário de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Processar login
Route::post('/login', [LoginController::class, 'login']);
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/noticia/{slug}', [HomeController::class, 'showPost'])->name('post.show');
Route::get('/projeto/{slug}', [HomeController::class, 'showProjeto'])->name('projeto.show');
