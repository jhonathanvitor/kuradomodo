<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nome' => 'Renegociação'],
            ['nome' => 'Recuperação Judicial'],
            ['nome' => 'Execução'],
            ['nome' => 'Contratos Agrícolas'],
            ['nome' => 'Preservação de Ativos'],
            ['nome' => 'Direito Tributário Rural'],
            ['nome' => 'Questões Ambientais'],
            ['nome' => 'Direito Trabalhista Rural'],
        ];

        foreach ($categorias as $categoria) {
            DB::table('categorias')->insert([
                'nome' => $categoria['nome'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
