<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\Admin\ProdutoControllerAD;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\PedidoControllerAD;

// Rotas públicas (convidados)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');

// Rotas para clientes autenticados (role:cliente)
Route::middleware(['auth', 'role:cliente', 'verified'])->group(function () {
    // Carrinho
    Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
    Route::post('/carrinho/adicionar/{id}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
    Route::post('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');

    // Dashboard cliente
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rotas para qualquer usuário autenticado (cliente ou admin)
Route::middleware(['auth'])->group(function () {
    // Perfil (visualizar, editar, atualizar e excluir)
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas exclusivas para administradores
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // CRUD para produtos, categorias e pedidos
    Route::resource('produtos', ProdutoControllerAD::class)->names('admin.produtos');
    Route::resource('categorias', CategoriaController::class)->names('admin.categorias');
    Route::resource('pedidos', PedidoControllerAD::class)->names('admin.pedidos');
});

require __DIR__.'/auth.php';
