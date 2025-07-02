<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-900 text-white">
        <div class="w-full max-w-md p-8 bg-gray-900 rounded-lg shadow-lg">

            <div class="flex items-center justify-center space-x-3 mb-6">
                <x-rpg-forging class="w-8 h-8 text-orange-500" />
                <h2 class="text-3xl font-bold text-orange-500 text-center">Login - BuildForge</h2>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input id="email" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-orange-500 focus:ring-orange-500" 
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Senha')" class="text-white" />
                    <x-text-input id="password" class="block mt-1 w-full bg-gray-800 text-white border-gray-700 focus:border-orange-500 focus:ring-orange-500" 
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-600 text-orange-500 shadow-sm focus:ring-orange-500" name="remember">
                        <span class="ml-2 text-sm text-gray-300">{{ __('Lembrar-me') }}</span>
                    </label>
                </div>

                <!-- Submit -->
                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-400 hover:text-orange-400" href="{{ route('password.request') }}">
                            {{ __('Esqueceu a senha?') }}
                        </a>
                    @endif

                    <x-primary-button class="bg-orange-500 hover:bg-orange-600 focus:ring-orange-400">
                        {{ __('Entrar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
