@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-orange-500 text-center mb-12 animate-fade-in-down">
            Todos os Produtos
        </h1>

        @if ($produtos->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($produtos as $produto)
                    <div class="flex flex-col bg-gray-900 rounded-lg overflow-hidden shadow-lg hover:scale-105 hover:shadow-2xl transition duration-300">
                        <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}" class="w-full h-48 object-cover">

                        <div class="p-4 flex flex-col flex-grow justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-orange-400">{{ $produto->nome }}</h3>
                                <p class="text-sm text-gray-300 mt-1">{{ $produto->descricao }}</p>
                            </div>

                            <div class="mt-4">
                                <p class="text-orange-500 font-bold text-xl">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>

                                <form action="{{ route('carrinho.adicionar', $produto->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-center bg-orange-500 hover:bg-orange-600 text-white py-2 rounded font-semibold transition">
                                        Adicionar ao Carrinho
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginação --}}
            <div class="mt-10 text-center">
                {{ $produtos->links() }}
            </div>
        @else
            <p class="text-center text-gray-400">Nenhum produto encontrado.</p>
        @endif
    </div>
</div>
@endsection
