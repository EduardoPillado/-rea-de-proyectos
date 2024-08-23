<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regimen_fiscal;

class Regimen_fiscal_controller extends Controller
{
    public function agregarRegimenFiscal(Request $r){
        $r->validate([
            'regimen_fiscal' => 'required'
        ]);

        $reg_fisc=new Regimen_fiscal();
        $reg_fisc->regimen_fiscal=$r->regimen_fiscal;
        $reg_fisc->save();

        return response()->json([
            'success' => true,
            'regimen_fiscal' => $reg_fisc
        ]);
    }
}
