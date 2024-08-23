<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metodo_pago;

class Metodo_pago_controller extends Controller
{
    public function agregarMetodoPago(Request $r){
        $r->validate([
            'nom_metodo' => 'required'
        ]);

        $metod=new Metodo_pago();
        $metod->nom_metodo=$r->nom_metodo;
        $metod->estatus="Activo";
        $metod->save();

        return response()->json([
            'success' => true,
            'metodo_pago' => $metod
        ]);
    }
}
