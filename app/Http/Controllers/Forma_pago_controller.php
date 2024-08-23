<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forma_pago;

class Forma_pago_controller extends Controller
{
    public function agregarFormaPago(Request $r){
        $r->validate([
            'nom_forma_pago' => 'required'
        ]);

        $for_pag=new Forma_pago();
        $for_pag->nom_forma_pago=$r->nom_forma_pago;
        $for_pag->save();

        return response()->json([
            'success' => true,
            'forma_pago' => $for_pag
        ]);
    }
}
