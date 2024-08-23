<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidad_medida;

class Unidad_medida_controller extends Controller
{
    public function agregarUnidadMedida(Request $r){
        $r->validate([
            'tipo_unidad' => 'required'
        ]);

        $medid=new Unidad_medida();
        $medid->tipo_unidad=$r->tipo_unidad;
        $medid->save();

        return response()->json([
            'success' => true,
            'unidad_medida' => $medid
        ]);
    }
}
