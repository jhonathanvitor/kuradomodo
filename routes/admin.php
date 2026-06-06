<?php
// routes/admin.php

use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnderecoController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ImagemController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\EquipeController;

use Illuminate\Support\Facades\Route;

// Rotas de autenticação
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Rotas de categoria com o prefixo admin
    Route::get('categoria', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::post('categoria', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::get('categoria/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categoria.edit');
    Route::put('categoria/{categoria}', [CategoriaController::class, 'update'])->name('categoria.update');
    Route::delete('categoria/{categoria}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');

    // Rotas de Endereço
    Route::get('endereco', [EnderecoController::class, 'index'])->name('endereco.index');
    Route::get('endereco/create', [EnderecoController::class, 'create'])->name('endereco.create');
    Route::post('endereco', [EnderecoController::class, 'store'])->name('endereco.store');
    Route::get('endereco/{endereco}/edit', [EnderecoController::class, 'edit'])->name('endereco.edit');
    Route::put('endereco/{endereco}', [EnderecoController::class, 'update'])->name('endereco.update');
    Route::delete('endereco/{endereco}', [EnderecoController::class, 'destroy'])->name('endereco.destroy');

    // Rotas de Posts
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Rotas de Configurações
    Route::get('/config', [ConfigController::class, 'index'])->name('config.index');
    Route::get('/config/create', [ConfigController::class, 'create'])->name('config.create');
    Route::post('/config', [ConfigController::class, 'store'])->name('config.store');
    Route::put('/config/{user}/details', [ConfigController::class, 'updateDetails'])->name('config.updateDetails');
    Route::put('/config/{user}/password', [ConfigController::class, 'updatePassword'])->name('config.updatePassword');
    Route::delete('/config/{user}', [ConfigController::class, 'destroy'])->name('config.destroy');

    // Rotas de Imagens
    Route::get('imagens', [ImagemController::class, 'index'])->name('imagens.index');
    Route::post('imagens', [ImagemController::class, 'store'])->name('imagens.store');
    // Rota para lidar com uploads de imagens do editor Trix
    Route::post('imagens/trix-upload', [ImagemController::class, 'trixUpload'])->name('imagens.trix-upload');
    Route::get('imagens/list', [ImagemController::class, 'listJson'])->name('imagens.list');
    Route::delete('imagens/{imagem}', [ImagemController::class, 'destroy'])->name('imagens.destroy');

    // Rotas de Equipe
    Route::get('equipe', [EquipeController::class, 'index'])->name('equipe.index');
    Route::get('equipe/create', [EquipeController::class, 'create'])->name('equipe.create');
    Route::post('equipe', [EquipeController::class, 'store'])->name('equipe.store');
    Route::get('equipe/{equipe}/edit', [EquipeController::class, 'edit'])->name('equipe.edit');
    Route::put('equipe/{equipe}', [EquipeController::class, 'update'])->name('equipe.update');
    Route::delete('equipe/{equipe}', [EquipeController::class, 'destroy'])->name('equipe.destroy');
});
