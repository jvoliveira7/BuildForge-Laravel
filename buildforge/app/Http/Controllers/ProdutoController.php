<?php

namespace App\Http\Controllers;

use App\Models\Produto;

class ProdutoController extends Controller
{
public function index()
{
    $categoriaId = request('categoria'); // pega ?categoria=ID da URL
    
    if ($categoriaId) {
        $produtos = Produto::where('categoria_id', $categoriaId)->latest()->paginate(12);
    } else {
        $produtos = Produto::latest()->paginate(12);
    }

    // Também carrega as categorias para mostrar na view
    $categorias = \App\Models\Categoria::all();

    // Se quiser pegar a categoria atual para exibir o nome, faz assim:
    $categoriaAtual = $categoriaId ? \App\Models\Categoria::find($categoriaId) : null;

    return view('produtos.index', compact('produtos', 'categorias', 'categoriaAtual'));
}
}