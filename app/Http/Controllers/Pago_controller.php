<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Moneda;
use App\Models\Tasa;
use App\Models\Proyecto_general;

class Pago_controller extends Controller
{
    public function insertar(Request $r){
        $pago=new Pago();

        $pago->fk_cliente=$r->fk_cliente;
        $pago->fk_sucursal=$r->fk_sucursal;
        $pago->fk_tipo_pago=$r->fk_tipo_pago;
        $pago->fk_forma_pago=$r->fk_forma_pago;
        $pago->fk_proyecto_general=$r->fk_proyecto_general;
        $pago->fecha_pago=$r->fecha_pago;
        $pago->estatus='Activo';

        $cantidadPago = $r->input('cantidad_pago');
        $monedaSeleccionada = $r->input('moneda');
        $tasaSeleccionada = $r->input('tasa');

        $moneda = Moneda::findOrFail($monedaSeleccionada);
        $tasa = Tasa::findOrFail($tasaSeleccionada);

        if ($moneda->nom_moneda === 'Pesos mexicanos'
         || $moneda->nom_moneda === 'pesos mexicanos'
         || $moneda->nom_moneda === 'PESOS MEXICANOS'
         || $moneda->nom_moneda === 'Pesos Mexicanos'
         || $moneda->nom_moneda === 'Peso mexicano'
         || $moneda->nom_moneda === 'peso mexicano'
         || $moneda->nom_moneda === 'PESO MEXICANO'
         || $moneda->nom_moneda === 'Peso Mexicano'
         || $moneda->nom_moneda === 'Pesos'
         || $moneda->nom_moneda === 'pesos'
         || $moneda->nom_moneda === 'PESOS'
         || $moneda->nom_moneda === 'Peso'
         || $moneda->nom_moneda === 'peso'
         || $moneda->nom_moneda === 'PESO'
         || $moneda->nom_moneda === 'MN'
         || $moneda->nom_moneda === 'mn'
         || $moneda->nom_moneda === 'Mn'
         || $moneda->nom_moneda === 'MXN'
         || $moneda->nom_moneda === 'mxn'
         || $moneda->nom_moneda === 'Mxn') {
            $equivalenteDolaresPago = $cantidadPago * $tasa->cant_tasa;
        } elseif ($moneda->nom_moneda === 'Dólares'
         || $moneda->nom_moneda === 'Dolares'
         || $moneda->nom_moneda === 'dólares'
         || $moneda->nom_moneda === 'dolares'
         || $moneda->nom_moneda === 'DÓLARES'
         || $moneda->nom_moneda === 'DOLARES'
         || $moneda->nom_moneda === 'Dólar'
         || $moneda->nom_moneda === 'Dolar'
         || $moneda->nom_moneda === 'dólar'
         || $moneda->nom_moneda === 'dolar'
         || $moneda->nom_moneda === 'DÓLAR'
         || $moneda->nom_moneda === 'DOLAR'
         || $moneda->nom_moneda === 'DLS'
         || $moneda->nom_moneda === 'dls'
         || $moneda->nom_moneda === 'Dls'
         || $moneda->nom_moneda === 'USD'
         || $moneda->nom_moneda === 'usd'
         || $moneda->nom_moneda === 'Usd') {
            $equivalentePesosPago = $cantidadPago * $tasa->cant_tasa;
        }

        $pago->fk_moneda = $r->input('moneda');
        $pago->fk_tasa = $r->input('tasa');
        $pago->cantidad_pago = $r->input('cantidad_pago');
        $proyecto = Proyecto_general::findOrFail($r->fk_proyecto_general);
        if ($moneda->nom_moneda === 'Pesos mexicanos'
        || $moneda->nom_moneda === 'pesos mexicanos'
        || $moneda->nom_moneda === 'PESOS MEXICANOS'
        || $moneda->nom_moneda === 'Pesos Mexicanos'
        || $moneda->nom_moneda === 'Peso mexicano'
        || $moneda->nom_moneda === 'peso mexicano'
        || $moneda->nom_moneda === 'PESO MEXICANO'
        || $moneda->nom_moneda === 'Peso Mexicano'
        || $moneda->nom_moneda === 'Pesos'
        || $moneda->nom_moneda === 'pesos'
        || $moneda->nom_moneda === 'PESOS'
        || $moneda->nom_moneda === 'Peso'
        || $moneda->nom_moneda === 'peso'
        || $moneda->nom_moneda === 'PESO'
        || $moneda->nom_moneda === 'MN'
        || $moneda->nom_moneda === 'mn'
        || $moneda->nom_moneda === 'Mn'
        || $moneda->nom_moneda === 'MXN'
        || $moneda->nom_moneda === 'mxn'
        || $moneda->nom_moneda === 'Mxn') {
            $pago->cant_pago_mn = $cantidadPago ?? null;
            $pago->cant_pago_dls = $equivalenteDolaresPago ?? null;
            $proyecto->cantidad_restante_mn -= $cantidadPago;
            $proyecto->cantidad_restante_dls -= $equivalenteDolaresPago;
        } elseif ($moneda->nom_moneda === 'Dólares'
         || $moneda->nom_moneda === 'Dolares'
         || $moneda->nom_moneda === 'dólares'
         || $moneda->nom_moneda === 'dolares'
         || $moneda->nom_moneda === 'DÓLARES'
         || $moneda->nom_moneda === 'DOLARES'
         || $moneda->nom_moneda === 'Dólar'
         || $moneda->nom_moneda === 'Dolar'
         || $moneda->nom_moneda === 'dólar'
         || $moneda->nom_moneda === 'dolar'
         || $moneda->nom_moneda === 'DÓLAR'
         || $moneda->nom_moneda === 'DOLAR'
         || $moneda->nom_moneda === 'DLS'
         || $moneda->nom_moneda === 'dls'
         || $moneda->nom_moneda === 'Dls'
         || $moneda->nom_moneda === 'USD'
         || $moneda->nom_moneda === 'usd'
         || $moneda->nom_moneda === 'Usd') {
            $pago->cant_pago_mn = $equivalentePesosPago ?? null;
            $pago->cant_pago_dls = $cantidadPago ?? null;
            $proyecto->cantidad_restante_mn -= $equivalentePesosPago;
            $proyecto->cantidad_restante_dls -= $cantidadPago;
        }

        $pago->save();
        $proyecto->save();

        if ($pago->pk_pago) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    private function obtenerDatosPago(){
        return Pago::join('cliente', 'pago.fk_cliente', '=', 'cliente.pk_cliente')
        ->join('sucursal', 'pago.fk_sucursal', '=', 'sucursal.pk_sucursal')
        ->join('moneda', 'pago.fk_moneda', '=', 'moneda.pk_moneda')
        ->join('tipo_pago', 'pago.fk_tipo_pago', '=', 'tipo_pago.pk_tipo_pago')
        ->join('forma_pago', 'pago.fk_forma_pago', '=', 'forma_pago.pk_forma_pago')
        ->join('proyecto_general', 'pago.fk_proyecto_general', '=', 'proyecto_general.pk_proyecto_general')
        ->select('pago.*', 'cliente.estatus as cliente_estatus', 'proyecto_general.estatus as proyecto_general_estatus')
        ->with('cliente',
            'sucursal',
            'moneda',
            'tipo_pago',
            'forma_pago',
            'proyecto_general'
        );
    }

    public function mostrar(){
        $datos_pago = $this->obtenerDatosPago()->get();

        return view('lista_pago', compact('datos_pago'));
    }

    public function activos(){
        $datos_pago = $this->obtenerDatosPago()
            ->where('pago.estatus', '=', 'Activo')
            ->get();

        return view('lista_pago', compact('datos_pago'));
    }

    public function bloqueados(){
        $datos_pago = $this->obtenerDatosPago()
            ->where('pago.estatus', '=', 'Bloqueado')
            ->get();

        return view('lista_pago', compact('datos_pago'));
    }

    public function anticipo(){
        $datos_pago = $this->obtenerDatosPago()
            ->where(function($query) {
                $query->whereRaw('UPPER(tipo_pago.nom_tipo_pago) LIKE ?', ['%ANTICIPO%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(tipo_pago.nom_tipo_pago) LIKE ?', ['%ANTICIPOS%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(tipo_pago.nom_tipo_pago) LIKE ?', ['%anticipo%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(tipo_pago.nom_tipo_pago) LIKE ?', ['%anticipos%']);
            })
            ->get();
    
        if ($datos_pago->count() === 0) {
            return redirect()->back()->with('message', 'No se encontraron anticipos.');
        }
    
        return view('lista_pago', compact('datos_pago'));
    }

    public function pagoCompleto(){
        $datos_pago = $this->obtenerDatosPago()
            ->where(function($query) {
                $query->whereRaw('UPPER(tipo_pago.nom_tipo_pago) LIKE ?', ['%PAGO COMPLETO%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(tipo_pago.nom_tipo_pago) LIKE ?', ['%PAGOS COMPLETOS%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(tipo_pago.nom_tipo_pago) LIKE ?', ['%pago completo%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(tipo_pago.nom_tipo_pago) LIKE ?', ['%pagos completos%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(tipo_pago.nom_tipo_pago) LIKE ?', ['%completo%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(tipo_pago.nom_tipo_pago) LIKE ?', ['%completos%']);
            })
            ->get();
    
        if ($datos_pago->count() === 0) {
            return redirect()->back()->with('message', 'No se encontraron pagos completos.');
        }
    
        return view('lista_pago', compact('datos_pago'));
    }

    public function abono(){
        $datos_pago = $this->obtenerDatosPago()
            ->where(function($query) {
                $query->whereRaw('UPPER(tipo_pago.nom_tipo_pago) LIKE ?', ['%ABONO%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(tipo_pago.nom_tipo_pago) LIKE ?', ['%ABONOS%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(tipo_pago.nom_tipo_pago) LIKE ?', ['%abono%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(tipo_pago.nom_tipo_pago) LIKE ?', ['%abonos%']);
            })
            ->get();
    
        if ($datos_pago->count() === 0) {
            return redirect()->back()->with('message', 'No se encontraron abonos.');
        }
    
        return view('lista_pago', compact('datos_pago'));
    }

    public function efectivo(){
        $datos_pago = $this->obtenerDatosPago()
            ->where(function($query) {
                $query->whereRaw('UPPER(forma_pago.nom_forma_pago) LIKE ?', ['%EFECTIVO%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(forma_pago.nom_forma_pago) LIKE ?', ['%efectivo%']);
            })
            ->get();
    
        if ($datos_pago->count() === 0) {
            return redirect()->back()->with('message', 'No se encontraron pagos en efectivo.');
        }
    
        return view('lista_pago', compact('datos_pago'));
    }

    public function tarjeta(){
        $datos_pago = $this->obtenerDatosPago()
            ->where(function($query) {
                $query->whereRaw('UPPER(forma_pago.nom_forma_pago) LIKE ?', ['%TARJETA%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(forma_pago.nom_forma_pago) LIKE ?', ['%tarjeta%']);
            })
            ->get();
    
        if ($datos_pago->count() === 0) {
            return redirect()->back()->with('message', 'No se encontraron pagos con tarjeta.');
        }
    
        return view('lista_pago', compact('datos_pago'));
    }

    public function cheque(){
        $datos_pago = $this->obtenerDatosPago()
            ->where(function($query) {
                $query->whereRaw('UPPER(forma_pago.nom_forma_pago) LIKE ?', ['%CHEQUE%']);
            })
            ->orWhere(function($query) {
                $query->whereRaw('LOWER(forma_pago.nom_forma_pago) LIKE ?', ['%cheque%']);
            })
            ->get();
    
        if ($datos_pago->count() === 0) {
            return redirect()->back()->with('message', 'No se encontraron pagos con cheque.');
        }
    
        return view('lista_pago', compact('datos_pago'));
    }

    public function filtrarPorRangoFechas(Request $r){
        $fecha_inicio = $r->input('fecha_inicio');
        $fecha_fin = $r->input('fecha_fin');

        $datos_pago = $this->obtenerDatosPago()
            ->whereBetween('pago.fecha_pago', [$fecha_inicio, $fecha_fin])
            ->get();

        return view('lista_pago', compact('datos_pago'));
    }

    public function bloquear($pk_pago){
        $dato = Pago::findOrFail($pk_pago);

        if ($dato) {
            $proyecto = $dato->proyecto_general;

            $dato->estatus = 'Bloqueado';
            $dato->save();

            $proyecto->cantidad_restante_mn += $dato->cant_pago_mn;
            $proyecto->cantidad_restante_dls += $dato->cant_pago_dls;
            $proyecto->save();

            Session()->flash('success', 'Pago bloqueado');
        } else {
            Session()->flash('error', 'Hubo un problema al bloquear');
        }

        return redirect()->back();
    }

    public function activar($pk_pago){
        $dato = Pago::findOrFail($pk_pago);

        if ($dato) {
            $proyecto = $dato->proyecto_general;

            $dato->estatus = 'Activo';
            $dato->save();

            $proyecto->cantidad_restante_mn -= $dato->cant_pago_mn;
            $proyecto->cantidad_restante_dls -= $dato->cant_pago_dls;
            $proyecto->save();

            Session()->flash('success', 'Pago activado');
        } else {
            Session()->flash('error', 'Hubo un problema al activar');
        }

        return redirect()->back();
    }

    public function allInfo($pk_pago){
        $datos_pago = $this->obtenerDatosPago()
        ->where('pago.pk_pago', $pk_pago)
        ->first();
    
        if ($datos_pago) {
            return view('listaCompleta_pago')->with('datos_pago', [$datos_pago]);
        } else {
            return redirect()->route('listadoPagos')->with('message', 'El registro no existe.');
        }
    }
}
