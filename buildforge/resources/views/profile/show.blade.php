@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-gray-900 rounded-lg shadow text-white">
    <h2 class="text-2xl font-bold text-orange-500 mb-4">Meu Perfil</h2>

    <div class="space-y-2">
        <p><span class="font-semibold">Nome:</span> {{ $user->name }}</p>
        <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
        <p><span class="font-semibold">Função:</span> {{ $user->role }}</p>
    </div>

    <div class="mt-6 flex gap-4">
        <a href="{{ route('profile.edit') }}" class="bg-orange-500 hover:bg-orange-600 px-4 py-2 rounded text-black font-semibold">
            Editar Perfil
        </a>

        <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-white font-semibold">
                Excluir Conta
            </button>
        </form>
    </div>
</div>
@endsection
