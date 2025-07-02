<?php

namespace App\Http\Controllers;

use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
      $produtos = Produto::latest()->paginate(12); // ou ->get() se não quiser paginação
    return view('produtos.index', compact('produtos'));
    }
}
