<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Block;

class BlockSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            for ($i = 1; $i <= 2; $i++) {
                Block::create([
                    'name' => "Bloque {$i} - {$project->name}",
                    'project_id' => $project->id,
                ]);
            }
        }
    }
}
