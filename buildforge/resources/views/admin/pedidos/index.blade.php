@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold text-green-600 mb-8">Pedidos</h1>

    @if ($pedidos->count())
        <table class="min-w-full bg-white rounded shadow overflow-hidden">
            <thead class="bg-green-500 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Cliente</th>
                    <th class="py-3 px-6 text-left">Data</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr class="border-b hover:bg-green-50">
                        <td class="py-3 px-6">{{ $pedido->id }}</td>
                        <td class="py-3 px-6">{{ $pedido->user->name ?? '—' }}</td>
                        <td class="py-3 px-6">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-3 px-6 font-semibold text-green-700">{{ ucfirst($pedido->status) }}</td>
                        <td class="py-3 px-6 text-center">
                            <a href="{{ route('admin.pedidos.show', $pedido) }}" class="text-green-600 hover:underline">Ver Detalhes</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $pedidos->links() }}
        </div>
    @else
        <p class="text-gray-600">Nenhum pedido encontrado.</p>
    @endif
</div>
@endsection
