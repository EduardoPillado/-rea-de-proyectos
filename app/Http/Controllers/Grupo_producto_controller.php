<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo_producto;

class Grupo_producto_controller extends Controller
{
    public function agregarGrupoProducto(Request $r){
        $r->validate([
            'nom_grupo' => 'required'
        ]);

        $grp_prod=new Grupo_producto();
        $grp_prod->nom_grupo=$r->nom_grupo;
        $grp_prod->save();

        return response()->json([
            'success' => true,
            'grupo_producto' => $grp_prod
        ]);
    }
}
