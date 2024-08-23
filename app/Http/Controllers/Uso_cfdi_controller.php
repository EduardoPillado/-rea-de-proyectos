<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uso_cfdi;

class Uso_cfdi_controller extends Controller
{
    public function agregarUsoCfdi(Request $r){
        $r->validate([
            'uso_cfdi' => 'required'
        ]);

        $cfdi=new Uso_cfdi();
        $cfdi->uso_cfdi=$r->uso_cfdi;
        $cfdi->save();

        return response()->json([
            'success' => true,
            'uso_cfdi' => $cfdi
        ]);
    }
}
