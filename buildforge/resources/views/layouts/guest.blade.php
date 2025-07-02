<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'BuildForge') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-black text-white antialiased min-h-screen flex items-center justify-center">

    <div class="w-full max-w-lg mx-4 p-10 bg-gray-900 rounded-3xl shadow-xl">
        {{-- Logo ou nome da aplicação --}}
        <div class="flex items-center justify-center space-x-3 mb-10">
            <x-application-logo class="w-12 h-12 fill-current text-orange-500" />
            <span class="text-orange-500 font-extrabold text-3xl select-none">BuildForge</span>
        </div>

        {{-- Container do formulário --}}
        <div>
            {{ $slot }}
        </div>
    </div>

</body>

</html>
