<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Producto;
use App\Models\Almacen_existencias;

class Entrada_controller extends Controller
{
    public function insertar(Request $r){
        $ent=new Entrada();

        $ent->descripcion_entrada=$r->descripcion_entrada;
        $ent->comentario_entrada=$r->comentario_entrada;
        $ent->fk_tipo_entrada=$r->fk_tipo_entrada;
        $ent->fecha_entrada=$r->fecha_entrada;
        $ent->fk_sucursal=$r->fk_sucursal;
        $ent->fk_iva=$r->fk_iva;
        $productosSeleccionados = $r->input('fk_producto', []);
        $ent->estatus="Activo";

        $ent->save();

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

            $ent->productos()->attach($productoId, [
                'cant_unidades' => $cantidad,
                'importe_mn' => $importeMN,
                'importe_dls' => $importeDLS,
            ]);

            $almacenExistencias = Almacen_existencias::where('fk_producto', $productoId)->first();
            if ($almacenExistencias) {
                $almacenExistencias->cant_existencias += $cantidad;
                $almacenExistencias->fecha_act_existencias = $ent->fecha_entrada;
                $almacenExistencias->save();
            } else {
                $almacenExistencias = new Almacen_existencias();
                $almacenExistencias->fk_producto = $productoId;
                $almacenExistencias->cant_existencias = $cantidad;
                $almacenExistencias->fecha_act_existencias = $ent->fecha_entrada;
                $almacenExistencias->save();
            }
        }
        
        $ent->importe_total_mn = $importeTotalMN;
        $ent->importe_total_dls = $importeTotalDLS;

        $ent->save();

        if ($ent->pk_entrada) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    private function obtenerDatosEntrada(){
        return Entrada::join('tipo_entrada', 'entrada.fk_tipo_entrada', '=', 'tipo_entrada.pk_tipo_entrada')
        ->join('sucursal', 'entrada.fk_sucursal', '=', 'sucursal.pk_sucursal')
        ->join('iva', 'entrada.fk_iva', '=', 'iva.pk_iva');
    }

    public function mostrar(){
        $datos_entrada = $this->obtenerDatosEntrada()->get();

        return view('lista_entrada', compact('datos_entrada'));
    }

    public function activos(){
        $datos_entrada = $this->obtenerDatosEntrada()
            ->where('entrada.estatus', '=', 'Activo')
            ->get();

        return view('lista_entrada', compact('datos_entrada'));
    }

    public function bloqueados(){
        $datos_entrada = $this->obtenerDatosEntrada()
            ->where('entrada.estatus', '=', 'Bloqueado')
            ->get();

        return view('lista_entrada', compact('datos_entrada'));
    }

    public function filtrarPorRangoFechas(Request $r){
        $fecha_inicio = $r->input('fecha_inicio');
        $fecha_fin = $r->input('fecha_fin');

        $datos_entrada = $this->obtenerDatosEntrada()
            ->whereBetween('entrada.fecha_entrada', [$fecha_inicio, $fecha_fin])
            ->get();

        return view('lista_entrada', compact('datos_entrada'));
    }

    public function bloquear($pk_entrada){
        $dato = Entrada::findOrFail($pk_entrada);
    
        if (!$dato) {
            Session()->flash('error', 'No se encontró la entrada');
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
    
        $dato->estatus = 'Bloqueado';
        $dato->save();
    
        Session()->flash('success', 'Entrada bloqueada');
        return redirect()->back();
    }

    public function activar($pk_entrada){
        $dato = Entrada::findOrFail($pk_entrada);

        if (!$dato) {
            Session()->flash('error', 'No se encontró la entrada');
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

        $dato->estatus = 'Activo';
        $dato->save();

        Session()->flash('success', 'Entrada activada');
        return redirect()->back();
    }

    public function allInfo($pk_entrada){
        $datos_entrada = $this->obtenerDatosEntrada()
        ->where('entrada.pk_entrada', $pk_entrada)
        ->first();
    
        if ($datos_entrada) {
            return view('listaCompleta_entrada')->with('datos_entrada', [$datos_entrada]);
        } else {
            return redirect()->route('listadoEntrada')->with('message', 'El registro no existe.');
        }
    }
}
