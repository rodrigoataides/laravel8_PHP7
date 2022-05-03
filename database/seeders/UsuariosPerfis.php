<?php

namespace Database\Seeders;

use App\Models\UsuariosPerfil;
use Illuminate\Database\Seeder;

class UsuariosPerfis extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UsuariosPerfil::create(['user_id' => 1, 'perfil_id' => 1]);
        UsuariosPerfil::create(['user_id' => 2, 'perfil_id' => 1]);
        UsuariosPerfil::create(['user_id' => 3, 'perfil_id' => 1]);
        UsuariosPerfil::create(['user_id' => 4, 'perfil_id' => 1]);
    }
}
