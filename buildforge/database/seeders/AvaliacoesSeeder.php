<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class AvaliacoesSeeder extends Seeder
{
    public function run()
    {
        $produtos = Produto::all();
        $usuarios = User::pluck('id'); // pega todos os ids de usuários existentes

        foreach ($produtos as $produto) {
            // Se quiser mais de uma avaliação por produto, pode fazer um for ou repeat aqui
            foreach ($usuarios->random(min(2, $usuarios->count())) as $userId) {
                DB::table('avaliacoes')->insertOrIgnore([
                    'user_id' => $userId,
                    'produto_id' => $produto->id,
                    'nota' => rand(3, 5),
                    'comentario' => 'Comentário automático para o produto "' . $produto->nome . '".',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
