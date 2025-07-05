@extends('layouts.admin')

@section('content')
<div class="text-black bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Pedido #{{ $pedido->id }}</h1>

    <p><strong>Cliente:</strong> {{ $pedido->user->name }} ({{ $pedido->user->email }})</p>
    <p><strong>Status:</strong> {{ ucfirst($pedido->status) }}</p>
    <p><strong>Data do Pedido:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>

    <h2 class="mt-6 text-xl font-semibold">Itens do Pedido:</h2>
    <table class="w-full mt-2 border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Produto</th>
                <th class="border border-gray-300 px-4 py-2">Quantidade</th>
                <th class="border border-gray-300 px-4 py-2">Preço Unitário</th>
                <th class="border border-gray-300 px-4 py-2">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedido->itens as $item)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $item->produto->nome ?? 'Produto removido' }}</td>
                <td class="border border-gray-300 px-4 py-2 text-center">{{ $item->quantidade }}</td>
                <td class="border border-gray-300 px-4 py-2 text-right">R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                <td class="border border-gray-300 px-4 py-2 text-right">R$ {{ number_format($item->preco_unitario * $item->quantidade, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="mt-4 text-right font-bold text-lg">Total: R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>

    {{-- Opcional: Form para alterar status do pedido --}}
    <form action="{{ route('admin.pedidos.update', $pedido) }}" method="POST" class="mt-6">
        @csrf
        @method('PUT')
        <label for="status" class="font-semibold">Atualizar Status:</label>
        <select name="status" id="status" class="border border-gray-300 rounded p-2 ml-2">
            @foreach (['pendente', 'processando', 'enviado', 'entregue', 'cancelado'] as $status)
                <option value="{{ $status }}" @selected($pedido->status == $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
        <button type="submit" class="ml-4 bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Salvar</button>
    </form>
</div>
@endsection
