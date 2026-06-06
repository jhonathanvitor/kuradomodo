<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('endereco')->insert([
            'endereco' => '<p>Ed. Top Tower – Av. Historiador Rubens de Mendonça, 2368 - 18º andar, Jardim Aclimação – Cuiabá/MT – 78050-000</p>',
            'telefone' => '(65) 99949-0571',
            'email' => 'atendimento@x7fundodeinvestimentorural.com.br',
            'horario_atendimento' => '<p>Segunda a Sexta-feira, das 08:00 às 18:00 <br> Sábado, das 08:00 às 12:00</p>',
        ]);
    }
}
