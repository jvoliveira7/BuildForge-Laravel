<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
        public function store(Request $request)
        {
            $request->validate([
                'email' => 'required|email|unique:newsletters,email', 
            ]);

            \DB::table('newsletters')->insert([
                'email' => $request->email,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Mail::to($request->email)->send(new \App\Mail\NewsletterWelcome());

            return back()->with('success', 'E-mail cadastrado com sucesso!');
        }

}
