<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cultivo;

class Cultivo_controller extends Controller
{
    public function agregarCultivo(Request $r){
        $r->validate([
            'nom_cultivo' => 'required'
        ]);

        $cult=new Cultivo();
        $cult->nom_cultivo=$r->nom_cultivo;
        $cult->save();

        return response()->json([
            'success' => true,
            'cultivo' => $cult
        ]);
    }
}
