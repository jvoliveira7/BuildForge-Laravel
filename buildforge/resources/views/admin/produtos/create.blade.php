@extends('layouts.app')

@section('content')
<div class="container mx-auto text-white py-8">
    <h1 class="text-3xl font-bold mb-6">Criar Novo Produto</h1>

    @if ($errors->any())
        <div class="bg-red-600 p-4 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.produtos.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <label class="block mb-2 font-semibold" for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required
            class="w-full px-3 py-2 mb-4 rounded text-black">

        <label class="block mb-2 font-semibold" for="descricao">Descrição</label>
        <textarea name="descricao" id="descricao" rows="4" 
            class="w-full px-3 py-2 mb-4 rounded text-black">{{ old('descricao') }}</textarea>

        <label class="block mb-2 font-semibold" for="preco">Preço (R$)</label>
        <input type="number" step="0.01" min="0" name="preco" id="preco" value="{{ old('preco') }}" required
            class="w-full px-3 py-2 mb-4 rounded text-black">

        <label class="block mb-2 font-semibold" for="categoria_id">Categoria</label>
        <select name="categoria_id" id="categoria_id" required
            class="w-full px-3 py-2 mb-4 rounded text-black">
            <option value="" disabled selected>Selecione uma categoria</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" @selected(old('categoria_id') == $categoria->id)>{{ $categoria->nome }}</option>
            @endforeach
        </select>

        <label class="block mb-2 font-semibold" for="imagem">Imagem</label>
        <input type="file" name="imagem" id="imagem" accept="image/*"
            class="mb-6">

        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded font-semibold">
            Criar Produto
        </button>
        <a href="{{ route('admin.produtos.index') }}" class="ml-4 text-gray-400 hover:underline">Cancelar</a>
    </form>
</div>
@endsection
