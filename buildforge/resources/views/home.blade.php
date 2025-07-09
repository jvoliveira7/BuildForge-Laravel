@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white">

    {{-- Hero --}}
    <section class="py-20 bg-orange-500 text-center">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold mb-4">Hardware de Alta Performance</h1>
            <p class="text-lg mb-8">Ofertas exclusivas em tecnologia de ponta para você!</p>
            <a href="{{ route('produtos.index') }}" class="px-6 py-3 bg-black text-orange-500 rounded hover:bg-gray-800 font-semibold">
                Ver Produtos
            </a>
        </div>
    </section>

    {{-- Categorias rápidas --}}
    @if($categorias->count())
    <section class="py-10 bg-gray-950 text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-orange-400 mb-4">Navegue por Categoria</h2>
            <div class="flex flex-wrap justify-center gap-4">
                @foreach ($categorias as $cat)
                    <a href="{{ route('produtos.index', ['categoria' => $cat->id]) }}"
                       class="categoria-btn px-4 py-2 bg-gray-800 text-white rounded transition duration-300">
                        {{ $cat->nome }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Produtos em Destaque --}}
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-orange-400">Destaques da Loja</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($produtos as $produto)
                    <div class="produto-card bg-gray-800 rounded-lg overflow-hidden shadow transition duration-300 flex flex-col">
                        <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}" class="w-full h-48 object-contain bg-white p-4">
                        <div class="p-4 flex flex-col justify-between flex-grow">
                            <div>
                                <h3 class="text-lg font-bold text-white">{{ $produto->nome }}</h3>
                                <p class="text-sm text-gray-300 mb-2">{{ Str::limit($produto->descricao, 60) }}</p>
                                <p class="text-orange-400 font-semibold text-lg">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('produtos.show', $produto->id) }}"
                               class="mt-4 inline-block text-sm text-orange-400 hover:text-orange-300">
                                Ver detalhes →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Benefícios --}}
    <section class="py-14 bg-gray-950 text-white">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div>
                <span class="text-4xl">🚚</span>
                <h3 class="font-bold text-lg mt-2">Frete Rápido</h3>
                <p class="text-sm text-gray-400">Entregamos em todo o Brasil com agilidade.</p>
            </div>
            <div>
                <span class="text-4xl">🛡️</span>
                <h3 class="font-bold text-lg mt-2">Compra Segura</h3>
                <p class="text-sm text-gray-400">Ambiente protegido com criptografia SSL.</p>
            </div>
            <div>
                <span class="text-4xl">💳</span>
                <h3 class="font-bold text-lg mt-2">Vários Pagamentos</h3>
                <p class="text-sm text-gray-400">Pix, cartão, boleto e Mercado Pago.</p>
            </div>
        </div>
    </section>

    {{-- Sobre a BuildForge --}}
    <section class="py-16 bg-gray-900 flex justify-center px-4">
        <div class="max-w-4xl bg-gray-800 rounded-xl shadow-2xl p-10 text-center text-gray-300 animate-fadeInUp hover:scale-[1.03] hover:shadow-orange-500/50 transition-all duration-500 ease-out">
            <h2 class="text-3xl font-bold text-orange-400 mb-6">Sobre a BuildForge</h2>
            <p class="text-lg leading-relaxed">
                Na BuildForge, nossa missão é fornecer hardware de alta qualidade para gamers, profissionais e entusiastas de tecnologia.
                Com uma curadoria cuidadosa dos melhores componentes e preços competitivos, buscamos oferecer a melhor experiência para quem quer montar ou atualizar seu PC.
                Somos apaixonados por tecnologia e inovação, e estamos sempre prontos para ajudar você a encontrar o equipamento ideal para suas necessidades.
            </p>
        </div>
    </section>

    {{-- Newsletter --}}
    <section class="py-16 bg-orange-500 text-black text-center">
        <h2 class="text-2xl font-bold mb-4">Assine nossa newsletter</h2>
        <p class="mb-6">Fique por dentro das ofertas e novidades da BuildForge.</p>
        <form action="{{ route('newsletter.store') }}" method="POST" class="flex flex-col sm:flex-row justify-center gap-4 max-w-md mx-auto">
            @csrf
            <input 
                type="email" 
                name="email" 
                placeholder="Seu e-mail" 
                required
                class="px-4 py-2 rounded w-full sm:w-auto"
            >
            <button type="submit" class="bg-black text-orange-500 px-6 py-2 rounded hover:bg-gray-800">
                Cadastrar
            </button>
        </form>

        @if(session('success'))
            <p class="mt-4 text-green-700 font-semibold">{{ session('success') }}</p>
        @endif
    </section>

    {{-- Contato com Suporte --}}
    <section class="py-14 bg-gray-950 text-white text-center">
        <div class="container mx-auto px-4 max-w-3xl">
            <h2 class="text-3xl font-bold text-orange-400 mb-6">Precisa de ajuda? Fale com nosso suporte!</h2>
            <p class="mb-4 text-gray-300">Estamos disponíveis para esclarecer dúvidas, ajudar com pedidos ou resolver qualquer problema.</p>
            <p class="text-lg font-semibold">📞 Telefone: <a href="tel:+5511999999999" class="text-orange-500 hover:underline">+55 (11) 99999-9999</a></p>
            <p class="text-lg font-semibold">✉️ E-mail: <a href="mailto:suporte@buildforge.com.br" class="text-orange-500 hover:underline">suporte@buildforge.com.br</a></p>
            <p class="text-lg font-semibold mt-4">⏰ Horário de atendimento: Seg - Sex, 9h às 18h</p>
        </div>
    </section>

    {{-- Rodapé --}}
    <footer class="bg-black text-gray-400 text-sm py-10">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h3 class="font-bold text-orange-400 mb-2">BuildForge</h3>
                <p>Rua Exemplo, 123 - São Paulo, SP</p>
                <p>CNPJ: 12.345.678/0001-99</p>
            </div>
            <div>
                <p>© {{ now()->year }} BuildForge. Todos os direitos reservados.</p>
            </div>
            <div class="flex gap-4 text-orange-500 text-xl">
                <a href="#" aria-label="Facebook" title="Facebook" class="hover:text-orange-400">📘</a>
                <a href="#" aria-label="Instagram" title="Instagram" class="hover:text-orange-400">📸</a>
                <a href="#" aria-label="Twitter" title="Twitter" class="hover:text-orange-400">🐦</a>
            </div>
        </div>
    </footer>

</div>

{{-- Estilo da animação --}}
<style>
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(2rem);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .animate-fadeInUp {
      animation-name: fadeInUp;
      animation-duration: 0.8s;
      animation-timing-function: ease-out;
      animation-fill-mode: forwards;
    }
 
    .produto-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 12px 20px rgba(255, 165, 0, 0.6);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        z-index: 10;
        position: relative;
    }

    .categoria-btn:hover {
        background-color: #f97316; 
        color: black;
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(249, 115, 22, 0.5);
        transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }
</style>
@endsection
