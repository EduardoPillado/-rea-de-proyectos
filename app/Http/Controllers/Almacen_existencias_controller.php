<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Almacen_existencias;

class Almacen_existencias_controller extends Controller
{
    private function obtenerDatosAlmacenExistencias(){
        return Almacen_existencias::join('producto', 'almacen_existencias.fk_producto', '=', 'producto.pk_producto')
            ->with('producto');
    }

    public function mostrar(){
        $datos_almacen_existencias = $this->obtenerDatosAlmacenExistencias()->get();

        return view('almacen_existencias', compact('datos_almacen_existencias'));
    }

    public function diezOmenosExistencias(){
        $datos_almacen_existencias = $this->obtenerDatosAlmacenExistencias()
            ->where('almacen_existencias.cant_existencias', '<=', 10)
            ->get();

        return view('almacen_existencias', compact('datos_almacen_existencias'));
    }

    public function doscientasOmasExistencias(){
        $datos_almacen_existencias = $this->obtenerDatosAlmacenExistencias()
            ->where('almacen_existencias.cant_existencias', '>=', 200)
            ->get();

        return view('almacen_existencias', compact('datos_almacen_existencias'));
    }

    public function tresMesesSinCambios(){
        $fechaActual = Carbon::now();

        $fechaLimite = $fechaActual->subMonths(3);

        $datos_almacen_existencias = $this->obtenerDatosAlmacenExistencias()
            ->whereDate('almacen_existencias.fecha_act_existencias', '>=', $fechaLimite)
            ->get();

        return view('almacen_existencias', compact('datos_almacen_existencias'));
    }

    public function seisMesesSinCambios(){
        $fechaActual = Carbon::now();

        $fechaLimite = $fechaActual->subMonths(6);

        $datos_almacen_existencias = $this->obtenerDatosAlmacenExistencias()
            ->whereDate('almacen_existencias.fecha_act_existencias', '>=', $fechaLimite)
            ->get();

        return view('almacen_existencias', compact('datos_almacen_existencias'));
    }

    public function nueveMesesSinCambios(){
        $fechaActual = Carbon::now();

        $fechaLimite = $fechaActual->subMonths(9);

        $datos_almacen_existencias = $this->obtenerDatosAlmacenExistencias()
            ->whereDate('almacen_existencias.fecha_act_existencias', '>=', $fechaLimite)
            ->get();

        return view('almacen_existencias', compact('datos_almacen_existencias'));
    }

    public function onceMesesSinCambios(){
        $fechaActual = Carbon::now();

        $fechaLimite = $fechaActual->subMonths(11);

        $datos_almacen_existencias = $this->obtenerDatosAlmacenExistencias()
            ->whereDate('almacen_existencias.fecha_act_existencias', '<=', $fechaLimite)
            ->get();

        return view('almacen_existencias', compact('datos_almacen_existencias'));
    }
    
    public function filtrarPorRangoFechas(Request $r){
        $fecha_inicio = $r->input('fecha_inicio');
        $fecha_fin = $r->input('fecha_fin');

        $datos_almacen_existencias = $this->obtenerDatosAlmacenExistencias()
            ->whereBetween('almacen_existencias.fecha_act_existencias', [$fecha_inicio, $fecha_fin])
            ->get();

        return view('almacen_existencias', compact('datos_almacen_existencias'));
    }
}
