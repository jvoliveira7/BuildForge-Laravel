@extends('layouts.app')

@section('content')
<div class="container mx-auto text-white">
    <h1 class="text-2xl font-bold mb-4">Gerenciar Produtos</h1>

    <a href="{{ route('admin.produtos.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded mb-4 inline-block">
        Novo Produto
    </a>

    <table class="table-auto w-full text-left text-white">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Preço</th>
                <th class="px-4 py-2">Categoria</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
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
            @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        {{ $produtos->links() }}
    </div>
</div>
@endsection
