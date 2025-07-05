<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ComprovanteController extends Controller
{
    /**
     * Gera e retorna o comprovante PDF de um pedido.
     */
    public function gerar($pedidoId)
    {
        $pedido = Pedido::with('itens.produto')->findOrFail($pedidoId);

        // Garante que o pedido pertence ao cliente logado
        if ($pedido->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para acessar este comprovante.');
        }

        $pdf = Pdf::loadView('pedidos.comprovante', compact('pedido'));

        return $pdf->download("comprovante-pedido-{$pedido->id}.pdf");
    }
}
