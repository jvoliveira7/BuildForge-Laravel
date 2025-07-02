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
        // Cria usuários de teste
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Adiciona o seeder das categorias
        $this->call(\Database\Seeders\CategoriaSeeder::class);
        $this->call(CategorizarProdutosSeeder::class);
    }
}
