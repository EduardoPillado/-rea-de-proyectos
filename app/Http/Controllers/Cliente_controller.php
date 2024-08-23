<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Direccion;
use App\Models\Datos_comunes;
use App\Models\Cliente;

class Cliente_controller extends Controller
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

        $cli=new Cliente();
        $cli->razon_social=$r->razon_social;
        $cli->fk_datos_comunes=$dat_com->pk_datos_comunes;
        $cli->fk_sucursal=$r->fk_sucursal;
        $cli->rfc=$r->rfc;
        $cli->fk_uso_cfdi=$r->fk_uso_cfdi;
        $cli->fk_regimen_fiscal=$r->fk_regimen_fiscal;
        if ($r->hasFile('constancia_situa_fiscal')) {
            $path = str_replace('/', DIRECTORY_SEPARATOR, $r->file('constancia_situa_fiscal')->store('public/constancias'));
            $cli->constancia_situa_fiscal=$path;
        }
        $cli->cuenta_contable_mn=$r->cuenta_contable_mn;
        $cli->cuenta_anticipo=$r->cuenta_anticipo;
        $cli->fk_grupo_cliente=$r->fk_grupo_cliente;
        $cli->fk_agente=$r->fk_agente;
        $cli->extranjero = isset($r->extranjero) ? 'si' : 'no';
        $cli->multisucursal = isset($r->multisucursal) ? 'si' : 'no';
        $cli->cliente_agricultor = isset($r->cliente_agricultor) ? 'si' : 'no';
        $cli->cliente_iva_extra = isset($r->cliente_iva_extra) ? 'si' : 'no';
        $cli->fecha_alta=$r->fecha_alta;
        $cli->estatus='Activo';

        $cli->save();

        if ($cli->pk_cliente) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    private function obtenerDatosCliente(){
        return Cliente::join('datos_comunes', 'cliente.fk_datos_comunes', '=', 'datos_comunes.pk_datos_comunes')
            ->join('sucursal', 'cliente.fk_sucursal', '=', 'sucursal.pk_sucursal')
            ->join('uso_cfdi', 'cliente.fk_uso_cfdi', '=', 'uso_cfdi.pk_uso_cfdi')
            ->join('regimen_fiscal', 'cliente.fk_regimen_fiscal', '=', 'regimen_fiscal.pk_regimen_fiscal')
            ->join('grupo_cliente', 'cliente.fk_grupo_cliente', '=', 'grupo_cliente.pk_grupo_cliente')
            ->join('agente', 'cliente.fk_agente', '=', 'agente.pk_agente');
    }

    public function mostrar(){
        $datos_cliente = $this->obtenerDatosCliente()->get();

        return view('lista_cliente', compact('datos_cliente'));
    }

    public function activos(){
        $datos_cliente = $this->obtenerDatosCliente()
            ->where('cliente.estatus', '=', 'Activo')
            ->get();

        return view('lista_cliente', compact('datos_cliente'));
    }

    public function bloqueados(){
        $datos_cliente = $this->obtenerDatosCliente()
            ->where('cliente.estatus', '=', 'Bloqueado')
            ->get();

        return view('lista_cliente', compact('datos_cliente'));
    }

    public function filtrarPorRangoFechas(Request $r){
        $fecha_inicio = $r->input('fecha_inicio');
        $fecha_fin = $r->input('fecha_fin');

        $datos_cliente = $this->obtenerDatosCliente()
            ->whereBetween('cliente.fecha_alta', [$fecha_inicio, $fecha_fin])
            ->get();

        return view('lista_cliente', compact('datos_cliente'));
    }

    public function bloquear($pk_cliente){
        $dato = Cliente::findOrFail($pk_cliente);
        
        if ($dato) {
            $dato->estatus = 'Bloqueado';
            $dato->save();

            Session()->flash('success', 'Cliente bloqueado');
            return redirect()->back();
        } else {
            Session()->flash('error', 'Hubo un problema al bloquear');
            return redirect()->back();
        }
    }

    public function activar($pk_cliente){
        $dato = Cliente::findOrFail($pk_cliente);

        if ($dato) {
            $dato->estatus = 'Activo';
            $dato->save();
            
            Session()->flash('success', 'Cliente activado');
            return redirect()->back();
        } else {
            Session()->flash('error', 'Hubo un problema al activar');
            return redirect()->back();
        }
    }

    public function allInfo($pk_cliente){
        $datos_cliente = $this->obtenerDatosCliente()
        ->where('cliente.pk_cliente', $pk_cliente)
        ->first();
    
        if ($datos_cliente) {
            return view('listaCompleta_cliente')->with('datos_cliente', [$datos_cliente]);
        } else {
            return redirect()->route('listadoClientes')->with('message', 'El registro no existe.');
        }
    }

    public function descargar($pk_cliente){
        $constancia = Cliente::findOrFail($pk_cliente);
        $rutaConstancia = $constancia->constancia_situa_fiscal;

        if (!is_null($rutaConstancia) && Storage::exists($rutaConstancia)) {
            $nombreConstancia = basename($rutaConstancia);
            $rutaCompletaConstancia = storage_path('app/' . $rutaConstancia);

            return response()->download($rutaCompletaConstancia, $nombreConstancia, [
                'Content-Type' => mime_content_type($rutaCompletaConstancia)
            ]);
        } else {
            Session::flash('error', 'El archivo no existe');
            return redirect()->back();
        }
    }

    public function actualizado($pk_cliente){
        $datos_cliente=Cliente::findOrFail($pk_cliente);
        return view('editar_cliente', compact('datos_cliente'));
    }

    public function update(Request $r, $pk_cliente){
        $datos_cliente=Cliente::findOrFail($pk_cliente);

        $datos_cliente->datos_comunes->direccion->calle=$r->calle;
        $datos_cliente->datos_comunes->direccion->numero=$r->numero;
        $datos_cliente->datos_comunes->direccion->colonia=$r->colonia;
        $datos_cliente->datos_comunes->direccion->cp=$r->cp;

        $datos_cliente->datos_comunes->direccion->save();

        $datos_cliente->datos_comunes->nombres=$r->nombres;
        $datos_cliente->datos_comunes->a_paterno=$r->a_paterno;
        $datos_cliente->datos_comunes->a_materno=$r->a_materno;
        $datos_cliente->datos_comunes->fk_direccion=$datos_cliente->datos_comunes->direccion->pk_direccion;
        $datos_cliente->datos_comunes->fk_pais=$r->fk_pais;
        $datos_cliente->datos_comunes->fk_estado=$r->fk_estado;
        $datos_cliente->datos_comunes->fk_municipio=$r->fk_municipio;
        $datos_cliente->datos_comunes->fk_ubicacion=$r->fk_ubicacion;
        $datos_cliente->datos_comunes->fk_nacionalidad=$r->fk_nacionalidad;
        $datos_cliente->datos_comunes->correo=$r->correo;
        $datos_cliente->datos_comunes->telefono=$r->telefono;
        $datos_cliente->datos_comunes->curp=$r->curp;

        $datos_cliente->datos_comunes->save();

        $datos_cliente->razon_social=$r->razon_social;
        $datos_cliente->fk_datos_comunes=$datos_cliente->datos_comunes->pk_datos_comunes;
        $datos_cliente->fk_sucursal=$r->fk_sucursal;
        $datos_cliente->rfc=$r->rfc;
        $datos_cliente->fk_uso_cfdi=$r->fk_uso_cfdi;
        $datos_cliente->fk_regimen_fiscal=$r->fk_regimen_fiscal;
        if ($r->hasFile('constancia_situa_fiscal')) {
            $path = str_replace('/', DIRECTORY_SEPARATOR, $r->file('constancia_situa_fiscal')->store('public/constancias'));
            $datos_cliente->constancia_situa_fiscal=$path;
        }
        $datos_cliente->cuenta_contable_mn=$r->cuenta_contable_mn;
        $datos_cliente->cuenta_anticipo=$r->cuenta_anticipo;
        $datos_cliente->fk_grupo_cliente=$r->fk_grupo_cliente;
        $datos_cliente->fk_agente=$r->fk_agente;
        $datos_cliente->extranjero = isset($r->extranjero) ? 'si' : 'no';
        $datos_cliente->multisucursal = isset($r->multisucursal) ? 'si' : 'no';
        $datos_cliente->cliente_agricultor = isset($r->cliente_agricultor) ? 'si' : 'no';
        $datos_cliente->cliente_iva_extra = isset($r->cliente_iva_extra) ? 'si' : 'no';
        $datos_cliente->fecha_ult_mod=$r->fecha_ult_mod;

        $datos_cliente->save();

        if ($datos_cliente->pk_cliente) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }
}
