<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iva;

class Iva_controller extends Controller
{
    public function agregarIva(Request $r){
        $r->validate([
            'cant_iva' => 'required'
        ]);

        $iva=new Iva();
        $iva->cant_iva=$r->cant_iva;
        $iva->save();

        return response()->json([
            'success' => true,
            'iva' => $iva
        ]);
    }
}
