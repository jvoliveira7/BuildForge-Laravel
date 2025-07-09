<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Produto;
use App\Models\Categoria;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Adiciona o seeder das categorias
        $this->call(\Database\Seeders\CategoriaSeeder::class);
        $this->call(CategorizarProdutosSeeder::class);

        //Adiciona o seeder de avaliacoes
        $this->call(AvaliacoesSeeder::class);

    }
}
