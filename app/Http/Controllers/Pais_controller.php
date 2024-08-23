<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;

class Pais_controller extends Controller
{
    public function agregarPais(Request $r){
        $r->validate([
            'nom_pais' => 'required'
        ]);

        $pais=new Pais();
        $pais->nom_pais=$r->nom_pais;
        $pais->save();

        return response()->json([
            'success' => true,
            'pais' => $pais
        ]);
    }
}
