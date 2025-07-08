@extends('layouts.app')

@section('title', 'Pagamento Falhou')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-red-600 mb-4">❌ Pagamento Falhou</h1>
    <p class="text-gray-700 mb-4">Não foi possível processar o pagamento. Tente novamente ou escolha outro método.</p>

    <a href="{{ route('carrinho.index') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
        Voltar ao carrinho
    </a>
</div>
@endsection
