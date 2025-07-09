<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use App\Services\MercadoPagoService;

class PedidoController extends Controller
{


    public function index()
{
     $pedidos = Pedido::where('user_id', auth()->id())
        ->with('itens.produto')
        ->latest()
        ->paginate(5); 
        
    return view('pedidos.index', compact('pedidos'));
}

    public function checkout()
    {
        $carrinho = session('carrinho', []);

        if (empty($carrinho)) {
            return redirect()->route('carrinho.index')->with('error', 'Seu carrinho está vazio.');
        }

        $total = collect($carrinho)->sum(fn($item) => $item['preco'] * $item['quantidade']);

        return view('pedidos.checkout', compact('carrinho', 'total'));
    }

    public function finalizar(Request $request, MercadoPagoService $mercadoPago)
    {
        $user = auth()->user();
        $carrinho = session('carrinho', []);

        if (empty($carrinho)) {
            return redirect()->back()->with('error', 'Seu carrinho está vazio.');
        }

        DB::beginTransaction();

        try {
            $total = collect($carrinho)->sum(fn($item) => $item['preco'] * $item['quantidade']);

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

            $pedido->load('itens.produto');

            DB::commit();

            session()->forget('carrinho');

            $url = $mercadoPago->criarPagamentoUrl($pedido, true);

            return redirect()->away($url);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erro ao finalizar pedido: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erro ao finalizar pedido: ' . $e->getMessage());
        }
    }
}
