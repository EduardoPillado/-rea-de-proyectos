<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;

class Ubicacion_controller extends Controller
{
    public function agregarUbicacion(Request $r){
        $r->validate([
            'nom_ubicacion' => 'required',
            'fk_municipio_ubicacion' => 'required|exists:municipio,pk_municipio'
        ]);

        $ubi=new Ubicacion();
        $ubi->nom_ubicacion=$r->nom_ubicacion;
        $ubi->fk_municipio_ubicacion=$r->fk_municipio_ubicacion;
        $ubi->save();

        return response()->json([
            'success' => true,
            'ubicacion' => $ubi
        ]);
    }
}
