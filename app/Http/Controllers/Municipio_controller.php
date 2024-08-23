<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;

class Municipio_controller extends Controller
{
    public function agregarMunicipio(Request $r){
        $r->validate([
            'nom_municipio' => 'required',
            'fk_estado_municipio' => 'required|exists:estado,pk_estado'
        ]);

        $muni=new Municipio();
        $muni->nom_municipio=$r->nom_municipio;
        $muni->fk_estado_municipio=$r->fk_estado_municipio;
        $muni->save();

        return response()->json([
            'success' => true,
            'municipio' => $muni
        ]);
    }
}
