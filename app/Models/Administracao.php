<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Administracao extends Model
{
    use HasFactory;

    public function geraIndex(){
        $retorno = [];
        //pegar usuario logada
        $user = Auth::user();
        // em todo index buscar o menu.
        $menus = Menu::getMenu($user);
        // buscar qual fazenda pertence o usuário
        // se for admin sys trazer a identificacao de admin.
        $perfis_usuario = UsuariosPerfil::where('user_id', $user->id)->get(['perfil_id']);
        $perfis = Perfil::whereIn('id', $perfis_usuario)->orderBy('nivel')->get();
        $nome_fazenda = "";
        if($perfis_usuario[0]->perfil_id == 1){
            $nome_fazenda = "Fazenda Info Administração";
        }else{

        }
        $lista_perfis = "";
        $separate = "";
        foreach ($perfis as $perfil) {
            $lista_perfis.= $separate.$perfil->nome;
            $separate = " ; ";
        }
        $retorno['menus'] = $menus;
        $retorno['nome_fazenda'] = $nome_fazenda;
        $retorno['lista_perfis'] = $lista_perfis;
        return $retorno;
    }
}
