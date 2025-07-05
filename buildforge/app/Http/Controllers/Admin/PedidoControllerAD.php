<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoControllerAD extends Controller
{
    // Listar todos os pedidos (paginação)
    public function index()
    {
        $pedidos = Pedido::with('user')->latest()->paginate(15);
        return view('admin.pedidos.index', compact('pedidos'));
    }

        public function edit(Pedido $pedido)
        {
            // Carrega os itens e usuário para mostrar na tela de edição
            $pedido->load(['itens.produto', 'user']);
            return view('admin.pedidos.edit', compact('pedido'));
        }

    // Exibir detalhes de um pedido específico
    public function show(Pedido $pedido)
    {
        // carregar relacionamento itens e usuário
        $pedido->load(['itens.produto', 'user']);
        return view('admin.pedidos.show', compact('pedido'));
    }

    // (Opcional) Atualizar status do pedido
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'status' => 'required|string|in:pendente,processando,enviado,entregue,cancelado',
        ]);

        $pedido->status = $request->status;
        $pedido->save();

        return redirect()->route('admin.pedidos.show', $pedido)->with('success', 'Status do pedido atualizado.');
    }

    // (Opcional) Deletar pedido
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('admin.pedidos.index')->with('success', 'Pedido excluído com sucesso.');
    }
}
