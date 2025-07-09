@extends('layouts.app')

@section('content')
<div class="container mx-auto py-16 px-4">
    <h1 class="text-4xl font-extrabold text-orange-500 mb-12 text-center">Painel Administrativo</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-8 justify-center max-w-4xl mx-auto">
        {{-- Card Gerenciar Produtos --}}
        <a href="{{ route('admin.produtos.index') }}"
           class="flex flex-col items-center justify-center bg-gradient-to-r from-orange-500 to-yellow-400 text-white rounded-2xl shadow-xl hover:from-orange-600 hover:to-yellow-500 transition p-8 text-center group">
           
           <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-4 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
             <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V7a2 2 0 00-2-2h-4M8 17h8m-8-4h8m-6 8h6m-6-4h6m-6-4h6" />
           </svg>

           <span class="text-xl font-semibold">🧰 Gerenciar Produtos</span>
           <p class="text-sm mt-2 opacity-80">Adicionar, editar e remover produtos do catálogo</p>
        </a>

        {{-- Card Gerenciar Pedidos --}}
        <a href="{{ route('admin.pedidos.index') }}"
           class="flex flex-col items-center justify-center bg-gradient-to-r from-green-500 to-green-600 text-white rounded-2xl shadow-xl hover:from-green-600 hover:to-green-700 transition p-8 text-center group">
           
           <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-4 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
             <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h2l3 6h8l3-6h2" />
             <path stroke-linecap="round" stroke-linejoin="round" d="M16 10V6a4 4 0 00-8 0v4" />
           </svg>

           <span class="text-xl font-semibold">📦 Gerenciar Pedidos</span>
           <p class="text-sm mt-2 opacity-80">Visualizar e alterar status dos pedidos</p>
        </a>
    </div>
</div>
@endsection
