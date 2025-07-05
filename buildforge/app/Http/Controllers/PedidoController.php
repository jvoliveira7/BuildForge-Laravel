<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\ItemPedido;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PedidoController extends Controller
{

    public function comprovante(Pedido $pedido)
{
    if ($pedido->user_id !== auth()->id()) {
        abort(403);
    }

    $pedido->load('itens.produto');

    $pdf = Pdf::loadView('pedidos.comprovante', compact('pedido'));

    return $pdf->download("comprovante_pedido_{$pedido->id}.pdf");
}

    public function index()
    {
        $pedidos = Pedido::where('user_id', auth()->id())
                         ->with('itens')
                         ->orderBy('created_at', 'desc')
                      ->paginate(10);

        return view('pedidos.index', compact('pedidos'));
    }
    
public function checkout()
{
    $carrinho = session('carrinho', []);

    if (empty($carrinho)) {
        return redirect()->route('carrinho.index')->with('error', 'Seu carrinho está vazio.');
    }
    

    // Calcula o total
    $total = 0;
    foreach ($carrinho as $item) {
        $total += $item['preco'] * $item['quantidade'];
    }

    return view('pedidos.checkout', compact('carrinho', 'total'));
}

    public function show(Pedido $pedido)
    {
        // Garante que o pedido pertence ao usuário autenticado
        if ($pedido->user_id !== auth()->id()) {
            abort(403);
        }

        $pedido->load('itens');
        return view('pedidos.show', compact('pedido'));
    }

    public function finalizar(Request $request)
    {
        $user = auth()->user();
        $carrinho = session('carrinho', []);

        if (empty($carrinho)) {
            return redirect()->back()->with('error', 'Seu carrinho está vazio.');
        }

        

\Log::info('Entrou em finalizar pedido para usuário ' . auth()->id());

        $total = 0;
        foreach ($carrinho as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        DB::beginTransaction();
        try {
            $pedido = Pedido::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'pendente',
            ]);

            foreach ($carrinho as $item) {
                $pedido->itens()->create([
                    'produto_id' => $item['produto_id'],
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $item['preco'],
                ]);
            }

            DB::commit();
            session()->forget('carrinho');

            return redirect()->route('pedidos.index')->with('success', 'Pedido finalizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao finalizar pedido: ' . $e->getMessage());
        }
    }
}
