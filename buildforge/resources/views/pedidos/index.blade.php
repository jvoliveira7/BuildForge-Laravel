@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 text-black py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">📦 Meus Pedidos</h1>

        @forelse ($pedidos as $pedido)
            <div class="bg-white shadow-lg rounded-xl p-6 mb-6 transition transform hover:scale-[1.02] motion-safe:hover:shadow-xl duration-200">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Pedido #{{ $pedido->id }}
                    </h2>
                    <span class="px-3 py-1 rounded-full text-sm
                        {{ $pedido->status === 'aprovado' ? 'bg-green-100 text-green-800' :
                           ($pedido->status === 'pendente' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-200 text-gray-700') }}">
                        {{ ucfirst($pedido->status) }}
                    </span>
                </div>

                <ul class="text-gray-700 pl-4 list-disc">
                    @foreach ($pedido->itens as $item)
                        <li>
                            <span class="font-medium">{{ $item->quantidade }}x</span> {{ $item->produto->nome }}
                            — <span class="text-gray-600">R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="text-right mt-4">
                    <span class="text-lg font-bold text-indigo-600">
                        Total: R$ {{ number_format($pedido->total, 2, ',', '.') }}
                    </span>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 text-lg">
                Você ainda não fez nenhum pedido.
            </div>
        @endforelse

        {{-- Paginação --}}
        <div class="mt-8">
            {{ $pedidos->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>
@endsection
