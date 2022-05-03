<?php

namespace App\Http\Controllers;

use App\Models\Administracao;
use App\Models\Menu;
use App\Models\PerfisMenu;
use App\Models\UsuariosPerfil;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $param = Administracao::geraIndex();
        return view('menu.menu', ['menus' => $param['menus'], 'nome_fazenda' => $param['nome_fazenda'], 'perfis' => $param['lista_perfis']]);
    }

    public function comboMenu(Request $r){
        return Menu::comboMenu($r->get('select'));
    }

    public function listaMenu(){
        return Menu::listaMenu();
    }

    public function getMenu(Request $r){
        return Menu::getMenuEditar($r->get('menu'));
    }

    public function postMenu(Request $r){
        return Menu::post($r->post());
    }
}
