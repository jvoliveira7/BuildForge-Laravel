<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'BuildForge Admin') }} - Painel Administrativo</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 font-sans min-h-screen">

<header class="bg-white shadow p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-orange-600">BuildForge Admin</a>
        <nav class="space-x-4">
            <a href="{{ route('admin.produtos.index') }}" class="hover:text-orange-500">Produtos</a>
            <a href="{{ route('admin.categorias.index') }}" class="hover:text-orange-500">Categorias</a>
            <a href="{{ route('admin.pedidos.index') }}" class="hover:text-orange-500">Pedidos</a>
            <a href="{{ route('home') }}" class="hover:text-orange-500">Voltar ao site</a>  
        </nav>
    </div>
</header>

<main class="container mx-auto p-6">
    @yield('content')
</main>

<footer class="bg-white shadow p-4 mt-12 text-center text-sm text-gray-600">
    &copy; {{ date('Y') }} BuildForge. Todos os direitos reservados.
</footer>

</body>
</html>
