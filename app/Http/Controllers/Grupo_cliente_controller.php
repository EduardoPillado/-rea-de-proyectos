<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo_cliente;

class Grupo_cliente_controller extends Controller
{
    public function agregarGrupoCliente(Request $r){
        $r->validate([
            'nom_grupo' => 'required'
        ]);

        $grp_cli=new Grupo_cliente();
        $grp_cli->nom_grupo=$r->nom_grupo;
        $grp_cli->save();

        return response()->json([
            'success' => true,
            'grupo_cliente' => $grp_cli
        ]);
    }
}
