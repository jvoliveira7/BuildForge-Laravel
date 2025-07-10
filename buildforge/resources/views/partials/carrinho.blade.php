@if(count($carrinho) > 0)
    @php $total = 0; @endphp
    <div class="space-y-4">
        @foreach ($carrinho as $id => $item)
            @php
                $subtotal = $item['preco'] * $item['quantidade'];
                $total += $subtotal;
            @endphp

            <div class="bg-gray-800 p-4 rounded shadow flex gap-4 items-center item-carrinho transition duration-300 ease-in-out">
                <img src="{{ asset('storage/' . $item['imagem']) }}" class="w-20 h-20 object-cover rounded" alt="{{ $item['nome'] }}">
                <div class="flex-1">
                    <h3 class="font-semibold text-lg">{{ $item['nome'] }}</h3>
                    <p class="text-gray-300">Quantidade: {{ $item['quantidade'] }}</p>
                    <p class="text-orange-400">R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
                </div>
                <button class="btn-remover-item bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded"
                        data-url="{{ route('carrinho.remover', $id) }}">
                    Remover
                </button>
            </div>
        @endforeach

        <div class="mt-8 text-right text-xl font-bold text-orange-500">
            Total: R$ {{ number_format($total, 2, ',', '.') }}
        </div>

        <div class="text-right mt-4">
            <a href="{{ route('checkout') }}"
               class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded inline-block transition">
                Finalizar Pedido
            </a>
        </div>
    </div>
@else
    <p class="text-gray-300 text-lg">🛍️ Seu carrinho está vazio.</p>
@endif
