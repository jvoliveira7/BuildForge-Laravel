<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;

class ProdutoController extends Controller
{
public function index()
{
    $categoriaId = request('categoria');
    $ordenar = request('ordenar');
    $categoriaAtual = $categoriaId ? Categoria::find($categoriaId) : null;

    $query = Produto::query();

    if ($categoriaId) {
        $query->where('categoria_id', $categoriaId);
    }

    // Lógica de ordenação
    switch ($ordenar) {
        case 'preco_asc':
            $query->orderBy('preco', 'asc');
            break;
        case 'preco_desc':
            $query->orderBy('preco', 'desc');
            break;
        case 'nome_asc':
            $query->orderBy('nome', 'asc');
            break;
        case 'nome_desc':
            $query->orderBy('nome', 'desc');
            break;
        case 'recentes':
        default:
            $query->latest();
            break;
    }

    $produtos = $query->paginate(12)->appends(request()->all());
    $categorias = Categoria::all();

    return view('produtos.index', compact('produtos', 'categorias', 'categoriaAtual'));
}

}
