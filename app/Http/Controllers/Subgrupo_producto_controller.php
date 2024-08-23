<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subgrupo_producto;

class Subgrupo_producto_controller extends Controller
{
    public function agregarSubgrupoProducto(Request $r){
        $r->validate([
            'nom_subgrupo' => 'required',
            'fk_grupo_producto_subgrupo' => 'required|exists:grupo_producto,pk_grupo_producto'
        ]);

        $subgrp_prod=new Subgrupo_producto();
        $subgrp_prod->nom_subgrupo=$r->nom_subgrupo;
        $subgrp_prod->fk_grupo_producto_subgrupo=$r->fk_grupo_producto_subgrupo;
        $subgrp_prod->save();

        return response()->json([
            'success' => true,
            'subgrupo_producto' => $subgrp_prod
        ]);
    }
}
