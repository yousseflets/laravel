<?php

namespace Database\Seeders;

use App\Models\MetodoPagamento;
use Illuminate\Database\Seeder;

class MetodoPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MetodoPagamento::create([
            'descricao' => "Dinheiro",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MetodoPagamento::create([
            'descricao' => "Cartão Crédito",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MetodoPagamento::create([
            'descricao' => "Cartão de Débito",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MetodoPagamento::create([
            'descricao' => "Pix",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
