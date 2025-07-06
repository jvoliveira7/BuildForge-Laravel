<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class HomeController extends Controller
{
    public function index()
    {
    $produtos = Produto::inRandomOrder()->take(8)->get(); 
    return view('home', compact('produtos'));
    }
}
