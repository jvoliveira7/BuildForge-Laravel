<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class HomeController extends Controller
{
    public function index()
    {
    $produtos = Produto::latest()->take(4)->get(); // Exibe os 4 mais recentes
    return view('home', compact('produtos'));
    }
}
