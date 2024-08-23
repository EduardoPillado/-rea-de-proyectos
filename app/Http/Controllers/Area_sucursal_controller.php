<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area_sucursal;

class Area_sucursal_controller extends Controller
{
    public function agregarAreaSucursal(Request $r){
        $r->validate([
            'nom_area' => 'required'
        ]);

        $area=new Area_sucursal();
        $area->nom_area=$r->nom_area;
        $area->save();

        return response()->json([
            'success' => true,
            'area_sucursal' => $area
        ]);
    }
}
