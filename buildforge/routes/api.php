
<?php


use App\Http\Controllers\PagamentoController;
use Illuminate\Support\Facades\Route;

Route::post('/pagamento/notificacao', [PagamentoController::class, 'notificacao'])->name('pagamento.notificacao');
