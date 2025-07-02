<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'BuildForge') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white font-sans antialiased">

<header class="bg-black shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-orange-500">BuildForge</a>
        <nav class="space-x-4 flex items-center">
            <a href="{{ url('/') }}" class="hover:text-orange-400 text-white">Home</a>
            <a href="{{ route('produtos.index') }}" class="hover:text-orange-400 text-white">Produtos</a>
            @guest
                <a href="{{ route('login') }}" class="hover:text-orange-400 text-white">Login</a>
            @else
                <a href="{{ route('profile.show') }}" class="hover:text-orange-400 text-white">Perfil</a>
                <a href="{{ route('carrinho.index') }}" class="hover:text-orange-400 text-white flex items-center gap-1">
                    <!-- Ícone de carrinho -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.2 6M17 13l1.2 6M6 19a1 1 0 100 2 1 1 0 000-2zm12 0a1 1 0 100 2 1 1 0 000-2z"/>
                    </svg>
                    Carrinho
                </a>
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
