<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Block;
use App\Models\Piece;

class PieceSeeder extends Seeder
{
    public function run(): void
    {
        $blocks = Block::all();

        foreach ($blocks as $block) {
            for ($i = 1; $i <= 3; $i++) {
                Piece::create([
                    'name' => "Pieza {$i} - {$block->name}",
                    'block_id' => $block->id,
                    'peso_teorico' => rand(10, 50),
                    'estado' => 'Pendiente',
                ]);
            }
        }
    }
}
