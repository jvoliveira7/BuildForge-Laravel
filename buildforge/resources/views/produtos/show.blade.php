@extends('layouts.app')

@section('content')
@php
    $minhaAvaliacao = $produto->avaliacoes->where('user_id', auth()->id())->first();
    $notaSelecionada = old('nota', $minhaAvaliacao?->nota ?? 0);
@endphp

<div class="max-w-6xl mx-auto py-12 px-6 bg-gray-900 rounded-3xl shadow-lg mt-10 text-gray-100">
    <div class="flex flex-col md:flex-row gap-12 min-h-[450px]">
        
        <!-- Imagem do Produto -->
        <div class="md:w-1/2 flex justify-center items-center">
            <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}"
                 class="max-w-full max-h-[400px] object-contain rounded-xl shadow-lg transition-transform hover:scale-105" />
        </div>

        <!-- Detalhes e Ações -->
        <div class="md:w-1/2 flex flex-col justify-between">
            <div>
                <h1 class="text-4xl font-extrabold mb-6">{{ $produto->nome }}</h1>

                <section class="bg-gray-800 p-6 rounded-xl shadow-inner mb-8">
                    <h2 class="text-xl font-semibold flex items-center gap-2 mb-3">
                        📝 Descrição Geral
                    </h2>
                    <p class="whitespace-pre-line leading-relaxed text-gray-300">
                        {!! nl2br(e($produto->descricao)) !!}
                    </p>

                    <div class="border-t border-gray-700 mt-6 pt-4">
                        <h3 class="text-xl font-semibold flex items-center gap-2 mb-1">
                            💰 Preço
                        </h3>
                        <p class="text-3xl text-yellow-400 font-extrabold">
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </p>
                    </div>
                </section>

                @if ($produto->avaliacoes->count())
                    <div class="mb-6 flex items-center gap-3">
                        <span class="text-yellow-400 text-3xl select-none">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= round($produto->mediaAvaliacoes()))
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                        </span>
                        <span class="text-gray-400 text-sm">
                            ({{ $produto->avaliacoes->count() }} avaliações)
                        </span>
                    </div>
                @endif
            </div>

            <div>
                @if(auth()->user() && auth()->user()->role === 'admin')
                    <a href="{{ route('admin.produtos.edit', $produto->id) }}"
                       class="inline-block w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold shadow transition duration-200 text-center mb-8">
                        ✏️ Editar Produto
                    </a>
                @else
                    <form action="{{ route('carrinho.adicionar', $produto->id) }}" method="POST" class="mb-8">
                        @csrf
                        <button type="submit"
                                class="w-full md:w-auto bg-yellow-500 hover:bg-yellow-600 text-gray-900 px-8 py-3 rounded-xl font-semibold shadow transition duration-200">
                            🛒 Adicionar ao Carrinho
                        </button>
                    </form>
                @endif
            </div>

            @auth
                @if(auth()->user()->role === 'cliente')
                    <section class="border-t border-gray-700 pt-6 mb-8">
                        <h2 class="text-2xl font-bold mb-5">
                            @if($minhaAvaliacao)
                                Editar sua avaliação
                            @else
                                Avaliar este produto
                            @endif
                        </h2>

                        <form action="{{ route('avaliacoes.store', $produto) }}" method="POST" class="space-y-5 max-w-md" id="form-avaliacao">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium mb-1">Nota:</label>
                                <div id="star-rating" class="flex gap-1 cursor-pointer text-3xl text-yellow-400 select-none">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span data-value="{{ $i }}" class="star @if($i <= $notaSelecionada) filled @endif">&#9733;</span>
                                    @endfor
                                </div>
                                <input type="hidden" name="nota" id="nota" value="{{ $notaSelecionada }}" required>
                                @error('nota')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="comentario" class="block text-sm font-medium mb-1">Comentário:</label>
                                <textarea name="comentario" id="comentario" rows="4" class="w-full rounded border border-gray-600 bg-gray-800 text-gray-100 p-2" placeholder="Escreva sua opinião...">{{ old('comentario', $minhaAvaliacao?->comentario) }}</textarea>
                                @error('comentario')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="bg-yellow-500 text-gray-900 px-6 py-3 rounded hover:bg-yellow-600 font-semibold transition duration-200">
                                @if($minhaAvaliacao)
                                    Atualizar Avaliação
                                @else
                                    Enviar Avaliação
                                @endif
                            </button>
                        </form>
                    </section>
                @endif
            @endauth

            @if($produto->avaliacoes->count())
                <section class="border-t border-gray-700 pt-6 max-w-2xl">
                    <h3 class="text-xl font-semibold mb-4">Avaliações dos clientes</h3>
                    <ul class="space-y-6">
                        @foreach($produto->avaliacoes as $avaliacao)
                            <li class="p-4 bg-gray-800 rounded-lg shadow-inner">
                                <div class="flex items-center mb-2">
                                    <span class="text-yellow-400 text-xl select-none">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $avaliacao->nota)
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </span>
                                    <span class="ml-3 text-gray-300 font-semibold">
                                        {{ $avaliacao->user->name ?? 'Usuário' }}
                                    </span>
                                    <span class="ml-auto text-xs text-gray-500">
                                        {{ $avaliacao->created_at->format('d/m/Y') }}
                                    </span>
                                </div>
                                <p class="text-gray-300 whitespace-pre-line">{{ $avaliacao->comentario ?? 'Sem comentário' }}</p>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('#star-rating .star');
    const inputNota = document.getElementById('nota');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const val = parseInt(star.getAttribute('data-value'));
            inputNota.value = val;

            stars.forEach(s => {
                if (parseInt(s.getAttribute('data-value')) <= val) {
                    s.classList.add('filled');
                } else {
                    s.classList.remove('filled');
                }
            });
        });
    });
});
</script>

<style>
.star {
    color: #444;
    transition: color 0.2s;
}
.star.filled {
    color: #fbbf24; /* amarelo */
}
#star-rating .star:hover,
#star-rating .star:hover ~ .star {
    color: #fcd34d !important;
}
</style>
@endsection
