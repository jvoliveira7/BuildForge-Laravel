@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-600 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-orange-500 mb-8">Confirmação do Pedido</h1>

        @if(session('error'))
            <div class="mb-4 text-red-400">{{ session('error') }}</div>
        @endif

        <div class="space-y-4">
            @foreach ($carrinho as $item)
                <div class="bg-gray-800 p-4 rounded shadow flex gap-4 items-center">
                    <img src="{{ asset('storage/' . $item['imagem']) }}" class="w-20 h-20 object-cover rounded" alt="{{ $item['nome'] }}">
                    <div class="flex-1">
                        <h3 class="font-semibold">{{ $item['nome'] }}</h3>
                        <p class="text-gray-300">Quantidade: {{ $item['quantidade'] }}</p>
                        <p class="text-orange-400">Preço Unitário: R$ {{ number_format($item['preco'], 2, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-green-400 font-bold">Subtotal: R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 text-right text-2xl font-bold text-orange-500">
            Total: R$ {{ number_format($total, 2, ',', '.') }}
        </div>

        <form action="{{ route('pedido.finalizar') }}" method="POST" class="mt-8 text-right">
            @csrf
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg text-lg font-semibold">
                Finalizar Pedido
            </button>
        </form>

        <div class="mt-4 text-right">
            <a href="{{ route('carrinho.index') }}" class="text-sm text-gray-300 hover:underline">Voltar ao Carrinho</a>
        </div>
    </div>
</div>
@endsection
