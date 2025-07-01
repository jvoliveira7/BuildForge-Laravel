<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'BuildForge') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">BuildForge</h1>
            <nav class="space-x-4">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-500">Home</a>
                <a href="{{ route('produtos.index') }}" class="text-gray-600 hover:text-blue-500">Produtos</a>
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-500">Painel</a>
            </nav>
        </div>
    </header>

    <main class="py-10">
        @yield('content')
    </main>

</body>
</html>
