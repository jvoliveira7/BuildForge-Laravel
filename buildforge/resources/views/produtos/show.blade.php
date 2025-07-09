@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-4 bg-gray-100 rounded shadow-md">
    <div class="flex flex-col md:flex-row gap-8">
        <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}" class="w-full md:w-1/2 rounded shadow-md">

        <div class="flex-1">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $produto->nome }}</h1>
            <p class="text-lg text-gray-600 mb-6">{{ $produto->descricao }}</p>
            <p class="text-2xl text-green-600 font-semibold mb-6">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>

            <form action="{{ route('carrinho.adicionar', $produto->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                    Adicionar ao Carrinho
                </button>
            </form>

            <a href="{{ route('produtos.index') }}" class="block mt-4 text-sm text-blue-500 hover:underline">← Voltar aos produtos</a>
        </div>
    </div>
</div>
@endsection
