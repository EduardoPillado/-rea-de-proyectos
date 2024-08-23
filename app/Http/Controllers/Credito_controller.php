<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credito;

class Credito_controller extends Controller
{
    function insertar(Request $r){
        $cred=new Credito();

        $cred->dias_credito=$r->dias_credito;
        $cred->tiempo_surtido=$r->tiempo_surtido;

        $cred->save();
        return redirect('/formularioCredito')->with('success', 'Guardado');
    }

    function mostrar(){
        $datos_credito=Credito::all();
        return view('lista_credito', compact('datos_credito'));
    }
}
