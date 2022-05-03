<?php

namespace App\Http\Controllers;

use App\Models\Administracao;
use App\Models\Menu;
use App\Models\Perfil;
use App\Models\UsuariosPerfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $param = Administracao::geraIndex();
        return view('home', ['menus' => $param['menus'], 'nome_fazenda' => $param['nome_fazenda'], 'perfis' => $param['lista_perfis']]);
    }
}
