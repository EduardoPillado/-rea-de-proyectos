<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo_salida;

class Tipo_salida_controller extends Controller
{
    public function agregarTipoSalida(Request $r){
        $r->validate([
            'nom_salida' => 'required'
        ]);

        $tipo_sal=new Tipo_salida();
        $tipo_sal->nom_salida=$r->nom_salida;
        $tipo_sal->save();

        return response()->json([
            'success' => true,
            'tipo_salida' => $tipo_sal
        ]);
    }
}
