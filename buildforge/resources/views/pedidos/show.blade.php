@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-600 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-orange-500 mb-6">Detalhes do Pedido #{{ $pedido->id }}</h1>

        <div class="bg-gray-800 p-6 rounded shadow space-y-4">
            <p><strong>Status:</strong> <span class="capitalize">{{ $pedido->status }}</span></p>
            <p><strong>Total:</strong> <span class="text-orange-400">R$ {{ number_format($pedido->total, 2, ',', '.') }}</span></p>
            <p><strong>Data:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>

            <h2 class="text-xl font-semibold mt-6 mb-4 text-orange-400">Itens do Pedido</h2>

            <div class="space-y-4">
                @foreach ($pedido->itens as $item)
                    <div class="flex items-center gap-4 bg-gray-700 p-4 rounded">
                        <img src="{{ asset('storage/' . $item->produto->imagem) }}" alt="{{ $item->produto->nome }}" class="w-20 h-20 object-cover rounded">
                        <div>
                            <p class="font-semibold text-white">{{ $item->produto->nome }}</p>
                            <p>Quantidade: {{ $item->quantidade }}</p>
                            <p>Preço unitário: R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</p>
                            <p>Subtotal: R$ {{ number_format($item->preco_unitario * $item->quantidade, 2, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <a href="{{ route('pedidos.index') }}" class="inline-block mt-8 bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded transition">
            Voltar para Meus Pedidos
        </a>
    </div>
</div>
@endsection
