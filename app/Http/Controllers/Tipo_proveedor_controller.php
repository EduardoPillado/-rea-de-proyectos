<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo_proveedor;

class Tipo_proveedor_controller extends Controller
{
    public function agregarTipoProveedor(Request $r){
        $r->validate([
            'nom_tipo_proveedor' => 'required'
        ]);

        $tip_prov=new Tipo_proveedor();
        $tip_prov->nom_tipo_proveedor=$r->nom_tipo_proveedor;
        $tip_prov->save();

        return response()->json([
            'success' => true,
            'tipo_proveedor' => $tip_prov
        ]);
    }
}
