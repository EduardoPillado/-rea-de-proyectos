<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;

class Estado_controller extends Controller
{
    public function agregarEstado(Request $r){
        $r->validate([
            'nom_estado' => 'required',
            'fk_pais_estado' => 'required|exists:pais,pk_pais'
        ]);

        $est=new Estado();
        $est->nom_estado=$r->nom_estado;
        $est->fk_pais_estado=$r->fk_pais_estado;
        $est->save();

        return response()->json([
            'success' => true,
            'estado' => $est
        ]);
    }
}
