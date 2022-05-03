<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'RODRIGO DE SOUZA ATAIDES', 'cpf' => '851.553.061-91', 'email' => 'rodrigoataides@gmail.com', 'password' => Hash::make('a1234567')]);
        User::create(['name' => 'ARINAN REY', 'cpf' => '840.165.401-78', 'email' => 'arinanrey@gmail.com', 'password' => Hash::make('a1234567')]);
        User::create(['name' => 'CLOVIS NETTO', 'cpf' => '764.231.231-87', 'email' => 'clovisnetto15@gmail.com', 'password' => Hash::make('a1234567')]);
        User::create(['name' => 'GUSTAVO OLIVEIRA', 'cpf' => '840.165.401-78', 'email' => 'gustavogco@gmail.com', 'password' => Hash::make('a1234567')]);
    }
}
