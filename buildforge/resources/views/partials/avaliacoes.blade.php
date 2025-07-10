@foreach($avaliacoes as $avaliacao)
    <li class="p-4 bg-gray-800 rounded-lg shadow-inner">
        <div class="flex items-center mb-2">
            <span class="text-yellow-400 text-xl select-none">
                @for ($i = 1; $i <= 5; $i++)
                    {{ $i <= $avaliacao->nota ? '★' : '☆' }}
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
