<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;

class HomeController extends Controller
{
    public function index()
    {
    $produtos = Produto::inRandomOrder()->take(8)->get(); 
    $categorias = Categoria::all();

    return view('home', compact('produtos', 'categorias'));
    }
}
