@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white py-16">
    <div class="container mx-auto px-4 max-w-2xl">
        <h2 class="text-3xl font-bold text-orange-500 mb-8">Perfil do Usuário</h2>

        <form method="POST" action="{{ route('profile.update') }}" class="bg-gray-800 p-6 rounded-lg shadow-md space-y-6">
            @csrf
            @method('PATCH')

            <!-- Nome -->
            <div>
                <label for="name" class="block text-sm font-medium text-orange-400">Nome</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 rounded-md focus:ring-orange-500 focus:border-orange-500">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-orange-400">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 rounded-md focus:ring-orange-500 focus:border-orange-500">
            </div>

            <!-- Botão -->
            <div class="flex justify-between">
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2 rounded">
                    Salvar Alterações
                </button>
                <a href="{{ route('home') }}" class="text-orange-400 hover:underline">Voltar para a Home</a>
            </div>
        </form>

        <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
            @csrf
            @method('DELETE')

            <button type="submit" class="text-sm text-red-500 hover:underline">
                Excluir Conta
            </button>
        </form>
    </div>
</div>
@endsection
