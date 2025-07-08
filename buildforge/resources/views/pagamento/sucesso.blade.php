@extends('layouts.app')

@section('title', 'Pagamento Aprovado')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-green-600 mb-4">✅ Pagamento Aprovado</h1>
    <p class="text-gray-700 mb-4">Seu pedido foi confirmado com sucesso! Agradecemos pela sua compra.</p>

    <a href="{{ route('pedidos.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Ver meus pedidos
    </a>
</div>
@endsection
