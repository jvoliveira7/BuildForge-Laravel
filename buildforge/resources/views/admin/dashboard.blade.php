@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <h1 class="text-3xl font-bold text-orange-500 mb-8">Painel Administrativo</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.produtos.index') }}"
           class="bg-orange-500 text-white px-6 py-4 rounded-lg shadow hover:bg-orange-600 transition text-center">
            🧰 Gerenciar Produtos
        </a>
    </div>
</div>
@endsection
