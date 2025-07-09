@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-orange-500 text-center mb-12 animate-fade-in-down">
            Produtos @if($categoriaAtual) da categoria "{{ $categoriaAtual->nome }}" @else Todos @endif
        </h1>

        {{-- Formulário unificado para busca, categoria e ordenação --}}
        <form action="{{ route('produtos.index') }}" method="GET" class="mb-10 flex flex-wrap justify-center gap-4 items-center">

            {{-- Campo Busca --}}
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Buscar por nome..." 
                class="px-4 py-2 rounded w-64 text-black"
            />

            {{-- Dropdown Categorias --}}
            <div class="relative inline-block text-left" id="categoria-dropdown">
                <button type="button" onclick="toggleMenu()" class="inline-flex items-center justify-center px-6 py-2 bg-orange-500 text-black font-semibold rounded hover:bg-orange-600 transition">
                    Categorias
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div id="categoria-menu" class="hidden origin-top absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 z-50">
                    <div class="py-1">
                        <a href="{{ route('produtos.index', array_merge(request()->except('categoria'), ['categoria' => null])) }}"
                           class="categoria-option block px-4 py-2 text-sm {{ is_null($categoriaAtual) ? 'bg-orange-500 text-black font-bold' : 'text-white hover:bg-gray-700' }}">
                            Todas as Categorias
                        </a>
                        @foreach ($categorias as $cat)
                            <a href="{{ route('produtos.index', array_merge(request()->except('categoria'), ['categoria' => $cat->id])) }}"
                               class="categoria-option block px-4 py-2 text-sm {{ $categoriaAtual && $categoriaAtual->id === $cat->id ? 'bg-orange-500 text-black font-bold' : 'text-white hover:bg-gray-700' }}">
                                {{ $cat->nome }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Filtro de Ordenação --}}
            <select name="ordenar" onchange="this.form.submit()"
                class="appearance-none inline-flex items-center px-6 py-2 bg-orange-500 text-black font-semibold rounded hover:bg-orange-600 transition cursor-pointer pr-10">
                <option value="">Ordenar por</option>
                <option value="preco_asc" {{ request('ordenar') == 'preco_asc' ? 'selected' : '' }}>Menor Preço</option>
                <option value="preco_desc" {{ request('ordenar') == 'preco_desc' ? 'selected' : '' }}>Maior Preço</option>
                <option value="nome_asc" {{ request('ordenar') == 'nome_asc' ? 'selected' : '' }}>Nome (A-Z)</option>
                <option value="nome_desc" {{ request('ordenar') == 'nome_desc' ? 'selected' : '' }}>Nome (Z-A)</option>
                <option value="recentes" {{ request('ordenar') == 'recentes' ? 'selected' : '' }}>Mais Recentes</option>
            </select>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Filtrar
            </button>
        </form>

        {{-- Produtos --}}
        @if ($produtos->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($produtos as $produto)
                    <div class="flex flex-col bg-gray-900 rounded-lg overflow-hidden shadow-lg hover:scale-105 hover:shadow-2xl transition duration-300">
                        <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}" class="w-full h-48 object-cover">

                        <div class="p-4 flex flex-col flex-grow justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-orange-400">{{ $produto->nome }}</h3>
                                <p class="text-sm text-gray-300 mt-1">{{ Str::limit($produto->descricao, 80) }}</p>
                            </div>

                            <div class="mt-4">
                                <p class="text-orange-500 font-bold text-xl">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>

                                                @unless(auth()->user() && auth()->user()->role === 'admin')
                            <form action="{{ route('carrinho.adicionar', $produto->id) }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit"
                                    class="w-full text-center bg-orange-500 hover:bg-orange-600 text-white py-2 rounded font-semibold transition">
                                    Adicionar ao Carrinho
                                </button>
                            </form>
                        @endunless
                        
                                <a href="{{ route('produtos.show', $produto->id) }}"
                                   class="block mt-2 text-center bg-gray-700 hover:bg-gray-600 text-white py-2 rounded font-semibold transition">
                                    Ver Detalhes
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 text-center">
                {{ $produtos->appends(request()->query())->links() }}
            </div>
        @else
            <p class="text-center text-gray-400">Nenhum produto encontrado.</p>
        @endif
    </div>
</div>

{{-- JS para o menu dropdown --}}
<script>
    const menu = document.getElementById('categoria-menu');
    const dropdown = document.getElementById('categoria-dropdown');

    function toggleMenu() {
        menu.classList.toggle('hidden');
    }

    document.addEventListener('click', function (e) {
        if (!dropdown.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });

    document.querySelectorAll('.categoria-option').forEach(el => {
        el.addEventListener('click', () => {
            menu.classList.add('hidden');
        });
    });
</script>
@endsection
