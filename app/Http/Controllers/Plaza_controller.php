<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plaza;

class Plaza_controller extends Controller
{
    function insertar(Request $r){
        $plaza=new Plaza();

        $plaza->plaza=$r->plaza;

        $plaza->save();

        return redirect('/formularioPlaza')->with('success', 'Guardado');
    }

    function mostrar(){
        $datos_plaza=Plaza::all();
        return view('lista_plaza', compact('datos_plaza'));
    }
}
