<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agente;

class Agente_controller extends Controller
{
    public function agregarAgente(Request $r){
        $r->validate([
            'nom_agente' => 'required'
        ]);

        $agt=new Agente();
        $agt->nom_agente=$r->nom_agente;
        $agt->save();

        return response()->json([
            'success' => true,
            'agente' => $agt
        ]);
    }
}
