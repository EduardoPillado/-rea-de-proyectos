<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo_factura;

class Tipo_factura_controller extends Controller
{
    function insertar(Request $r){
        $tipo_fact=new Tipo_factura();

        $tipo_fact->tipo_factura=$r->tipo_factura;
        $tipo_fact->estatus='Activo';

        $tipo_fact->save();

        return redirect('/formularioTipoFactura')->with('success', 'Guardado');
    }

    function mostrar(){
        $datos_tipo_factura=Tipo_factura::all();
        return view('lista_tipo_factura', compact('datos_tipo_factura'));
    }
}
