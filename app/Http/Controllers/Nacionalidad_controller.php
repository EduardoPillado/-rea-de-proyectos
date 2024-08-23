<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nacionalidad;

class Nacionalidad_controller extends Controller
{
    public function agregarNacionalidad(Request $r){
        $r->validate([
            'nom_nacionalidad' => 'required'
        ]);

        $nac=new Nacionalidad();
        $nac->nom_nacionalidad=$r->nom_nacionalidad;
        $nac->save();

        return response()->json([
            'success' => true,
            'nacionalidad' => $nac
        ]);
    }
}
