<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo_pago;

class Tipo_pago_controller extends Controller
{
    public function agregarTipoPago(Request $r){
        $r->validate([
            'nom_tipo_pago' => 'required'
        ]);

        $tip_pag=new Tipo_pago();
        $tip_pag->nom_tipo_pago=$r->nom_tipo_pago;
        $tip_pag->save();

        return response()->json([
            'success' => true,
            'tipo_pago' => $tip_pag
        ]);
    }
}
