<?php

namespace App\Http\Controllers;

use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        // Pega todos os produtos do banco (se existir)
        $produtos = Produto::all();

        // Retorna a view passando os produtos
        return view('produtos.index', compact('produtos'));
    }
}
