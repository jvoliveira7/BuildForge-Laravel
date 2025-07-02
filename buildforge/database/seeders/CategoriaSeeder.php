<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            'Placas de Vídeo',
            'Processadores',
            'Memória RAM',
            'Gabinetes',
            'Mouses',
            'Fontes',
            'Placas-mãe',
            'Coolers',
            'Monitores',
            'Periféricos'
        ];

        foreach ($categorias as $nome) {
            Categoria::create(['nome' => $nome]);
        }
    }
}
