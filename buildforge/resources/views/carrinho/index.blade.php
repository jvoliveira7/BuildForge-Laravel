@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-600 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-orange-500 mb-8">Seu Carrinho</h1>

        @if(session('success'))
            <div class="mb-4 text-green-500">{{ session('success') }}</div>
        @endif

        @if(count($carrinho) > 0)
            <div class="space-y-4">
                @php $total = 0; @endphp
                @foreach ($carrinho as $id => $item)
                    @php
                        $subtotal = $item['preco'] * $item['quantidade'];
                        $total += $subtotal;
                    @endphp

                    <div class="bg-gray-800 p-4 rounded shadow flex gap-4 items-center">
                        <img src="{{ asset('storage/' . $item['imagem']) }}" class="w-20 h-20 object-cover rounded" alt="{{ $item['nome'] }}">
                        <div class="flex-1">
                            <h3 class="font-semibold">{{ $item['nome'] }}</h3>
                            <p class="text-gray-300">Quantidade: {{ $item['quantidade'] }}</p>
                            <p class="text-orange-400">R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
                        </div>
                        <form action="{{ route('carrinho.remover', $id) }}" method="POST">
                            @csrf
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Remover</button>
                        </form>
                    </div>
                @endforeach

                <div class="mt-8 text-right text-xl font-bold text-orange-500">
                    Total: R$ {{ number_format($total, 2, ',', '.') }}
                </div>

                {{-- Botão Finalizar Pedido --}}
           <a href="{{ route('checkout') }}" class="px-6 py-3 bg-green-600 text-white rounded hover:bg-green-700 inline-block text-center">
    Checkout
</a>
            </div>
        @else
            <p class="text-gray-400">Seu carrinho está vazio.</p>
        @endif
    </div>
</div>
@endsection
