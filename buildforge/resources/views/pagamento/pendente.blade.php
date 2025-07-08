@extends('layouts.app')

@section('title', 'Pagamento Pendente')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-yellow-500 mb-4">⏳ Pagamento Pendente</h1>
    <p class="text-gray-700 mb-4">Seu pagamento ainda está em análise ou aguardando confirmação.</p>
    <p>Você receberá um e-mail assim que o status for atualizado.</p>

    <a href="{{ route('pedidos.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded mt-4 inline-block">
        Ver meus pedidos
    </a>
</div>
@endsection
