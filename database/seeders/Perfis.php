<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Seeder;

class Perfis extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::create(['nome' => 'Admin Sistema', 'nivel' => 0, 'ativo' => 1]);
        Perfil::create(['nome' => 'Master', 'nivel' => 1, 'ativo' => 1]);
        Perfil::create(['nome' => 'Gestor', 'nivel' => 2, 'ativo' => 1]);
        Perfil::create(['nome' => 'Operacional', 'nivel' => 3, 'ativo' => 1]);
    }
}
