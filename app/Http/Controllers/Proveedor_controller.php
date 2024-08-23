<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direccion;
use App\Models\Datos_comunes;
use App\Models\Credito;
use App\Models\Proveedor;

class Proveedor_controller extends Controller
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

        $cred=new Credito();
        $cred->dias_credito=$r->dias_credito;
        $cred->tiempo_surtido=$r->tiempo_surtido;
        $cred->save();

        $cred->refresh();

        $prov=new Proveedor();
        $prov->razon_social=$r->razon_social;
        $prov->extranjero = isset($r->extranjero) ? 'si' : 'no';
        $prov->multiafectable = isset($r->multiafectable) ? 'si' : 'no';
        $prov->riego = isset($r->riego) ? 'si' : 'no';
        $prov->fk_datos_comunes=$dat_com->pk_datos_comunes;
        $prov->fk_sucursal=$r->fk_sucursal;
        $prov->rfc=$r->rfc;
        $prov->cuenta_contable_mn=$r->cuenta_contable_mn;
        $prov->cuenta_contable_dls=$r->cuenta_contable_dls;
        $prov->cuenta_complementaria=$r->cuenta_complementaria;
        $prov->cuenta_afectable=$r->cuenta_afectable;
        $prov->fk_credito=$cred->pk_credito;
        $prov->fk_tipo_proveedor=$r->fk_tipo_proveedor;
        $prov->fk_tipo_operacion=$r->fk_tipo_operacion;
        $prov->fecha_alta=$r->fecha_alta;
        $prov->estatus='Activo';

        $prov->save();
        
        if ($prov->pk_proveedor) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    private function obtenerDatosProveedor(){
        return Proveedor::join('datos_comunes', 'proveedor.fk_datos_comunes', '=', 'datos_comunes.pk_datos_comunes')
        ->join('sucursal', 'proveedor.fk_sucursal', '=', 'sucursal.pk_sucursal')
        ->join('credito', 'proveedor.fk_credito', '=', 'credito.pk_credito')
        ->join('tipo_proveedor', 'proveedor.fk_tipo_proveedor', '=', 'tipo_proveedor.pk_tipo_proveedor')
        ->join('tipo_operacion', 'proveedor.fk_tipo_operacion', '=', 'tipo_operacion.pk_tipo_operacion');
    }

    public function mostrar(){
        $datos_proveedor = $this->obtenerDatosProveedor()->get();

        return view('lista_proveedor', compact('datos_proveedor'));
    }
    
    public function activos(){
        $datos_proveedor = $this->obtenerDatosProveedor()
            ->where('proveedor.estatus', '=', 'Activo')
            ->get();

        return view('lista_proveedor', compact('datos_proveedor'));
    }

    public function bloqueados(){
        $datos_proveedor = $this->obtenerDatosProveedor()
            ->where('proveedor.estatus', '=', 'Bloqueado')
            ->get();

        return view('lista_proveedor', compact('datos_proveedor'));
    }

    public function filtrarPorRangoFechas(Request $r){
        $fecha_inicio = $r->input('fecha_inicio');
        $fecha_fin = $r->input('fecha_fin');

        $datos_proveedor = $this->obtenerDatosProveedor()
            ->whereBetween('proveedor.fecha_alta', [$fecha_inicio, $fecha_fin])
            ->get();

        return view('lista_proveedor', compact('datos_proveedor'));
    }

    public function bloquear($pk_proveedor){
        $dato = Proveedor::findOrFail($pk_proveedor);
        
        if ($dato) {
            $dato->estatus = 'Bloqueado';
            $dato->save();

            Session()->flash('success', 'Proveedor bloqueado');
            return redirect()->back();
        } else {
            Session()->flash('error', 'Hubo un problema al bloquear');
            return redirect()->back();
        }
    }

    public function activar($pk_proveedor){
        $dato = Proveedor::findOrFail($pk_proveedor);

        if ($dato) {
            $dato->estatus = 'Activo';
            $dato->save();
            
            Session()->flash('success', 'Proveedor activado');
            return redirect()->back();
        } else {
            Session()->flash('error', 'Hubo un problema al activar');
            return redirect()->back();
        }
    }

    public function allInfo($pk_proveedor){
        $datos_proveedor = $this->obtenerDatosProveedor()
        ->where('proveedor.pk_proveedor', $pk_proveedor)
        ->first();
    
        if ($datos_proveedor) {
            return view('listaCompleta_proveedor')->with('datos_proveedor', [$datos_proveedor]);
        } else {
            return redirect()->route('listadoProveedor')->with('message', 'El registro no existe.');
        }
    }

    public function actualizado($pk_proveedor){
        $datos_proveedor=Proveedor::findOrFail($pk_proveedor);
        return view('editar_proveedor', compact('datos_proveedor'));
    }

    public function update(Request $r, $pk_proveedor){
        $datos_proveedor=Proveedor::findOrFail($pk_proveedor);

        $datos_proveedor->datos_comunes->direccion->calle=$r->calle;
        $datos_proveedor->datos_comunes->direccion->numero=$r->numero;
        $datos_proveedor->datos_comunes->direccion->colonia=$r->colonia;
        $datos_proveedor->datos_comunes->direccion->cp=$r->cp;

        $datos_proveedor->datos_comunes->direccion->save();

        $datos_proveedor->datos_comunes->nombres=$r->nombres;
        $datos_proveedor->datos_comunes->a_paterno=$r->a_paterno;
        $datos_proveedor->datos_comunes->a_materno=$r->a_materno;
        $datos_proveedor->datos_comunes->fk_direccion=$datos_proveedor->datos_comunes->direccion->pk_direccion;
        $datos_proveedor->datos_comunes->fk_pais=$r->fk_pais;
        $datos_proveedor->datos_comunes->fk_estado=$r->fk_estado;
        $datos_proveedor->datos_comunes->fk_municipio=$r->fk_municipio;
        $datos_proveedor->datos_comunes->fk_ubicacion=$r->fk_ubicacion;
        $datos_proveedor->datos_comunes->fk_nacionalidad=$r->fk_nacionalidad;
        $datos_proveedor->datos_comunes->correo=$r->correo;
        $datos_proveedor->datos_comunes->telefono=$r->telefono;
        $datos_proveedor->datos_comunes->curp=$r->curp;

        $datos_proveedor->datos_comunes->save();

        $datos_proveedor->credito->dias_credito=$r->dias_credito;
        $datos_proveedor->credito->tiempo_surtido=$r->tiempo_surtido;

        $datos_proveedor->credito->save();

        $datos_proveedor->razon_social=$r->razon_social;
        $datos_proveedor->extranjero = isset($r->extranjero) ? 'si' : 'no';
        $datos_proveedor->multiafectable = isset($r->multiafectable) ? 'si' : 'no';
        $datos_proveedor->riego = isset($r->riego) ? 'si' : 'no';
        $datos_proveedor->fk_datos_comunes=$datos_proveedor->datos_comunes->pk_datos_comunes;
        $datos_proveedor->fk_sucursal=$r->fk_sucursal;
        $datos_proveedor->rfc=$r->rfc;
        $datos_proveedor->cuenta_contable_mn=$r->cuenta_contable_mn;
        $datos_proveedor->cuenta_contable_dls=$r->cuenta_contable_dls;
        $datos_proveedor->cuenta_complementaria=$r->cuenta_complementaria;
        $datos_proveedor->cuenta_afectable=$r->cuenta_afectable;
        $datos_proveedor->fk_credito=$datos_proveedor->credito->pk_credito;
        $datos_proveedor->fk_tipo_proveedor=$r->fk_tipo_proveedor;
        $datos_proveedor->fk_tipo_operacion=$r->fk_tipo_operacion;
        $datos_proveedor->fecha_ult_mod=$r->fecha_ult_mod;

        $datos_proveedor->save();

        if ($datos_proveedor->pk_proveedor) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }
}
