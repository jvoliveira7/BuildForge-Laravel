<?php
namespace App\Http\Controllers\Admin;
        use App\Http\Controllers\Controller;
        use App\Models\Produto;
        use App\Models\Categoria;
        use Illuminate\Http\Request;

        class ProdutoControllerAD extends Controller
        {
            // Lista todos os produtos
        public function index(Request $request)
    {
        $query = Produto::with('categoria');

        if ($request->filled('search')) {
            $query->where('nome', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        $produtos = $query->paginate(10)->appends($request->query());
        $categorias = Categoria::all();

        return view('admin.produtos.index', compact('produtos', 'categorias'));
    }

            // Mostra o formulário para criar novo produto
            public function create()
            {
                $categorias = Categoria::all();
                return view('admin.produtos.create', compact('categorias'));
            }

            // Salva novo produto
            public function store(Request $request)
            {
                $request->validate([
                    'nome' => 'required|string|max:255',
                    'descricao' => 'nullable|string',
                    'preco' => 'required|numeric',
                    'categoria_id' => 'required|exists:categorias,id',
                    'imagem' => 'nullable|image|max:2048',
                ]);

                $data = $request->all();

                if ($request->hasFile('imagem')) {
                    $path = $request->file('imagem')->store('produtos', 'public');
                    $data['imagem'] = $path;
                }

                Produto::create($data);

                return redirect()->route('admin.produtos.index')->with('success', 'Produto criado com sucesso!');
            }

            // Form para editar produto
            public function edit(Produto $produto)
            {
                $categorias = Categoria::all();
                return view('admin.produtos.edit', compact('produto', 'categorias'));
            }

            // Atualiza produto
            public function update(Request $request, Produto $produto)
            {
    
                
                $request->validate([
                    'nome' => 'required|string|max:255',
                    'descricao' => 'nullable|string',
                    'preco' => 'required|numeric',
                    'categoria_id' => 'required|exists:categorias,id',
                    'imagem' => 'nullable|image|max:2048',
                ]);

                $data = $request->all();

                if ($request->hasFile('imagem')) {
                    // Opcional: apagar imagem antiga aqui
                    $path = $request->file('imagem')->store('produtos', 'public');
                    $data['imagem'] = $path;
                }

                $produto->update($data);

                return redirect()->route('admin.produtos.index')->with('success', 'Produto atualizado com sucesso!');
            }

    public function destroy(Produto $produto)
    {
        // Opcional: apagar imagem antiga da storage, se existir
        if ($produto->imagem) {
            \Storage::disk('public')->delete($produto->imagem);
        }

        $produto->delete();

        return redirect()->route('admin.produtos.index')->with('success', 'Produto removido com sucesso!');
    }
        }
