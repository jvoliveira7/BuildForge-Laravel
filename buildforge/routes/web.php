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
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\AvaliacaoController;

// -------------------------
// Rotas públicas
// -------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->name('produtos.show');
Route::get('/produtos/{produto}/avaliacoes', [ProdutoController::class, 'carregarAvaliacoes'])
    ->name('produtos.avaliacoes');


// -------------------------
// Rotas autenticadas (clientes)
// -------------------------
Route::middleware(['auth', 'role:cliente', 'verified'])->group(function () {

    // Carrinho
    Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
    Route::post('/carrinho/adicionar/{id}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
    Route::post('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');



    // Checkout e Pedido
    Route::get('/checkout', [PedidoController::class, 'checkout'])->name('checkout');
    Route::post('/pedido/finalizar', [PedidoController::class, 'finalizar'])->name('pedido.finalizar');
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/{pedido}', [PedidoController::class, 'show'])->name('pedidos.show');

    // Comprovante PDF
    Route::get('/pedidos/{pedido}/comprovante', [ComprovanteController::class, 'gerar'])->name('pedidos.comprovante');

    // Newsletter
    Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

    // Dashboard do cliente
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Pagamento Mercado Pago
    Route::get('/pagamento/sucesso/{pedido}', [PagamentoController::class, 'sucesso'])->name('pagamento.sucesso');
    Route::get('/pagamento/falha', [PagamentoController::class, 'falha'])->name('pagamento.falha');
    Route::get('/pagamento/pendente', [PagamentoController::class, 'pendente'])->name('pagamento.pendente');

    // Avaliação de produto
    Route::post('/produtos/{produto}/avaliar', [\App\Http\Controllers\AvaliacaoController::class, 'store'])->name('avaliacoes.store');
    Route::post('/produtos/{produto}/avaliar', [AvaliacaoController::class, 'store'])->name('avaliacoes.store');


});


// -------------------------
// Notificações e retorno do Pagamento (sem autenticação)
// -------------------------
Route::post('/pagamento/notificacao', [PagamentoController::class, 'notificacao'])
    ->middleware('api')->name('pagamento.notificacao');
Route::get('/pagamento/retorno', [PagamentoController::class, 'retorno'])->name('pagamento.retorno');
Route::get('/teste-token', [PagamentoController::class, 'testeToken']);

// -------------------------
// Rotas autenticadas (qualquer usuário)
// -------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); 
});

// -------------------------
// Rotas administrativas (admin)
// -------------------------
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Ofertas por email
    Route::get('/ofertas', [OfertaController::class, 'form'])->name('admin.ofertas.form');
    Route::post('/ofertas/enviar', [OfertaController::class, 'enviarOferta'])->name('admin.ofertas.enviar');

    // CRUDs
    Route::resource('produtos', ProdutoControllerAD::class)->names('admin.produtos');
    Route::resource('categorias', CategoriaControllerAD::class)->names('admin.categorias');
    Route::resource('pedidos', PedidoControllerAD::class)->names('admin.pedidos');
});

// -------------------------
// Autenticação padrão do Laravel Breeze
// -------------------------
require __DIR__.'/auth.php';
