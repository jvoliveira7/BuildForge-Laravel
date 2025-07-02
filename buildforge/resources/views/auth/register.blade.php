<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-black text-white">
        <div class="w-full max-w-md p-8 bg-gray-900 rounded-lg shadow-lg">

            <h2 class="text-3xl font-bold text-orange-500 text-center mb-6">Criar Conta - BuildForge</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nome -->
                <div>
                    <x-input-label for="name" :value="__('Nome')" class="text-white" />
                    <x-text-input id="name" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-orange-500 focus:ring-orange-500" 
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input id="email" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-orange-500 focus:ring-orange-500" 
                        type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Senha -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Senha')" class="text-white" />
                    <x-text-input id="password" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-orange-500 focus:ring-orange-500"
                        type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirmar Senha -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" class="text-white" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-orange-500 focus:ring-orange-500"
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a class="underline text-sm text-gray-400 hover:text-orange-400" href="{{ route('login') }}">
                        {{ __('Já tem uma conta?') }}
                    </a>

                    <x-primary-button class="bg-orange-500 hover:bg-orange-600 focus:ring-orange-400">
                        {{ __('Registrar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
