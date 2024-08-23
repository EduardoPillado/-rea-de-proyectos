<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Moneda;

class Moneda_controller extends Controller
{
    public function agregarMoneda(Request $r){
        $r->validate([
            'nom_moneda' => 'required'
        ]);

        $mon=new Moneda();
        $mon->nom_moneda=$r->nom_moneda;
        $mon->save();

        return response()->json([
            'success' => true,
            'moneda' => $mon
        ]);
    }
}
