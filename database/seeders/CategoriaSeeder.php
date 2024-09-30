<?php

namespace Database\Seeders;

use App\Models\Categorias;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorias::create([
            'nome'=> "Acessórios",
            'descricao' => "Acessórios",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categorias::create([
            'nome'=> "Alumínio",
            'descricao' => "Alumínio",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categorias::create([
            'nome'=> "Carvão",
            'descricao' => "Carvão",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categorias::create([
            'nome'=> "Essências",
            'descricao' => "Essências",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categorias::create([
            'nome'=> "Fogareiros",
            'descricao' => "Fogareiros",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categorias::create([
            'nome'=> "Mangueiras e Piteiras",
            'descricao' => "Mangueiras e Piteiras",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categorias::create([
            'nome'=> "Narguiles",
            'descricao' => "Narguiles",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categorias::create([
            'nome'=> "Pegadores",
            'descricao' => "Pegadores",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categorias::create([
            'nome'=> "Pod descartavél",
            'descricao' => "Pod descartavél",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categorias::create([
            'nome'=> "Pratos",
            'descricao' => "Pratos",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categorias::create([
            'nome'=> "Rosh",
            'descricao' => "Rosh",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categorias::create([
            'nome'=> "Stem",
            'descricao' => "Stem",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categorias::create([
            'nome'=> "Vapers",
            'descricao' => "Vapers",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Categorias::create([
            'nome'=> "Vasos",
            'descricao' => "Vasos",
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }
}
