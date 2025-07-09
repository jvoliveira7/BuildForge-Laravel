<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'BuildForge Admin') }} - Painel Administrativo</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 font-sans min-h-screen flex flex-col">

    <!-- Cabeçalho -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-orange-600 hover:text-orange-700 transition">
                BuildForge Admin
            </a>
            <nav class="space-x-6 text-sm font-medium">
                <a href="{{ route('admin.produtos.index') }}" class="text-gray-700 hover:text-orange-500 transition">Produtos</a>
                <a href="{{ route('admin.categorias.index') }}" class="text-gray-700 hover:text-orange-500 transition">Categorias</a>
                <a href="{{ route('admin.pedidos.index') }}" class="text-gray-700 hover:text-orange-500 transition">Pedidos</a>
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-orange-500 transition">Voltar ao site</a>
            </nav>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="flex-1 container mx-auto px-6 py-8">
        @yield('content')
    </main>

    <!-- Rodapé -->
    <footer class="bg-gray-200 text-center text-sm text-gray-600 py-4">
        &copy; {{ date('Y') }} <span class="font-semibold">BuildForge</span>. Todos os direitos reservados.
    </footer>

</body>
</html>
