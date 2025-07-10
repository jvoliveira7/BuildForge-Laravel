<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $categoriaId = request('categoria');
        if (empty($categoriaId)) {
            $categoriaId = null;
        }
        $ordenar = request('ordenar');
        $search = request('search');
        $categoriaAtual = $categoriaId ? Categoria::find($categoriaId) : null;

        $query = Produto::with('categoria');

        if ($categoriaId) {
            $query->where('categoria_id', $categoriaId);
        }

        if ($search) {
            $query->where('nome', 'like', '%' . $search . '%');
        }

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
        $produto = Produto::with('avaliacoes.user')->findOrFail($id);

        $avaliacoes = $produto->avaliacoes()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('produtos.show', compact('produto', 'avaliacoes'));
    }

    public function carregarAvaliacoes(Produto $produto)
    {
        $avaliacoes = $produto->avaliacoes()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return response()->json([
            'html' => view('partials.avaliacoes', compact('avaliacoes'))->render(),
            'next_page_url' => $avaliacoes->nextPageUrl()
        ]);
    }
}
