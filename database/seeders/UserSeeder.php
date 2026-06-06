<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria um usuário administrador
        \App\Models\User::create([
            'name' => 'jhonathan',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'), // Use uma senha forte
            'role' => 'admin',
        ]);
    }
}
