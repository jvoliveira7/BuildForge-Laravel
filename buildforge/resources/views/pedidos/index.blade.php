@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-600 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-orange-500 mb-8">Meus Pedidos</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-600 rounded text-white shadow">{{ session('success') }}</div>
        @endif

        @if($pedidos->count())
            <div class="space-y-4">
                @foreach ($pedidos as $pedido)
                    <div class="bg-gray-800 p-6 rounded shadow hover:shadow-lg transition flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div class="mb-4 md:mb-0">
                            <p class="font-semibold text-lg">Pedido #{{ $pedido->id }}</p>
                            <p>Status: <span class="capitalize">{{ $pedido->status }}</span></p>
                            <p>Total: <span class="text-orange-400">R$ {{ number_format($pedido->total, 2, ',', '.') }}</span></p>
                            <p>Data: {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <a href="{{ route('pedidos.show', $pedido->id) }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded transition">
                            Ver Detalhes
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $pedidos->links() }}
            </div>
        @else
            <p class="text-gray-400 mt-4">Você ainda não realizou nenhum pedido.</p>
        @endif
    </div>
</div>
@endsection
