<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'BuildForge') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white font-sans antialiased">

@php
    $quantidadeCarrinho = collect(session('carrinho', []))->sum('quantidade');
@endphp

<header class="bg-black shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-orange-500">BuildForge</a>
            
<nav class="space-x-4 flex items-center">
    <a href="{{ url('/') }}" class="hover:text-orange-400 text-white">Home</a>
    <a href="{{ route('produtos.index') }}" class="hover:text-orange-400 text-white">Produtos</a>

        @auth
            @if(auth()->user()->role === 'cliente')
                <a href="{{ route('pedidos.index') }}" class="hover:text-orange-400 text-white">Meus Pedidos</a>
            @endif
        @endauth

    <a href="{{ route('carrinho.index') }}" class="relative hover:text-orange-400 text-white flex items-center gap-1">
        Carrinho
        @php
            $quantidadeCarrinho = collect(session('carrinho', []))->sum('quantidade');
        @endphp
        @if ($quantidadeCarrinho > 0)
            <span class="absolute -top-2 -right-2 bg-orange-500 text-xs text-white rounded-full w-5 h-5 flex items-center justify-center animate-pulse">
                {{ $quantidadeCarrinho }}
            </span>
        @endif
    </a>

    @guest
        <a href="{{ route('login') }}" class="hover:text-orange-400 text-white">Login</a>
    @else
        @role('admin')
            <a href="{{ route('admin.dashboard') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold px-4 py-2 rounded-lg flex items-center gap-2 shadow-md transition duration-300">
                GERENCIAR
            </a>
        @endrole

        <a href="{{ route('profile.show') }}" class="hover:text-orange-400 text-white">Perfil</a>
        <a href="{{ route('logout') }}" class="hover:text-orange-400 text-white"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Sair
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
    @endguest
</nav>


    </div>
</header>

<main class="py-10 bg-black text-white">
    @yield('content')
</main>

</body>
</html>
    