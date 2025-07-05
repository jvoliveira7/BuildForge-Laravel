<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\Admin\ProdutoControllerAD;
use App\Http\Controllers\Admin\CategoriaControllerAD;
use App\Http\Controllers\Admin\PedidoControllerAD;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ComprovanteController;

// Rotas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');

// Rotas autenticadas para clientes
Route::middleware(['auth', 'role:cliente', 'verified'])->group(function () {

    // Carrinho
    Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
    Route::post('/carrinho/adicionar/{id}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
    Route::post('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');

    // Página de checkout (GET)
    Route::get('/checkout', [PedidoController::class, 'checkout'])->name('checkout');

    // Finalizar pedido (POST)
    Route::post('/pedido/finalizar', [PedidoController::class, 'finalizar'])->name('pedido.finalizar');

    // Pedidos do cliente
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/{pedido}', [PedidoController::class, 'show'])->name('pedidos.show');
    Route::get('/pedidos/{pedido}/comprovante', [PedidoController::class, 'comprovante'])->name('pedidos.comprovante');
    Route::get('/pedidos/{pedido}/comprovante', [PedidoController::class, 'comprovante'])->name('pedidos.comprovante');


    // Dashboard do cliente
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Gerar PDF do comprovante de pedido
    Route::get('/pedidos/{pedido}/comprovante', [\App\Http\Controllers\ComprovanteController::class, 'gerar'])
    ->middleware(['auth', 'role:cliente'])
    ->name('pedidos.comprovante');
     Route::get('/comprovante/{pedido}', [ComprovanteController::class, 'gerar'])->name('comprovante.gerar');
});

// Rotas autenticadas para qualquer usuário
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas para administradores
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('produtos', ProdutoControllerAD::class)->names('admin.produtos');
    Route::resource('categorias', CategoriaControllerAD::class)->names('admin.categorias');
    Route::resource('pedidos', PedidoControllerAD::class)->names('admin.pedidos');
});

require __DIR__.'/auth.php';
