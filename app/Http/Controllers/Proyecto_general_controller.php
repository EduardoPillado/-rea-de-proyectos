<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Proyecto_general;
use App\Models\Producto;

class Proyecto_general_controller extends Controller
{
    public function insertar(Request $r){
        $proy=new Proyecto_general();

        $proy->fk_cliente=$r->fk_cliente;
        $proy->nom_proyecto_general=$r->nom_proyecto_general;
        $proy->fk_sucursal=$r->fk_sucursal;
        $productosSeleccionados = $r->input('fk_almacen_existencias', []);
        $proy->fk_sistema_riego=$r->fk_sistema_riego;
        $proy->fk_cultivo=$r->fk_cultivo;
        $proy->fecha_inicio=$r->fecha_inicio;
        $proy->superficie=$r->superficie;
        $proy->vigencia_dias=$r->vigencia_dias;
        $proy->predio=$r->predio;
        $proy->fk_categoria_proyecto=$r->fk_categoria_proyecto;
        $proy->fk_etapa=$r->fk_etapa;
        $proy->fk_cotizacion=$r->fk_cotizacion;
        $proy->nom_ubicacion_proyecto=$r->nom_ubicacion_proyecto;
        if ($r->hasFile('imagen_ubicacion')) {
            $path = str_replace('/', DIRECTORY_SEPARATOR, $r->file('imagen_ubicacion')->store('public/img_ubicaciones'));
            $proy->imagen_ubicacion=$path;
        }
        if ($r->hasFile('plano_pdf')) {
            $path = str_replace('/', DIRECTORY_SEPARATOR, $r->file('plano_pdf')->store('public/planos_pdf'));
            $proy->plano_pdf=$path;
        }
        $proy->fk_empleado=$r->fk_empleado;
        $proy->estatus='Activo';

        $proy->save();

        $importeTotalMN = 0;
        $importeTotalDLS = 0;

        foreach ($productosSeleccionados as $productoId) {
            $cantidad = $r->input('cant_unidades_'.$productoId);
            $descuento = $r->input('descuento_'.$productoId);

            $producto = Producto::find($productoId);
            $precioUnitarioMN = $producto->precio_unitario_mn;
            $precioUnitarioDLS = $producto->precio_unitario_dls;

            $importeMN = $cantidad * $precioUnitarioMN;
            $importeMN -= $importeMN * ($descuento / 100);
            $importeTotalMN += $importeMN;

            $importeDLS = $cantidad * $precioUnitarioDLS;
            $importeDLS -= $importeDLS * ($descuento / 100);
            $importeTotalDLS += $importeDLS;

            $proy->productos()->attach($productoId, [
                'cant_unidades' => $cantidad,
                'descuento' => $descuento,
                'importe_mn' => $importeMN,
                'importe_dls' => $importeDLS,
            ]);
        }
        
        $proy->importe_total_mn = $importeTotalMN;
        $proy->cantidad_restante_mn = $importeTotalMN;
        $proy->importe_total_dls = $importeTotalDLS;
        $proy->cantidad_restante_dls = $importeTotalDLS;

        $proy->save();

        if ($proy->pk_proyecto_general) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    private function obtenerDatosProyecto(){
        return Proyecto_general::join('cliente', 'proyecto_general.fk_cliente', '=', 'cliente.pk_cliente')
            ->join('sucursal', 'proyecto_general.fk_sucursal', '=', 'sucursal.pk_sucursal')
            ->join('sistema_riego', 'proyecto_general.fk_sistema_riego', '=', 'sistema_riego.pk_sistema_riego')
            ->join('cultivo', 'proyecto_general.fk_cultivo', '=', 'cultivo.pk_cultivo')
            ->join('categoria_proyecto', 'proyecto_general.fk_categoria_proyecto', '=', 'categoria_proyecto.pk_categoria_proyecto')
            ->join('etapa', 'proyecto_general.fk_etapa', '=', 'etapa.pk_etapa')
            ->join('empleado', 'proyecto_general.fk_empleado', '=', 'empleado.pk_empleado')
            ->select('proyecto_general.*', 'cliente.estatus as cliente_estatus', 'empleado.estatus as empleado_estatus')
            ->with('productos', 
                'empleado', 
                'cliente', 
                'cotizacion', 
                'proyecto_producto', 
                'sucursal', 
                'sistema_riego', 
                'cultivo', 
                'categoria_proyecto',
                'etapa'
            );
    }

    public function mostrar(){
        $datos_proyecto_general = $this->obtenerDatosProyecto()->get();
        
        return view('lista_proyecto_general', compact('datos_proyecto_general'));
    }

    public function activos(){
        $datos_proyecto_general = $this->obtenerDatosProyecto()
            ->where('proyecto_general.estatus', '=', 'Activo')
            ->get();
        
        return view('lista_proyecto_general', compact('datos_proyecto_general'));
    }

    public function bloqueados(){
        $datos_proyecto_general = $this->obtenerDatosProyecto()
            ->where('proyecto_general.estatus', '=', 'Bloqueado')
            ->get();

        return view('lista_proyecto_general', compact('datos_proyecto_general'));
    }

    public function creados(){
        $datos_proyecto_general = $this->obtenerDatosProyecto()
            ->where(function($query) {
                $query->whereRaw('UPPER(etapa.nom_etapa) LIKE ?', ['%CREADO%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(etapa.nom_etapa) LIKE ?', ['%CREADOS%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(etapa.nom_etapa) LIKE ?', ['%creado%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(etapa.nom_etapa) LIKE ?', ['%creados%']);
            })
            ->get();
    
        if ($datos_proyecto_general->count() === 0) {
            return redirect()->back()->with('message', 'No se encontraron proyectos creados.');
        }
    
        return view('lista_proyecto_general', compact('datos_proyecto_general'));
    }

    public function aprobados() {
        $datos_proyecto_general = $this->obtenerDatosProyecto()
            ->where(function($query) {
                $query->whereRaw('UPPER(etapa.nom_etapa) LIKE ?', ['%APROBADO%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(etapa.nom_etapa) LIKE ?', ['%APROBADOS%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(etapa.nom_etapa) LIKE ?', ['%aprobado%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(etapa.nom_etapa) LIKE ?', ['%aprobados%']);
            })
            ->get();
    
        if ($datos_proyecto_general->count() === 0) {
            return redirect()->back()->with('message', 'No se encontraron proyectos aprobados.');
        }
    
        return view('lista_proyecto_general', compact('datos_proyecto_general'));
    }

    public function cotizados(){
        $datos_proyecto_general = $this->obtenerDatosProyecto()
            ->where(function($query) {
                $query->whereRaw('UPPER(etapa.nom_etapa) LIKE ?', ['%COTIZADO%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(etapa.nom_etapa) LIKE ?', ['%COTIZADOS%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(etapa.nom_etapa) LIKE ?', ['%COTIZACION%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(etapa.nom_etapa) LIKE ?', ['%cotizado%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(etapa.nom_etapa) LIKE ?', ['%cotizados%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(etapa.nom_etapa) LIKE ?', ['%cotizacion%']);
            })
            ->get();
    
        if ($datos_proyecto_general->count() === 0) {
            return redirect()->back()->with('message', 'No se encontraron proyectos cotizados.');
        }
    
        return view('lista_proyecto_general', compact('datos_proyecto_general'));
    }

    public function finalizados(){
        $datos_proyecto_general = $this->obtenerDatosProyecto()
            ->where(function($query) {
                $query->whereRaw('UPPER(etapa.nom_etapa) LIKE ?', ['%FINALIZADO%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(etapa.nom_etapa) LIKE ?', ['%FINALIZADOS%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(etapa.nom_etapa) LIKE ?', ['%finalizado%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(etapa.nom_etapa) LIKE ?', ['%finalizados%']);
            })
            ->get();
    
        if ($datos_proyecto_general->count() === 0) {
            return redirect()->back()->with('message', 'No se encontraron proyectos finalizados.');
        }
    
        return view('lista_proyecto_general', compact('datos_proyecto_general'));
    }

    public function filtrarPorRangoFechas(Request $r){
        $fecha_inicio = $r->input('fecha_inicio');
        $fecha_fin = $r->input('fecha_fin');

        $datos_proyecto_general = $this->obtenerDatosProyecto()
            ->whereBetween('proyecto_general.fecha_inicio', [$fecha_inicio, $fecha_fin])
            ->get();

        return view('lista_proyecto_general', compact('datos_proyecto_general'));
    }

    public function bloquear($pk_proyecto_general){
        $dato = Proyecto_general::findOrFail($pk_proyecto_general);
        
        if ($dato) {
            $dato->estatus = 'Bloqueado';
            $dato->save();

            Session()->flash('success', 'Proyecto bloqueado');
            return redirect()->back();
        } else {
            Session()->flash('error', 'Hubo un problema al bloquear');
            return redirect()->back();
        }
    }

    public function activar($pk_proyecto_general){
        $dato = Proyecto_general::findOrFail($pk_proyecto_general);

        if ($dato) {
            $dato->estatus = 'Activo';
            $dato->save();
            
            Session()->flash('success', 'Proyecto activado');
            return redirect()->back();
        } else {
            Session()->flash('error', 'Hubo un problema al activar');
            return redirect()->back();
        }
    }

    public function allInfo($pk_proyecto_general){
        $datos_proyecto_general = $this->obtenerDatosProyecto()
        ->where('proyecto_general.pk_proyecto_general', $pk_proyecto_general)
        ->with('cotizacion')
        ->first();
    
        if ($datos_proyecto_general) {
            if ($datos_proyecto_general->cotizacion) {
                return view('listaCompleta_proyecto_general_cotizacion')->with('datos_proyecto_general', [$datos_proyecto_general]);
            } else {
                return view('listaCompleta_proyecto_general')->with('datos_proyecto_general', [$datos_proyecto_general]);
            }
        } else {
            return redirect()->route('proyectosRegistrados')->with('message', 'El registro no existe.');
        }
    }

    public function descargarImagen($pk_proyecto_general){
        $imagen = Proyecto_general::findOrFail($pk_proyecto_general);
        $rutaImagen = $imagen->imagen_ubicacion;

        if (!is_null($rutaImagen) && Storage::exists($rutaImagen)) {
            $nombreImagen = basename($rutaImagen);
            $rutaCompletaImagen = storage_path('app/' . $rutaImagen);

            return response()->download($rutaCompletaImagen, $nombreImagen, [
                'Content-Type' => mime_content_type($rutaCompletaImagen)
            ]);
        } else {
            Session::flash('error', 'La imagen no existe');
            return redirect()->back();
        }
    }

    public function descargarPlano($pk_proyecto_general){
        $plano = Proyecto_general::findOrFail($pk_proyecto_general);
        $rutaPlano = $plano->plano_pdf;

        if (!is_null($rutaPlano) && Storage::exists($rutaPlano)) {
            $nombrePlano = basename($rutaPlano);
            $rutaCompletaPlano = storage_path('app/' . $rutaPlano);

            return response()->download($rutaCompletaPlano, $nombrePlano, [
                'Content-Type' => mime_content_type($rutaCompletaPlano)
            ]);
        } else {
            Session::flash('error', 'El plano no existe');
            return redirect()->back();
        }
    }

    public function actualizado($pk_proyecto_general){
        $datos_proyecto_general=Proyecto_general::findOrFail($pk_proyecto_general);
        return view('editar_proyecto_general', compact('datos_proyecto_general'));
    }

    public function update(Request $r, $pk_proyecto_general){
        $datos_proyecto_general=Proyecto_general::findOrFail($pk_proyecto_general);

        $datos_proyecto_general->fk_cliente=$r->fk_cliente;
        $datos_proyecto_general->nom_proyecto_general=$r->nom_proyecto_general;
        $datos_proyecto_general->fk_sucursal=$r->fk_sucursal;
        $productosSeleccionados = $r->input('fk_almacen_existencias', []);
        $productosActualizados = [];
        $datos_proyecto_general->fk_sistema_riego=$r->fk_sistema_riego;
        $datos_proyecto_general->fk_cultivo=$r->fk_cultivo;
        $datos_proyecto_general->fecha_inicio=$r->fecha_inicio;
        $datos_proyecto_general->superficie=$r->superficie;
        $datos_proyecto_general->vigencia_dias=$r->vigencia_dias;
        $datos_proyecto_general->predio=$r->predio;
        $datos_proyecto_general->fk_categoria_proyecto=$r->fk_categoria_proyecto;
        $datos_proyecto_general->fk_etapa=$r->fk_etapa;
        $datos_proyecto_general->fk_cotizacion=$r->fk_cotizacion;
        $datos_proyecto_general->nom_ubicacion_proyecto=$r->nom_ubicacion_proyecto;
        if ($r->hasFile('imagen_ubicacion')) {
            $path = str_replace('/', DIRECTORY_SEPARATOR, $r->file('imagen_ubicacion')->store('public/img_ubicaciones'));
            $datos_proyecto_general->imagen_ubicacion=$path;
        }
        if ($r->hasFile('plano_pdf')) {
            $path = str_replace('/', DIRECTORY_SEPARATOR, $r->file('plano_pdf')->store('public/planos_pdf'));
            $datos_proyecto_general->plano_pdf=$path;
        }
        $datos_proyecto_general->fk_empleado=$r->fk_empleado;

        $datos_proyecto_general->save();

        $importeTotalMN = 0;
        $importeTotalDLS = 0;

        foreach ($productosSeleccionados as $productoId) {
            $cantidad = $r->input('cant_unidades_'.$productoId);
            $descuento = $r->input('descuento_'.$productoId);

            $producto = Producto::find($productoId);
            $precioUnitarioMN = $producto->precio_unitario_mn;
            $precioUnitarioDLS = $producto->precio_unitario_dls;

            $importeMN = $cantidad * $precioUnitarioMN;
            $importeMN -= $importeMN * ($descuento / 100);
            $importeTotalMN += $importeMN;

            $importeDLS = $cantidad * $precioUnitarioDLS;
            $importeDLS -= $importeDLS * ($descuento / 100);
            $importeTotalDLS += $importeDLS;

            $productosActualizados[$productoId] = [
                'cant_unidades' => $cantidad,
                'descuento' => $descuento,
                'importe_mn' => $importeMN,
                'importe_dls' => $importeDLS,
            ];
        }

        $datos_proyecto_general->productos()->sync($productosActualizados);
        
        $datos_proyecto_general->importe_total_mn = $importeTotalMN;
        $datos_proyecto_general->cantidad_restante_mn = $importeTotalMN;
        $datos_proyecto_general->importe_total_dls = $importeTotalDLS;
        $datos_proyecto_general->cantidad_restante_dls = $importeTotalDLS;

        $datos_proyecto_general->save();

        if ($datos_proyecto_general->pk_proyecto_general) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }
}
