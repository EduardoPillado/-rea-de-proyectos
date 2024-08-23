<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo_operacion;

class Tipo_operacion_controller extends Controller
{
    public function agregarTipoOperacion(Request $r){
        $r->validate([
            'nom_tipo_operacion' => 'required'
        ]);

        $tip_oper=new Tipo_operacion();
        $tip_oper->nom_tipo_operacion=$r->nom_tipo_operacion;
        $tip_oper->save();

        return response()->json([
            'success' => true,
            'tipo_operacion' => $tip_oper
        ]);
    }
}
