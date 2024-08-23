<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sistema_riego;

class Sistema_riego_controller extends Controller
{
    public function agregarSistemaRiego(Request $r){
        $r->validate([
            'nom_sistema' => 'required'
        ]);

        $sist_riego=new Sistema_riego();
        $sist_riego->nom_sistema=$r->nom_sistema;
        $sist_riego->save();

        return response()->json([
            'success' => true,
            'sistema_riego' => $sist_riego
        ]);
    }
}
