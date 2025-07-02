<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;
use App\Models\Categoria;

class CategorizarProdutosSeeder extends Seeder
{
    public function run(): void
    {
        $mapaCategorias = [
            'Monitores'         => ['monitor', 'display', 'tela'],
            'Fontes'            => ['fonte', 'psu', 'power supply'],
            'Placas de Vídeo'   => ['geforce', 'rtx', 'gtx', 'radeon', 'gpu'],
            'Processadores'     => ['ryzen', 'intel core', 'i3', 'i5', 'i7', 'i9', 'cpu'],
            'Memória RAM'       => ['memória ram', 'ddr4', 'ddr5'],
            'Mouses'            => ['mouse'],
            'Teclados'          => ['teclado', 'keyboard'],
            'Placas-mãe'        => ['placa-mãe', 'placa mãe', 'motherboard'],
            'Gabinetes'         => ['gabinete', 'case'],
            'Armazenamento'     => ['ssd', 'hd', 'hdd', 'nvme', 'armazenamento'],
        ];
        $categorias = Categoria::all()->keyBy(fn($cat) => strtolower($cat->nome));

        foreach (Produto::all() as $produto) {
            $nome = strtolower($produto->nome);

            foreach ($mapaCategorias as $nomeCategoria => $palavrasChave) {
                foreach ($palavrasChave as $termo) {
                    if (preg_match('/\b' . preg_quote($termo, '/') . '\b/', $nome)) {
                        $produto->categoria_id = $categorias[strtolower($nomeCategoria)]->id ?? null;
                        $produto->save();
                        echo "Produto '{$produto->nome}' categorizado como '{$nomeCategoria}'\n";
                        break 2; // Para o loop após primeira correspondência
                    }
                }
            }
        }
    }
}
