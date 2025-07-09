@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-6 bg-white rounded-2xl shadow-xl mt-10">
    <div class="flex flex-col md:flex-row gap-10 min-h-[400px]">
        
        <!-- Imagem do produto -->
        <div class="w-full md:w-1/2 flex justify-center items-center">
            <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}"
                class="w-full sm:w-auto max-w-full max-h-[400px] object-contain rounded-xl shadow-md transition-transform hover:scale-105" />
        </div>

        <!-- Informações do produto -->
        <div class="flex-1 flex flex-col justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $produto->nome }}</h1>

                <div class="space-y-6 text-gray-700 text-base leading-relaxed bg-gray-100 p-6 rounded-xl shadow-inner mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                        📝 Descrição Geral
                    </h2>
                    <p class="whitespace-pre-line">
                        {!! nl2br(e($produto->descricao)) !!}
                    </p>

                    <div class="border-t pt-4">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                            💰 Preço
                        </h2>
                        <p class="text-3xl text-orange-500 font-extrabold">
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            @if(auth()->user() && auth()->user()->role === 'admin')
                <a href="{{ route('admin.produtos.edit', $produto->id) }}"
                   class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold shadow transition duration-200 inline-block text-center">
                    ✏️ Editar Produto
                </a>
            @else
                <form action="{{ route('carrinho.adicionar', $produto->id) }}" method="POST" class="mb-4">
                    @csrf
                    <button type="submit"
                        class="w-full md:w-auto bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl font-semibold shadow transition duration-200">
                        🛒 Adicionar ao Carrinho
                    </button>
                </form>
            @endif

            <a href="{{ route('produtos.index') }}"
               class="text-sm text-gray-500 hover:text-orange-500 transition mt-4 inline-block">
                ← Voltar aos produtos
            </a>
        </div>
    </div>
</div>
@endsection
