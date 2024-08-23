<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Excel_cotizacion;
use App\Models\Cotizacion;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CotizacionImport;

class Excel_cotizacion_controller extends Controller
{
    public function importarCotizacion(Request $r){

        Excel::import(new CotizacionImport, $r->file('archivo_cotizacion'));

        $importeTotalMN = 0;
        $importeTotalDLS = 0;

        $cotizaciones = Excel_cotizacion::all();

        foreach ($cotizaciones as $cotizacion) {
            $importeTotalMN += $cotizacion->coti_importe_mn;
            $importeTotalDLS += $cotizacion->coti_importe_dls;
        }

        $cotizacion = new Cotizacion();
        $cotizacion->nom_archivo=$r->nom_archivo;
        if ($r->hasFile('archivo_cotizacion')) {
            $path = str_replace('/', DIRECTORY_SEPARATOR, $r->file('archivo_cotizacion')->store('public/cotizaciones_excel'));
            $cotizacion->ruta_archivo=$path;
        }
        $cotizacion->fk_cliente=$r->fk_cliente;
        $cotizacion->fk_estado=$r->fk_estado;
        $cotizacion->fk_ubicacion=$r->fk_ubicacion;
        $cotizacion->fk_sucursal=$r->fk_sucursal;
        $cotizacion->area_regable=$r->area_regable;
        $cotizacion->fecha_cotizacion=$r->fecha_cotizacion;
        $cotizacion->vigencia_cotizacion=$r->vigencia_cotizacion;
        $cotizacion->coti_importe_total_mn=$importeTotalMN;
        $cotizacion->coti_importe_total_dls=$importeTotalDLS;
        $cotizacion->estatus='Activo';
        $cotizacion->save();

        foreach ($cotizaciones as $cotizacionExcel) {
            $cotizacion->excelCotizaciones()->attach($cotizacionExcel->pk_excel_cotizacion);
        }

        if ($r->hasFile('archivo_cotizacion')) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    private function obtenerDatosCotizacion(){
        return Cotizacion::join('cliente', 'cotizacion.fk_cliente', '=', 'cliente.pk_cliente')
            ->join('estado', 'cotizacion.fk_estado', '=', 'estado.pk_estado')
            ->join('ubicacion', 'cotizacion.fk_ubicacion', '=', 'ubicacion.pk_ubicacion')
            ->join('sucursal', 'cotizacion.fk_sucursal', '=', 'sucursal.pk_sucursal')
            ->select('cotizacion.*', 'cliente.estatus as cliente_estatus')
            ->with('cliente', 'estado', 'ubicacion', 'sucursal');
    }

    public function mostrar(){
        $datos_cotizacion = $this->obtenerDatosCotizacion()->get();

        return view('lista_excel_cotizacion', compact('datos_cotizacion'));
    }

    public function activos(){
        $datos_cotizacion = $this->obtenerDatosCotizacion()
            ->where('cotizacion.estatus', '=', 'Activo')
            ->get();

        return view('lista_excel_cotizacion', compact('datos_cotizacion'));
    }

    public function bloqueados(){
        $datos_cotizacion = $this->obtenerDatosCotizacion()
            ->where('cotizacion.estatus', '=', 'Bloqueado')
            ->get();

        return view('lista_excel_cotizacion', compact('datos_cotizacion'));
    }

    public function filtrarPorRangoFechas(Request $r){
        $fecha_inicio = $r->input('fecha_inicio');
        $fecha_fin = $r->input('fecha_fin');

        $datos_cotizacion = $this->obtenerDatosCotizacion()
            ->whereBetween('cotizacion.fecha_cotizacion', [$fecha_inicio, $fecha_fin])
            ->get();

        return view('lista_excel_cotizacion', compact('datos_cotizacion'));
    }

    public function bloquear($pk_cotizacion){
        $dato = Cotizacion::findOrFail($pk_cotizacion);
        
        if ($dato) {
            $dato->estatus = 'Bloqueado';
            $dato->save();

            Session()->flash('success', 'Cotización bloqueada');
            return redirect()->back();
        } else {
            Session()->flash('error', 'Hubo un problema al bloquear');
            return redirect()->back();
        }
    }

    public function activar($pk_cotizacion){
        $dato = Cotizacion::findOrFail($pk_cotizacion);

        if ($dato) {
            $dato->estatus = 'Activo';
            $dato->save();
            
            Session()->flash('success', 'Cotización activada');
            return redirect()->back();
        } else {
            Session()->flash('error', 'Hubo un problema al activar');
            return redirect()->back();
        }
    }

    public function allInfo($pk_cotizacion){
        $datos_cotizacion = $this->obtenerDatosCotizacion()
        ->where('cotizacion.pk_cotizacion', $pk_cotizacion)
        ->first();
    
        if ($datos_cotizacion) {
            return view('listaCompleta_excel_cotizacion')->with('datos_cotizacion', [$datos_cotizacion]);
        } else {
            return redirect()->route('listadoCotizacion')->with('message', 'El registro no existe.');
        }
    }

    public function descargarCotizacion($pk_cotizacion){
        $archivo = Cotizacion::findOrFail($pk_cotizacion);
        $rutaArchivo = $archivo->ruta_archivo;

        if (!is_null($rutaArchivo) && Storage::exists($rutaArchivo)) {
            $nombreArchivo = basename($rutaArchivo);
            $rutaCompletaArchivo = storage_path('app/' . $rutaArchivo);

            return response()->download($rutaCompletaArchivo, $nombreArchivo, [
                'Content-Type' => mime_content_type($rutaCompletaArchivo)
            ]);
        } else {
            Session::flash('error', 'El archivo de cotización no existe');
            return redirect()->back();
        }
    }
}
