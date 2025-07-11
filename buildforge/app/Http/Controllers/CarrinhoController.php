<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = session()->get('carrinho', []);
        return view('carrinho.index', compact('carrinho'));
    }

    public function adicionar(Request $request, $id)
{
    $produto = Produto::findOrFail($id);
    $carrinho = session()->get('carrinho', []);

    if (isset($carrinho[$id])) {
        $carrinho[$id]['quantidade']++;
    } else {
        $carrinho[$id] = [
            "produto_id" => $produto->id,
            "nome" => $produto->nome,
            "preco" => $produto->preco,
            "imagem" => $produto->imagem,
            "quantidade" => 1
        ];
    }

    session()->put('carrinho', $carrinho);

    $quantidadeTotal = array_sum(array_column($carrinho, 'quantidade'));
    session()->put('carrinho_quantidade', $quantidadeTotal);

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'quantidadeTotal' => $quantidadeTotal,
        ]);
    }

    return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
}

    public function remover($id)
    {
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            unset($carrinho[$id]);
            session()->put('carrinho', $carrinho);
        }

        $html = view('partials.carrinho', ['carrinho' => $carrinho])->render();

        return response()->json(['html' => $html]);
    }
}
