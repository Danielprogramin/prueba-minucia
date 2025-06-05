<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        
        User::create([
            'name' => 'Operario Luis',
            'email' => 'luis@minucia.com',
            'password' => Hash::make('0000'),
        ]);
        
        User::create([
            'name' => 'Operario Gabriel',
            'email' => 'gabriel@minucia.com',
            'password' => Hash::make('1111'),
        ]);
        
        User::create([
            'name' => 'Operario Sergio',
            'email' => 'sergio@minucia.com',
            'password' => Hash::make('2222'), 
        ]);
    }
}
