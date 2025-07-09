<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Avaliacao;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function store(Request $request, Produto $produto)
    {
        $request->validate([
            'nota' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:1000',
        ]);

        Avaliacao::updateOrCreate(
            ['user_id' => auth()->id(), 'produto_id' => $produto->id],
            ['nota' => $request->nota, 'comentario' => $request->comentario]
        );

        return redirect()->route('produtos.show', $produto)->with('success', 'Avaliação enviada com sucesso!');
    }
}
