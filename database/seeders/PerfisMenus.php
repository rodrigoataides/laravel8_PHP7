<?php

namespace Database\Seeders;

use App\Models\PerfisMenu;
use Illuminate\Database\Seeder;

class PerfisMenus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PerfisMenu::create(['perfil_id' => 1, 'menu_id' => 1]);
        PerfisMenu::create(['perfil_id' => 1, 'menu_id' => 2]);
    }
}
