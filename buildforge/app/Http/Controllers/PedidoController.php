<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        // Lista todos os pedidos, paginados
        $pedidos = Pedido::with('user')->latest()->paginate(10);
        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function show(Pedido $pedido)
    {
        // Carrega pedido com itens e usuário
        $pedido->load('itens.produto', 'user');
        return view('admin.pedidos.show', compact('pedido'));
    }

    // Você pode implementar update e destroy se quiser editar ou deletar pedidos.
}
