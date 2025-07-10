<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
      $request->validate([
        
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
], [
    'name.required' => 'O nome é obrigatório.',
    'name.max' => 'O nome não pode ter mais que :max caracteres.',

    'email.required' => 'O e-mail é obrigatório.',
    'email.email' => 'Insira um e-mail válido.',
    'email.unique' => 'Este e-mail já está em uso.',

    'password.required' => 'A senha é obrigatória.',
    'password.confirmed' => 'As senhas não coincidem.',
    'password.min' => 'A senha precisa ter no mínimo :min caracteres.',
]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'cliente', // define o role aqui
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect()->route('home');
    }
}    