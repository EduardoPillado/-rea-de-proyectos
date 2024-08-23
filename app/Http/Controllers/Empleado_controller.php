<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Direccion;
use App\Models\Datos_comunes;
use App\Models\Empleado;

class Empleado_controller extends Controller
{
    public function insertar(Request $r){
        $direc=new Direccion();
        $direc->calle=$r->calle;
        $direc->numero=$r->numero;
        $direc->colonia=$r->colonia;
        $direc->cp=$r->cp;
        $direc->save();

        $direc->refresh();

        $dat_com=new Datos_comunes();
        $dat_com->nombres=$r->nombres;
        $dat_com->a_paterno=$r->a_paterno;
        $dat_com->a_materno=$r->a_materno;
        $dat_com->fk_direccion=$direc->pk_direccion;
        $dat_com->fk_pais=$r->fk_pais;
        $dat_com->fk_estado=$r->fk_estado;
        $dat_com->fk_municipio=$r->fk_municipio;
        $dat_com->fk_ubicacion=$r->fk_ubicacion;
        $dat_com->fk_nacionalidad=$r->fk_nacionalidad;
        $dat_com->correo=$r->correo;
        $dat_com->telefono=$r->telefono;
        $dat_com->curp=$r->curp;
        $dat_com->save();

        $dat_com->refresh();

        $emp=new Empleado();
        $emp->fk_datos_comunes=$dat_com->pk_datos_comunes;
        if ($r->hasFile('curriculum')) {
            $path = str_replace('/', DIRECTORY_SEPARATOR, $r->file('curriculum')->store('public/curriculums'));
            $emp->curriculum=$path;
        }
        $emp->fk_puesto_empleado=$r->fk_puesto_empleado;
        $emp->fecha_alta=$r->fecha_alta;
        $emp->estatus='Activo';

        $emp->save();

        if ($emp->pk_empleado) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    private function obtenerDatosEmpleado(){
        return Empleado::join('datos_comunes', 'empleado.fk_datos_comunes', '=', 'datos_comunes.pk_datos_comunes')
            ->join('puesto_empleado', 'empleado.fk_puesto_empleado', '=', 'puesto_empleado.pk_puesto_empleado');
    }

    public function mostrar(){
        $datos_empleado = $this->obtenerDatosEmpleado()->get();

        return view('lista_empleado', compact('datos_empleado'));
    }

    public function activos(){
        $datos_empleado = $this->obtenerDatosEmpleado()
            ->where('empleado.estatus', '=', 'Activo')
            ->get();

        return view('lista_empleado', compact('datos_empleado'));
    }

    public function bloqueados(){
        $datos_empleado = $this->obtenerDatosEmpleado()
            ->where('empleado.estatus', '=', 'Bloqueado')
            ->get();

        return view('lista_empleado', compact('datos_empleado'));
    }

    public function filtrarPorRangoFechas(Request $r){
        $fecha_inicio = $r->input('fecha_inicio');
        $fecha_fin = $r->input('fecha_fin');

        $datos_empleado = $this->obtenerDatosEmpleado()
            ->whereBetween('empleado.fecha_alta', [$fecha_inicio, $fecha_fin])
            ->get();

        return view('lista_empleado', compact('datos_empleado'));
    }

    public function bloquear($pk_empleado){
        $dato = Empleado::findOrFail($pk_empleado);
        
        if ($dato) {
            $dato->estatus = 'Bloqueado';
            $dato->save();

            Session()->flash('success', 'Empleado bloqueado');
            return redirect()->back();
        } else {
            Session()->flash('error', 'Hubo un problema al bloquear');
            return redirect()->back();
        }
    }

    public function activar($pk_empleado){
        $dato = Empleado::findOrFail($pk_empleado);

        if ($dato) {
            $dato->estatus = 'Activo';
            $dato->save();
            
            Session()->flash('success', 'Empleado activado');
            return redirect()->back();
        } else {
            Session()->flash('error', 'Hubo un problema al activar');
            return redirect()->back();
        }
    }

    public function allInfo($pk_empleado){
        $datos_empleado = $this->obtenerDatosEmpleado()
        ->where('empleado.pk_empleado', $pk_empleado)
        ->first();
    
        if ($datos_empleado) {
            return view('listaCompleta_empleado')->with('datos_empleado', [$datos_empleado]);
        } else {
            return redirect()->route('listadoEmpleados')->with('message', 'El registro no existe.');
        }
    }

    public function descargar($pk_empleado){
        $archivo_curriculum = Empleado::findOrFail($pk_empleado);
        $rutaCurriculum = $archivo_curriculum->curriculum;

        if (!is_null($rutaCurriculum) && Storage::exists($rutaCurriculum)) {
            $nombreCurriculum = basename($rutaCurriculum);
            $rutaCompletaCurriculum = storage_path('app/' . $rutaCurriculum);

            return response()->download($rutaCompletaCurriculum, $nombreCurriculum, [
                'Content-Type' => mime_content_type($rutaCompletaCurriculum)
            ]);
        } else {
            Session::flash('error', 'El archivo no existe');
            return redirect()->back();
        }
    }

    public function actualizado($pk_empleado){
        $datos_empleado = Empleado::findOrFail($pk_empleado);
        return view('editar_empleado', compact('datos_empleado'));
    }

    public function update(Request $r, $pk_empleado){
        $datos_empleado=Empleado::findOrFail($pk_empleado);

        $datos_empleado->datos_comunes->direccion->calle=$r->calle;
        $datos_empleado->datos_comunes->direccion->numero=$r->numero;
        $datos_empleado->datos_comunes->direccion->colonia=$r->colonia;
        $datos_empleado->datos_comunes->direccion->cp=$r->cp;

        $datos_empleado->datos_comunes->direccion->save();

        $datos_empleado->datos_comunes->nombres=$r->nombres;
        $datos_empleado->datos_comunes->a_paterno=$r->a_paterno;
        $datos_empleado->datos_comunes->a_materno=$r->a_materno;
        $datos_empleado->datos_comunes->fk_direccion=$datos_empleado->datos_comunes->direccion->pk_direccion;
        $datos_empleado->datos_comunes->fk_pais=$r->fk_pais;
        $datos_empleado->datos_comunes->fk_estado=$r->fk_estado;
        $datos_empleado->datos_comunes->fk_municipio=$r->fk_municipio;
        $datos_empleado->datos_comunes->fk_ubicacion=$r->fk_ubicacion;
        $datos_empleado->datos_comunes->fk_nacionalidad=$r->fk_nacionalidad;
        $datos_empleado->datos_comunes->correo=$r->correo;
        $datos_empleado->datos_comunes->telefono=$r->telefono;
        $datos_empleado->datos_comunes->curp=$r->curp;

        $datos_empleado->datos_comunes->save();

        $datos_empleado->fk_datos_comunes=$datos_empleado->datos_comunes->pk_datos_comunes;
        if ($r->hasFile('curriculum')) {
            $path = str_replace('/', DIRECTORY_SEPARATOR, $r->file('curriculum')->store('public/curriculums'));
            $datos_empleado->curriculum=$path;
        }
        $datos_empleado->fk_puesto_empleado=$r->fk_puesto_empleado;
        $datos_empleado->fecha_ult_mod=$r->fecha_ult_mod;

        $datos_empleado->save();

        if ($datos_empleado->pk_empleado) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }
}
