<?php

namespace Database\Seeders;

use App\Models\Categoria;
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
        Categoria::create(['nome' => 'Combo', 'ativo' => 1]);
        Categoria::create(['nome' => 'Hamburguer', 'ativo' => 1]);
        Categoria::create(['nome' => 'Acompanhamento', 'ativo' => 1]);
        Categoria::create(['nome' => 'Bebida', 'ativo' => 1]);
    }
}
