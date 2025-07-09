@extends('layouts.app')

@section('content')
<div class="container mx-auto text-white">
    <h1 class="text-2xl font-bold mb-6">Gerenciar Produtos</h1>

    <a href="{{ route('admin.produtos.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded mb-6 inline-block">
        Novo Produto
    </a>

    <!-- Filtro e busca -->
    <form method="GET" action="{{ route('admin.produtos.index') }}" class="flex flex-wrap items-center gap-4 mb-6">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nome..."
               class="px-4 py-2 rounded text-black w-64" />

        <select name="categoria_id" class="px-4 py-2 rounded text-black">
            <option value="">Todas as categorias</option>
            @foreach ($categorias as $cat)
                <option value="{{ $cat->id }}" {{ request('categoria_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->nome }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Filtrar
        </button>
    </form>

    <!-- Tabela de produtos -->
    <table class="table-auto w-full text-left text-white">
        <thead>
            <tr class="border-b border-gray-600">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Preço</th>
                <th class="px-4 py-2">Categoria</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produtos as $produto)
                <tr class="border-t border-gray-700">
                    <td class="px-4 py-2">{{ $produto->id }}</td>
                    <td class="px-4 py-2">{{ $produto->nome }}</td>
                    <td class="px-4 py-2">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td class="px-4 py-2">{{ $produto->categoria->nome ?? 'Sem categoria' }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.produtos.edit', $produto->id) }}" class="text-blue-400 hover:underline">Editar</a>
                        <form action="{{ route('admin.produtos.destroy', $produto->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-gray-400">Nenhum produto encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6">
        {{ $produtos->appends(request()->query())->links() }}
    </div>
</div>
@endsection
