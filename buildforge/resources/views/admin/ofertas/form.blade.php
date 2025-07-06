@extends('layouts.app')

@section('title', 'Enviar Oferta')

@section('content')
<div class="container max-w-lg mx-auto bg-white text-black rounded-lg p-8 shadow-lg">
    <h1 class="text-3xl font-bold mb-6 text-center text-blue-700">Enviar Oferta por E-mail</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.ofertas.enviar') }}" method="POST" novalidate>
        @csrf
        <label for="mensagem" class="block font-semibold mb-2">Mensagem da Oferta</label>
        <textarea id="mensagem" name="mensagem" rows="6" required
            class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-600"
            placeholder="Ex: Desconto especial de 20% em todos os produtos até domingo!">{{ old('mensagem') }}</textarea>

        <button type="submit" 
            class="mt-6 w-full bg-blue-600 text-white font-bold py-3 rounded hover:bg-blue-700 transition-colors"
            id="btnEnviar">
            Enviar Oferta
        </button>
    </form>
</div>

<script>
    document.getElementById('btnEnviar').addEventListener('click', function () {
        this.disabled = true;
        this.textContent = 'Enviando...';
        this.form.submit();
    });
</script>
@endsection
