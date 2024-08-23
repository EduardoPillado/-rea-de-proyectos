<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clave_prod_serv_sat;

class Clave_prod_serv_sat_controller extends Controller
{
    public function agregarClaveProdServSat(Request $r){
        $r->validate([
            'clave_serv' => 'required'
        ]);

        $clave=new Clave_prod_serv_sat();
        $clave->clave_serv=$r->clave_serv;
        $clave->save();

        return response()->json([
            'success' => true,
            'clave_prod_serv_sat' => $clave
        ]);
    }
}
