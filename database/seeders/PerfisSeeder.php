<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Seeder;

class PerfisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perfil::create(['nome' => 'Admin', 'nivel' => 0]);
        Perfil::create(['nome' => 'Proprietário', 'nivel' => 1]);
        Perfil::create(['nome' => 'Gerente', 'nivel' => 2]);
        Perfil::create(['nome' => 'Atendente', 'nivel' => 3]);
        Perfil::create(['nome' => 'Chapeiro', 'nivel' => 4]);
        Perfil::create(['nome' => 'Auxiliar Chapeiro', 'nivel' => 5]);
    }
}
