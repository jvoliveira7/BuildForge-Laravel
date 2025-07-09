<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;

class ProdutoController extends Controller
{
public function index()
{
    $categoriaId = request('categoria');
    if (empty($categoriaId)) {
        $categoriaId = null;
    }
    $ordenar = request('ordenar');
    $search = request('search'); // pega o termo de busca
    $categoriaAtual = $categoriaId ? Categoria::find($categoriaId) : null;

    $query = Produto::with('categoria');

    // Filtra pela categoria
    if ($categoriaId) {
        $query->where('categoria_id', $categoriaId);
    }

    // FILTRO DE BUSCA pelo nome (case insensitive)
    if ($search) {
        $query->where('nome', 'like', '%' . $search . '%');
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
    $categorias = Categoria::all()->unique('nome')->values();

    return view('produtos.index', compact('produtos', 'categorias', 'categoriaAtual'));
}

public function show($id)
{
    $produto = Produto::with(['avaliacoes.user'])->findOrFail($id);
    return view('produtos.show', compact('produto'));

}
}