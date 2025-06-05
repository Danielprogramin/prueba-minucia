<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Block;
use App\Models\Piece;

class PieceSeeder extends Seeder
{
    public function run(): void
    {
        $nombresDePiezas = [
            'Panel de Fachada PF-100',
            'Losa Prefabricada LP-200',
            'Viga Longitudinal VL-150',
            'Dintel Reforzado DR-75',
            'Muro Cortante MC-300',
        ];

        foreach (Block::all() as $block) {
            $cantidad = rand(3, 5);

            foreach (array_slice($nombresDePiezas, 0, $cantidad) as $nombre) {
                Piece::create([
                    'name' => $nombre,
                    'block_id' => $block->id,
                    'peso_teorico' => rand(50, 120),
                    'estado' => 'Pendiente',
                ]);
            }
        }
    }
}
