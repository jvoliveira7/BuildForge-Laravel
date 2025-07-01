<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Retorna a view resources/views/home.blade.php
        return view('home');
    }
}
