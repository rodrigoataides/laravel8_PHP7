<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function comboPerfil(Request $r){
        return Perfil::comboPerfil($r->get('select'));
    }
}
