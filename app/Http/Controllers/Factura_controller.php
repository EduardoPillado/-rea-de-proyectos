<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;

class Factura_controller extends Controller
{
    function insertar(Request $r){
        $fact=new Factura();

        $fact->tipo_factura=$r->tipo_factura;
        $fact->fk_cliente=$r->fk_cliente;
        $fact->fk_uso_cfdi=$r->fk_uso_cfdi;
        $fact->fk_tipo_factura=$r->fk_tipo_factura;
        $fact->fk_regimen_fiscal=$r->fk_regimen_fiscal;
        $fact->fk_sucursal=$r->fk_sucursal;
        $fact->fk_plaza=$r->fk_plaza;
        $fact->fk_pago=$r->fk_pago;
        $fact->fk_proyecto_general=$r->fk_proyecto_general;
        $fact->fk_moneda=$r->fk_moneda;
        $fact->tipo_cambio=$r->tipo_cambio;
        $fact->posterior_venta=isset($r->posterior_venta) ? 'si' : 'no';
        $fact->fk_metodo_pago=$r->fk_metodo_pago;
        $fact->fk_forma_pago=$r->fk_forma_pago;
        $fact->condiciones_pago=$r->condiciones_pago;
        $fact->total_factura=$r->total_factura;
        $fact->estatus='Activo';

        $fact->save();
        return redirect('/formularioFactura')->with('success', 'Guardado');
    }

    function mostrar(){
        $datos_factura=Factura::join('cliente', 'factura.fk_cliente', '=', 'cliente.pk_cliente')
        ->join('uso_cfdi', 'factura.fk_uso_cfdi', '=', 'uso_cfdi.pk_uso_cfdi')
        ->join('tipo_factura', 'factura.fk_tipo_factura', '=', 'tipo_factura.pk_tipo_factura')
        ->join('regimen_fiscal', 'factura.fk_regimen_fiscal', '=', 'regimen_fiscal.pk_regimen_fiscal')
        ->join('sucursal', 'factura.fk_sucursal', '=', 'sucursal.pk_sucursal')
        ->join('plaza', 'factura.fk_plaza', '=', 'plaza.pk_plaza')
        ->join('pago', 'factura.fk_pago', '=', 'pago.pk_pago')
        ->join('proyecto_general', 'factura.fk_proyecto_general', '=', 'proyecto_general.pk_proyecto_general')
        ->join('moneda', 'factura.fk_moneda', '=', 'moneda.pk_moneda')
        ->join('metodo_pago', 'factura.fk_metodo_pago', '=', 'metodo_pago.pk_metodo_pago')
        ->join('forma_pago', 'factura.fk_forma_pago', '=', 'forma_pago.pk_forma_pago');
        return view('lista_factura', compact('datos_factura'));
    }
}
