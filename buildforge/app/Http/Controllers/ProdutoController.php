<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;

class ProdutoController extends Controller
{
    public function index()
    {
        // Pega o ID da categoria via query string (?categoria=ID)
        $categoriaId = request('categoria');

        if ($categoriaId) {
            // Busca produtos da categoria selecionada, ordenados do mais recente
            $produtos = Produto::where('categoria_id', $categoriaId)->latest()->paginate(12);
        } else {
            // Busca todos os produtos
            $produtos = Produto::latest()->paginate(12);
        }

        // Pega todas as categorias para o filtro na view
        $categorias = Categoria::all();

        // Se existir categoria selecionada, pega os dados dela para mostrar na view
        $categoriaAtual = $categoriaId ? Categoria::find($categoriaId) : null;

        return view('produtos.index', compact('produtos', 'categorias', 'categoriaAtual'));
    }
}
