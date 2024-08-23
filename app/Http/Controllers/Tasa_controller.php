<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasa;

class Tasa_controller extends Controller
{
    public function agregarTasa(Request $r){
        $r->validate([
            'cant_tasa' => 'required'
        ]);

        $tas=new Tasa();
        $tas->cant_tasa=$r->cant_tasa;
        $tas->tipo_cambio=$r->tipo_cambio;
        $tas->save();

        return response()->json([
            'success' => true,
            'tasa' => $tas
        ]);
    }
}
