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

    {{-- Sobre a BuildForge --}}
    <section class="py-16 bg-gray-900 flex justify-center px-4">
        <div 
            class="max-w-4xl bg-gray-800 rounded-xl shadow-2xl p-10 text-center text-gray-300
                   transform opacity-0 translate-y-8
                   animate-fadeInUp
                   hover:scale-[1.03] hover:shadow-orange-500/50 transition-all duration-500 ease-out"
            style="animation-fill-mode: forwards;"
        >
            <h2 class="text-3xl font-bold text-orange-400 mb-6">Sobre a BuildForge</h2>
            <p class="text-lg leading-relaxed">
                Na BuildForge, nossa missão é fornecer hardware de alta qualidade para gamers, profissionais e entusiastas de tecnologia.
                Com uma curadoria cuidadosa dos melhores componentes e preços competitivos, buscamos oferecer a melhor experiência para quem quer montar ou atualizar seu PC.
                Somos apaixonados por tecnologia e inovação, e estamos sempre prontos para ajudar você a encontrar o equipamento ideal para suas necessidades.
            </p>
        </div>
    </section>

    {{-- Animação customizada no seu CSS --}}
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
    </style>

    {{-- Produtos em Destaque --}}
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-orange-400">Destaques da Loja</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($produtos as $produto)
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow hover:shadow-xl transition">
                        <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-white">{{ $produto->nome }}</h3>
                            <p class="text-sm text-gray-300">{{ $produto->descricao }}</p>
                            <p class="mt-2 text-orange-400 font-semibold text-lg">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                            <a href="{{ route('produtos.index') }}" class="mt-4 inline-block text-sm text-orange-500 hover:underline">
                                Ver mais
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Newsletter --}}
    <section class="py-16 bg-orange-500 text-black text-center">
        <h2 class="text-2xl font-bold mb-4">Assine nossa newsletter</h2>
        <p class="mb-6">Fique por dentro das ofertas e novidades da BuildForge.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4 max-w-md mx-auto">
            <input type="email" placeholder="Seu e-mail" class="px-4 py-2 rounded w-full sm:w-auto">
            <button class="bg-black text-orange-500 px-6 py-2 rounded hover:bg-gray-800">
                Cadastrar
            </button>
        </div>
    </section>

</div>
@endsection
