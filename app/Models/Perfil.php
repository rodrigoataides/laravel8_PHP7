<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    public function comboPerfil($select){
        $retorno = [];
        $perfis = Perfil::where('ativo', 1)->orderBy('nivel')->get();
        $perfil_options = "<option value=''>Selecione um Perfil</option>";
        $select = "";
        foreach ($perfis as $perfil) {
            $perfil->id == $select ? $select = " selected " : $select = "";
            $perfil_options.= "<option value='{$perfil->id}' {$select}>{$perfil->nivel} - {$perfil->nome}</option>";
        }
        $retorno['combo_perfil'] = $perfil_options;
        return $retorno;
    }
}
