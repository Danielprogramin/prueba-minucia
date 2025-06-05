<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Block;

class BlockSeeder extends Seeder
{
    public function run(): void
    {
        $bloquesPorProyecto = [
            'Conjunto Altos del Bosque' => ['Bloque 1', 'Bloque 2'],
            'Urbanización El Prado' => ['Etapa A', 'Etapa B'],
            'Edificio Horizonte' => ['Torre Norte', 'Torre Sur'],
        ];

        foreach ($bloquesPorProyecto as $projectName => $blockNames) {
            $project = Project::where('name', $projectName)->first();

            foreach ($blockNames as $blockName) {
                Block::create([
                    'name' => $blockName,
                    'project_id' => $project->id
                ]);
            }
        }
    }
}
