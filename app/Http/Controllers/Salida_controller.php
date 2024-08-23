<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salida;
use App\Models\Producto;
use App\Models\Almacen_existencias;

class Salida_controller extends Controller
{
    public function insertar(Request $r){
        $sld=new Salida();

        $sld->descripcion_salida=$r->descripcion_salida;
        $sld->comentario_salida=$r->comentario_salida;
        $sld->fk_tipo_salida=$r->fk_tipo_salida;
        $sld->fecha_salida=$r->fecha_salida;
        $sld->fk_sucursal=$r->fk_sucursal;
        $sld->fk_iva=$r->fk_iva;
        $productosSeleccionados = $r->input('fk_almacen_existencias', []);
        $sld->estatus="Activo";

        $sld->save();

        $importeTotalMN = 0;
        $importeTotalDLS = 0;

        foreach ($productosSeleccionados as $productoId) {
            $cantidad = $r->input('cant_unidades_'.$productoId);

            $producto = Producto::find($productoId);
            $precioUnitarioMN = $producto->precio_unitario_mn;
            $precioUnitarioDLS = $producto->precio_unitario_dls;

            $importeMN = $cantidad * $precioUnitarioMN;
            $importeTotalMN += $importeMN;

            $importeDLS = $cantidad * $precioUnitarioDLS;
            $importeTotalDLS += $importeDLS;

            $sld->productos()->attach($productoId, [
                'cant_unidades' => $cantidad,
                'importe_mn' => $importeMN,
                'importe_dls' => $importeDLS,
            ]);

            $almacenExistencias = Almacen_existencias::where('fk_producto', $productoId)->first();
            if ($almacenExistencias) {
                if ($cantidad <= $almacenExistencias->cant_existencias) {
                    $almacenExistencias->cant_existencias -= $cantidad;
                    $almacenExistencias->fecha_act_existencias = $sld->fecha_salida;
                    $almacenExistencias->save();
                } else {
                    return back()->with('error', 'La cantidad a restar excede las existencias actuales de algún producto');
                }
            } else {
                return back()->with('error', 'El producto seleccionado no tiene existencias en el almacén');
            }
        }
        
        $sld->importe_total_mn = $importeTotalMN;
        $sld->importe_total_dls = $importeTotalDLS;

        $sld->save();

        if ($sld->pk_salida) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    private function obtenerDatosSalida(){
        return Salida::join('tipo_salida', 'salida.fk_tipo_salida', '=', 'tipo_salida.pk_tipo_salida')
        ->join('sucursal', 'salida.fk_sucursal', '=', 'sucursal.pk_sucursal')
        ->join('iva', 'salida.fk_iva', '=', 'iva.pk_iva');
    }

    public function mostrar(){
        $datos_salida = $this->obtenerDatosSalida()->get();

        return view('lista_salida', compact('datos_salida'));
    }

    public function activos(){
        $datos_salida = $this->obtenerDatosSalida()
            ->where('salida.estatus', '=', 'Activo')
            ->get();

        return view('lista_salida', compact('datos_salida'));
    }

    public function bloqueados(){
        $datos_salida = $this->obtenerDatosSalida()
            ->where('salida.estatus', '=', 'Bloqueado')
            ->get();

        return view('lista_salida', compact('datos_salida'));
    }

    public function filtrarPorRangoFechas(Request $r){
        $fecha_inicio = $r->input('fecha_inicio');
        $fecha_fin = $r->input('fecha_fin');

        $datos_salida = $this->obtenerDatosSalida()
            ->whereBetween('salida.fecha_salida', [$fecha_inicio, $fecha_fin])
            ->get();

        return view('lista_salida', compact('datos_salida'));
    }

    public function bloquear($pk_salida){
        $dato = Salida::findOrFail($pk_salida);
    
        if (!$dato) {
            Session()->flash('error', 'No se encontró la salida');
            return redirect()->back();
        }
        
        foreach ($dato->productos as $producto) {
            $cantidad = $producto->pivot->cant_unidades;
            $almacenExistencias = Almacen_existencias::where('fk_producto', $producto->pk_producto)->first();
    
            if ($almacenExistencias) {
                $almacenExistencias->cant_existencias += $cantidad;
                $almacenExistencias->save();
            }
        }
    
        $dato->estatus = 'Bloqueado';
        $dato->save();
    
        Session()->flash('success', 'Salida bloqueada');
        return redirect()->back();
    }

    public function activar($pk_salida){
        $dato = Salida::findOrFail($pk_salida);

        if (!$dato) {
            Session()->flash('error', 'No se encontró la salida');
            return redirect()->back();
        }

        foreach ($dato->productos as $producto) {
            $cantidad = $producto->pivot->cant_unidades;
            $almacenExistencias = Almacen_existencias::where('fk_producto', $producto->pk_producto)->first();

            if ($almacenExistencias) {
                $almacenExistencias->cant_existencias -= $cantidad;
                $almacenExistencias->save();
            }
        }

        $dato->estatus = 'Activo';
        $dato->save();

        Session()->flash('success', 'Salida activada');
        return redirect()->back();
    }

    public function allInfo($pk_salida){
        $datos_salida = $this->obtenerDatosSalida()
        ->where('salida.pk_salida', $pk_salida)
        ->first();
    
        if ($datos_salida) {
            return view('listaCompleta_salida')->with('datos_salida', [$datos_salida]);
        } else {
            return redirect()->route('listadoSalida')->with('message', 'El registro no existe.');
        }
    }
}
