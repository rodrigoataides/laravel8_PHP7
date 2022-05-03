<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class Menus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create(['nome' => 'Administrador Sys', 'menu_pai' => null, 'route' => 'subMenuAdmin', 'icon' => 'bi-wrench-adjustable-circle-fill', 'ativo' => 1]);
        Menu::create(['nome' => 'Menus', 'menu_pai' => 1, 'route' => 'menu/index', 'icon' => 'bi-menu-button-fill', 'ativo' => 1]);
    }
}
