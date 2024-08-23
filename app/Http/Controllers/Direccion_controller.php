<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direccion;

class Direccion_controller extends Controller
{
    function insertar(Request $r){
        $direc=new Direccion();

        $direc->calle=$r->calle;
        $direc->numero=$r->numero;
        $direc->colonia=$r->colonia;
        $direc->cp=$r->cp;

        $direc->save();
        return redirect('/formularioDireccion')->with('success', 'Guardado');
    }

    function mostrar(){
        $datos_direccion=Direccion::all();
        return view('lista_direccion', compact('datos_direccion'));
    }
}
