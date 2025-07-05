<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoControllerAD extends Controller
{
    public function index()
    {
        // Pega todos os pedidos ordenados do mais recente
        $pedidos = Pedido::with('user')->latest()->paginate(15);

        return view('admin.pedidos.index', compact('pedidos'));
    }

    // Edit e Destroy para pedidos
    public function edit(Pedido $pedido)
{
    return view('admin.pedidos.edit', compact('pedido'));
}

public function update(Request $request, Pedido $pedido)
{
    $request->validate([
        'status' => 'required|string|in:aguardando,pago,enviado,cancelado',
    ]);

    $pedido->update([
        'status' => $request->status,
    ]);

    return redirect()->route('admin.pedidos.index')->with('success', 'Status do pedido atualizado!');
}

}
