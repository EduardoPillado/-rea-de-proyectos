<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;

class Division_controller extends Controller
{
    public function agregarDivision(Request $r){
        $r->validate([
            'nom_division' => 'required'
        ]);

        $div=new Division();
        $div->nom_division=$r->nom_division;
        $div->save();

        return response()->json([
            'success' => true,
            'division' => $div
        ]);
    }
}
