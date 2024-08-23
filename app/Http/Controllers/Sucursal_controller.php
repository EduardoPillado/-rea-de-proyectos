<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;

class Sucursal_controller extends Controller
{
    public function agregarSucursal(Request $r){
        $r->validate([
            'nom_sucursal' => 'required',
            'fk_ubicacion_sucursal' => 'required|exists:ubicacion,pk_ubicacion'
        ]);

        $suc=new Sucursal();
        $suc->nom_sucursal=$r->nom_sucursal;
        $suc->fk_ubicacion_sucursal=$r->fk_ubicacion_sucursal;
        $suc->save();

        return response()->json([
            'success' => true,
            'sucursal' => $suc
        ]);
    }
}
