<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::insert([
            ['name' => 'Proyecto A'],
            ['name' => 'Proyecto B'],
            ['name' => 'Proyecto C'],
        ]);
    }
}
