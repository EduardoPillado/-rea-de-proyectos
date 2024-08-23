<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etapa;

class Etapa_controller extends Controller
{
    public function agregarEtapa(Request $r){
        $r->validate([
            'nom_etapa' => 'required'
        ]);

        $etp=new Etapa();
        $etp->nom_etapa=$r->nom_etapa;
        $etp->save();

        return response()->json([
            'success' => true,
            'etapa' => $etp
        ]);
    }
}
