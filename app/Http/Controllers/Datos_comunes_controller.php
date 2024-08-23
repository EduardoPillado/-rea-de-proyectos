<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datos_comunes;

class Datos_comunes_controller extends Controller
{
    private function obtenerDatosDatosComunes(){
        return Datos_comunes::join('direccion', 'datos_comunes.fk_direccion', '=', 'direccion.pk_direccion')
        ->join('ubicacion', 'datos_comunes.fk_ubicacion', '=', 'ubicacion.pk_ubicacion')
        ->join('nacionalidad', 'datos_comunes.fk_nacionalidad', '=', 'nacionalidad.pk_nacionalidad')
        ->with('direccion', 'nacionalidad', 'ubicacion');
    }

    public function mostrarDatosCliente(){
        $datos_cliente = $this->obtenerDatosDatosComunes()->get();
        
        return view('lista_cliente', compact('datos_cliente'));
    }
}
