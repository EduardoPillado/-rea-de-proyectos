<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo_entrada;

class Tipo_entrada_controller extends Controller
{
    public function agregarTipoEntrada(Request $r){
        $r->validate([
            'nom_entrada' => 'required'
        ]);

        $tipo_ent=new Tipo_entrada();
        $tipo_ent->nom_entrada=$r->nom_entrada;
        $tipo_ent->save();

        return response()->json([
            'success' => true,
            'tipo_entrada' => $tipo_ent
        ]);
    }
}
