<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::insert([
            ['name' => 'Conjunto Altos del Bosque'],
            ['name' => 'Urbanización El Prado'],
            ['name' => 'Edificio Horizonte'],
        ]);
    }
}
