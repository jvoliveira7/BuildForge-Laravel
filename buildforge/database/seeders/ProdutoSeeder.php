<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdutoSeeder extends Seeder
{
 public function run()
    {
        DB::table('produtos')->insert([
            [
                'nome' => 'Memória RAM Kingston 8GB DDR4',
                'descricao' => 'Velocidade de 2666MHz, ideal para desktops gamers.',
                'preco' => 189.90,
                'imagem' => 'produtos/ram-kingston.jpg',
            ],
            [
                'nome' => 'Mouse Gamer Logitech G502',
                'descricao' => 'Sensor Hero 25K, 11 botões programáveis, RGB.',
                'preco' => 349.90,
                'imagem' => 'produtos/mouse-logitech.jpg',
            ],
            [
                'nome' => 'Gabinete Gamer Redragon GC-609',
                'descricao' => 'Mid Tower com vidro temperado e 3 fans RGB inclusos.',
                'preco' => 459.99,
                'imagem' => 'produtos/gabinete-redragon.jpg',
            ],
            [
                'nome' => 'SSD Kingston A400 480GB',
                'descricao' => 'Leitura de até 500MB/s e escrita de até 450MB/s.',
                'preco' => 289.00,
                'imagem' => 'produtos/ssd-kingston.jpg',
            ],
            [
                'nome' => 'Placa de Vídeo GTX 1660 Super 6GB',
                'descricao' => 'Desempenho ideal para jogos em Full HD.',
                'preco' => 1299.99,
                'imagem' => 'produtos/gtx1660.jpg',
            ],
            [
                'nome' => 'Fonte Corsair 650W 80 Plus Bronze',
                'descricao' => 'Alta eficiência com certificação 80 Plus.',
                'preco' => 499.90,
                'imagem' => 'produtos/fonte-corsair.jpg',
            ],
            [
                'nome' => 'Processador AMD Ryzen 5 5600G',
                'descricao' => '6 núcleos, 12 threads, com gráficos integrados Vega.',
                'preco' => 899.00,
                'imagem' => 'produtos/ryzen-5600g.jpg',
            ],
            [
                'nome' => 'Placa-Mãe ASUS B450M-Plus TUF Gaming',
                'descricao' => 'Compatível com Ryzen de 1ª a 5ª geração.',
                'preco' => 599.90,
                'imagem' => 'produtos/asus-b450m.jpg',
            ],

            [
                'nome' => 'HD 1 TB Seagate Barracuda',
                'descricao' => 'HD SATA III de 7200RPM, ideal para armazenar seus jogos e arquivos.',
                'preco' => 319.00,
                'imagem' => 'produtos/hd-barracuda.jpg',
            ],
        ]);
    }
}