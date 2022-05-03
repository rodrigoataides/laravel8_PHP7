<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Foreach_;

class Menu extends Model
{
    use HasFactory;

    public function getMenu($usuario){
        $perfis_usuario = UsuariosPerfil::where('user_id', $usuario->id)->get(['perfil_id']);
        $menus_perfil = PerfisMenu::whereIn('perfil_id', $perfis_usuario)->get(['menu_id']);
        $menus = Menu::whereIn('id', $menus_perfil)->whereNull('menu_pai')->orderBy('nome')->get();
        //buscar submenus
        foreach ($menus as $menu) {
            //buscar os filhos
            $sub_menus = Menu::where('menu_pai', $menu->id)->orderBy('nome')->get();
            $menu->submenu = $sub_menus;
        }
        //dd($menus);
        return $menus;
    }

    public function comboMenu($select){
        $retorno = [];
        $menus = Menu::whereNull('menu_pai')->where('ativo', 1)->orderBy('nome')->get();
        $menu_options = "<option value=''>Selecione um Menu</option>";
        $selected = "";
        foreach ($menus as $menu) {
            $menu->id == $select ? $selected = " selected " : $selected = "";
            $menu_options.= "<option value='{$menu->id}' {$selected}><i class=\"bi {$menu->icon}\"></i> {$menu->nome}</option>";
        }
        $retorno['combo_menu'] = $menu_options;
        return $retorno;
    }

    public function listaMenu(){
        $retorno = [];
        //buscar os pais
        $menus = Menu::whereNull('menu_pai')->orderBy('nome')->get();
        $menus_lista = [];
        foreach ($menus as $menu) {
            //buscar os perfis
            $perfis_menus = PerfisMenu::where('menu_id', $menu->id)->get(['perfil_id']);
            $perfis = Perfil::whereIn('id', $perfis_menus)->orderBy('nivel')->get();
            $menu->perfis = "";
            $separador = "";
            foreach ($perfis as $perfil) {
                $menu->perfis.= $separador.$perfil->nome;
                $separador = "; ";
            }
            array_push($menus_lista, $menu);
            $sub_menus = Menu::where('menu_pai', $menu->id)->orderBy('nome')->get();
            if(sizeof($sub_menus) > 0){
                foreach ($sub_menus as $sub_menu) {
                    $sub_menu->nome = "<i class=\"bi bi-arrow-return-right\"></i> ".$sub_menu->nome;
                    $sub_menu->menu_pai = $menu->nome;
                    //buscar os perfis
                    $perfis_menus = PerfisMenu::where('menu_id', $sub_menu->id)->get(['perfil_id']);
                    $perfis = Perfil::whereIn('id', $perfis_menus)->orderBy('nivel')->get();
                    $sub_menu->perfis = "";
                    $separador = "";
                    foreach ($perfis as $perfil) {
                        $sub_menu->perfis.= $separador.$perfil->nome;
                        $separador = "; ";
                    }
                    array_push($menus_lista, $sub_menu);
                }
            }
        }
        $retorno['menus_lista'] = $menus_lista;
        return $retorno;
    }

    public function getMenuEditar($menu_id){
        $retorno = [];
        $menu = Menu::find($menu_id);
        //buscar os perfis
        $perfis_menus = PerfisMenu::where('menu_id', $menu->id)->get(['perfil_id']);
        $perfis = Perfil::whereIn('id', $perfis_menus)->orderBy('nivel')->get();
        $retorno['menu'] = $menu;
        $retorno['perfis'] = $perfis;
        return $retorno;
    }

    public function post($menu){
        if($menu['id'] == ""){
            //inserção
            $menuObj = new Menu();
            $menuObj->nome = $menu['nome'];
            $menuObj->menu_pai = $menu['menu_pai'];
            $menuObj->route = $menu['route'];
            $menuObj->icon = $menu['icon'];
            $menuObj->save();
            //incluir os perfis para este menu
            $l = explode(',',$menu['perfis_h']);
            foreach($l as $i){
                $perfil_menu = new PerfisMenu();
                $perfil_menu->perfil_id = $i;
                $perfil_menu->menu_id = $menuObj->id;
                $perfil_menu->save();
            }
            $mensagem['titulo'] = "Cadastro Efetivado";
            $mensagem['mensagem'] = "Cadastro do menu concluído com sucesso!";
        }else{
            //alteracao
            $menuObj = Menu::find($menu['id']);
            $menuObj->nome = $menu['nome'];
            $menuObj->menu_pai = $menu['menu_pai'];
            $menuObj->route = $menu['route'];
            $menuObj->icon = $menu['icon'];
            $menuObj->update();
            //excluir para depois incluir
            $perfis_menu = PerfisMenu::where('menu_id', $menu['id']);
            foreach ($perfis_menu as $p) {
                $p->delete();
            }
            //incluir os perfis para este menu
            $l = explode(',',$menu['perfis_h']);
            foreach($l as $i){
                $perfil_menu = new PerfisMenu();
                $perfil_menu->perfil_id = $i;
                $perfil_menu->menu_id = $menuObj->id;
                $perfil_menu->save();
            }
            $mensagem['titulo'] = "Alteração Concluída";
            $mensagem['mensagem'] = "Alteração do menu concluída com sucesso!";
        }
        $retorno['mensagem'] = $mensagem;
        return $retorno;
    }
}
