<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Producto;
use App\Models\Moneda;
use App\Models\Tasa;

class Producto_controller extends Controller
{
    public function insertar(Request $r){
        $prod=new Producto();

        $prod->nom_producto=$r->nom_producto;
        $prod->descrip=$r->descrip;
        if ($r->hasFile('imagen_producto')) {
            $path = str_replace('/', DIRECTORY_SEPARATOR, $r->file('imagen_producto')->store('public/img_productos'));
            $prod->imagen_producto=$path;
        }
        $prod->fk_sucursal=$r->fk_sucursal;
        $prod->fk_area_sucursal=$r->fk_area_sucursal;
        $prod->fk_division=$r->fk_division;
        $prod->fk_grupo_producto=$r->fk_grupo_producto;
        $prod->fk_subgrupo_producto=$r->fk_subgrupo_producto;
        $prod->fk_unidad_medida=$r->fk_unidad_medida;
        $prod->fk_clave_prod_serv_sat=$r->fk_clave_prod_serv_sat;
        $prod->fk_proveedor=$r->fk_proveedor;
        $prod->margen_utilidad_porcentaje=$r->margen_utilidad_porcentaje;
        $prod->fk_iva=$r->fk_iva;
        $prod->fecha_ultima_mod=$r->fecha_ultima_mod;
        $prod->estatus='Activo';

        $cantidadUnitaria = $r->input('cantidad_unitaria');
        $cantidadProyecto = $r->input('cantidad_proyecto');
        $cantidadEspecial = $r->input('cantidad_especial');
        $cantidadPromedio = $r->input('cantidad_promedio');
        $ultimaCantidad = $r->input('ultima_cantidad');
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
            $equivalenteDolaresUnitaria = $cantidadUnitaria * $tasa->cant_tasa;
            $equivalenteDolaresProyecto = $cantidadProyecto * $tasa->cant_tasa;
            $equivalenteDolaresEspecial = $cantidadEspecial * $tasa->cant_tasa;
            $equivalenteDolaresPromedio = $cantidadPromedio * $tasa->cant_tasa;
            $equivalenteDolaresUltimaCantidad = $ultimaCantidad * $tasa->cant_tasa;
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
            $equivalentePesosUnitaria = $cantidadUnitaria * $tasa->cant_tasa;
            $equivalentePesosProyecto = $cantidadProyecto * $tasa->cant_tasa;
            $equivalentePesosEspecial = $cantidadEspecial * $tasa->cant_tasa;
            $equivalentePesosPromedio = $cantidadPromedio * $tasa->cant_tasa;
            $equivalentePesosUltimaCantidad = $ultimaCantidad * $tasa->cant_tasa;
        }

        $prod->fk_moneda = $r->input('moneda');
        $prod->fk_tasa = $r->input('tasa');
        $prod->cantidad_unitaria = $r->input('cantidad_unitaria');
        $prod->cantidad_proyecto = $r->input('cantidad_proyecto');
        $prod->cantidad_especial = $r->input('cantidad_especial');
        $prod->cantidad_promedio = $r->input('cantidad_promedio');
        $prod->ultima_cantidad = $r->input('ultima_cantidad');
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
            $prod->precio_unitario_mn = $cantidadUnitaria ?? null;
            $prod->precio_unitario_dls = $equivalenteDolaresUnitaria ?? null;
            $prod->precio_proyecto_mn = $cantidadProyecto ?? null;
            $prod->precio_proyecto_dls = $equivalenteDolaresProyecto ?? null;
            $prod->precio_especial_mn = $cantidadEspecial ?? null;
            $prod->precio_especial_dls = $equivalenteDolaresEspecial ?? null;
            $prod->costo_promedio_mn = $cantidadPromedio ?? null;
            $prod->costo_promedio_dls = $equivalenteDolaresPromedio ?? null;
            $prod->ultimo_costo_mn = $ultimaCantidad ?? null;
            $prod->ultimo_costo_dls = $equivalenteDolaresUltimaCantidad ?? null;
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
            $prod->precio_unitario_mn = $equivalentePesosUnitaria ?? null;
            $prod->precio_unitario_dls = $cantidadUnitaria ?? null;
            $prod->precio_proyecto_mn = $equivalentePesosProyecto ?? null;
            $prod->precio_proyecto_dls = $cantidadProyecto ?? null;
            $prod->precio_especial_mn = $equivalentePesosEspecial ?? null;
            $prod->precio_especial_dls = $cantidadEspecial ?? null;
            $prod->costo_promedio_mn = $equivalentePesosPromedio ?? null;
            $prod->costo_promedio_dls = $cantidadPromedio ?? null;
            $prod->ultimo_costo_mn = $equivalentePesosUltimaCantidad ?? null;
            $prod->ultimo_costo_dls = $ultimaCantidad ?? null;
        }

        $prod->save();

        if ($prod->pk_producto) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }

    private function obtenerDatosProducto(){
        return Producto::join('sucursal', 'producto.fk_sucursal', '=', 'sucursal.pk_sucursal')
            ->join('area_sucursal', 'producto.fk_area_sucursal', '=', 'area_sucursal.pk_area_sucursal')
            ->join('division', 'producto.fk_division', '=', 'division.pk_division')
            ->join('grupo_producto', 'producto.fk_grupo_producto', '=', 'grupo_producto.pk_grupo_producto')
            ->join('subgrupo_producto', 'producto.fk_subgrupo_producto', '=', 'subgrupo_producto.pk_subgrupo_producto')
            ->join('unidad_medida', 'producto.fk_unidad_medida', '=', 'unidad_medida.pk_unidad_medida')
            ->join('clave_prod_serv_sat', 'producto.fk_clave_prod_serv_sat', '=', 'clave_prod_serv_sat.pk_clave_prod_serv_sat')
            ->join('proveedor', 'producto.fk_proveedor', '=', 'proveedor.pk_proveedor')
            ->join('moneda','producto.fk_moneda', '=', 'moneda.pk_moneda')
            ->join('tasa','producto.fk_tasa', '=', 'tasa.pk_tasa')
            ->join('iva','producto.fk_iva', '=', 'iva.pk_iva')
            ->select('producto.*', 'proveedor.estatus as proveedor_estatus')
            ->with(
                'proveedor', 
                'sucursal', 
                'area_sucursal', 
                'division',
                'grupo_producto',
                'subgrupo_producto',
                'unidad_medida',
                'clave_prod_serv_sat',
                'moneda',
                'tasa',
                'iva',
            );
    }

    public function mostrar(){
        $datos_producto = $this->obtenerDatosProducto()->get();
        
        return view('lista_producto', compact('datos_producto'));
    }

    public function activos(){
        $datos_producto = $this->obtenerDatosProducto()
            ->where('producto.estatus', '=', 'Activo')
            ->get();

        return view('lista_producto', compact('datos_producto'));
    }

    public function bloqueados(){
        $datos_producto = $this->obtenerDatosProducto()
            ->where('producto.estatus', '=', 'Bloqueado')
            ->get();

        return view('lista_producto', compact('datos_producto'));
    }

    public function filtrarPorRangoFechas(Request $r){
        $fecha_inicio = $r->input('fecha_inicio');
        $fecha_fin = $r->input('fecha_fin');

        $datos_producto = $this->obtenerDatosProducto()
            ->whereBetween('producto.fecha_ultima_mod', [$fecha_inicio, $fecha_fin])
            ->get();

        return view('lista_producto', compact('datos_producto'));
    }

    public function bloquear($pk_producto){
        $dato = Producto::findOrFail($pk_producto);
        
        if ($dato) {
            $dato->estatus = 'Bloqueado';
            $dato->save();

            Session()->flash('success', 'Producto bloqueado');
            return redirect()->back();
        } else {
            Session()->flash('error', 'Hubo un problema al bloquear');
            return redirect()->back();
        }
    }

    public function activar($pk_producto){
        $dato = Producto::findOrFail($pk_producto);

        if ($dato) {
            $dato->estatus = 'Activo';
            $dato->save();
            
            Session()->flash('success', 'Producto activado');
            return redirect()->back();
        } else {
            Session()->flash('error', 'Hubo un problema al activar');
            return redirect()->back();
        }
    }

    public function allInfo($pk_producto){
        $datos_producto = $this->obtenerDatosProducto()
        ->where('producto.pk_producto', $pk_producto)
        ->first();
    
        if ($datos_producto) {
            return view('listaCompleta_producto')->with('datos_producto', [$datos_producto]);
        } else {
            return redirect()->route('listadoProductos')->with('message', 'El registro no existe.');
        }
    }

    public function descargar($pk_producto){
        $imagen = Producto::findOrFail($pk_producto);
        $rutaImagen = $imagen->imagen_producto;

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

    public function actualizado($pk_producto){
        $datos_producto = Producto::findOrFail($pk_producto);
        return view('editar_producto', compact('datos_producto'));
    }

    public function update(Request $r, $pk_producto){
        $datos_producto=Producto::findOrFail($pk_producto);

        $datos_producto->nom_producto=$r->nom_producto;
        $datos_producto->descrip=$r->descrip;
        if ($r->hasFile('imagen_producto')) {
            $path = str_replace('/', DIRECTORY_SEPARATOR, $r->file('imagen_producto')->store('public/img_productos'));
            $datos_producto->imagen_producto=$path;
        }
        $datos_producto->fk_sucursal=$r->fk_sucursal;
        $datos_producto->fk_area_sucursal=$r->fk_area_sucursal;
        $datos_producto->fk_division=$r->fk_division;
        $datos_producto->fk_grupo_producto=$r->fk_grupo_producto;
        $datos_producto->fk_subgrupo_producto=$r->fk_subgrupo_producto;
        $datos_producto->fk_unidad_medida=$r->fk_unidad_medida;
        $datos_producto->fk_clave_prod_serv_sat=$r->fk_clave_prod_serv_sat;
        $datos_producto->fk_proveedor=$r->fk_proveedor;
        $datos_producto->margen_utilidad_porcentaje=$r->margen_utilidad_porcentaje;
        $datos_producto->fk_iva=$r->fk_iva;
        $datos_producto->fecha_ultima_mod=$r->fecha_ultima_mod;

        $cantidadUnitaria = $r->input('cantidad_unitaria');
        $cantidadProyecto = $r->input('cantidad_proyecto');
        $cantidadEspecial = $r->input('cantidad_especial');
        $cantidadPromedio = $r->input('cantidad_promedio');
        $ultimaCantidad = $r->input('ultima_cantidad');
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
            $equivalenteDolaresUnitaria = $cantidadUnitaria * $tasa->cant_tasa;
            $equivalenteDolaresProyecto = $cantidadProyecto * $tasa->cant_tasa;
            $equivalenteDolaresEspecial = $cantidadEspecial * $tasa->cant_tasa;
            $equivalenteDolaresPromedio = $cantidadPromedio * $tasa->cant_tasa;
            $equivalenteDolaresUltimaCantidad = $ultimaCantidad * $tasa->cant_tasa;
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
            $equivalentePesosUnitaria = $cantidadUnitaria * $tasa->cant_tasa;
            $equivalentePesosProyecto = $cantidadProyecto * $tasa->cant_tasa;
            $equivalentePesosEspecial = $cantidadEspecial * $tasa->cant_tasa;
            $equivalentePesosPromedio = $cantidadPromedio * $tasa->cant_tasa;
            $equivalentePesosUltimaCantidad = $ultimaCantidad * $tasa->cant_tasa;
        }

        $datos_producto->fk_moneda = $r->input('moneda');
        $datos_producto->fk_tasa = $r->input('tasa');
        $datos_producto->cantidad_unitaria = $r->input('cantidad_unitaria');
        $datos_producto->cantidad_proyecto = $r->input('cantidad_proyecto');
        $datos_producto->cantidad_especial = $r->input('cantidad_especial');
        $datos_producto->cantidad_promedio = $r->input('cantidad_promedio');
        $datos_producto->ultima_cantidad = $r->input('ultima_cantidad');
        if ($moneda->nom_moneda === 'Pesos mexicanos') {
            $datos_producto->precio_unitario_mn = $cantidadUnitaria ?? null;
            $datos_producto->precio_unitario_dls = $equivalenteDolaresUnitaria ?? null;
            $datos_producto->precio_proyecto_mn = $cantidadProyecto ?? null;
            $datos_producto->precio_proyecto_dls = $equivalenteDolaresProyecto ?? null;
            $datos_producto->precio_especial_mn = $cantidadEspecial ?? null;
            $datos_producto->precio_especial_dls = $equivalenteDolaresEspecial ?? null;
            $datos_producto->costo_promedio_mn = $cantidadPromedio ?? null;
            $datos_producto->costo_promedio_dls = $equivalenteDolaresPromedio ?? null;
            $datos_producto->ultimo_costo_mn = $ultimaCantidad ?? null;
            $datos_producto->ultimo_costo_dls = $equivalenteDolaresUltimaCantidad ?? null;
        } elseif ($moneda->nom_moneda === 'Dólares') {
            $datos_producto->precio_unitario_mn = $equivalentePesosUnitaria ?? null;
            $datos_producto->precio_unitario_dls = $cantidadUnitaria ?? null;
            $datos_producto->precio_proyecto_mn = $equivalentePesosProyecto ?? null;
            $datos_producto->precio_proyecto_dls = $cantidadProyecto ?? null;
            $datos_producto->precio_especial_mn = $equivalentePesosEspecial ?? null;
            $datos_producto->precio_especial_dls = $cantidadEspecial ?? null;
            $datos_producto->costo_promedio_mn = $equivalentePesosPromedio ?? null;
            $datos_producto->costo_promedio_dls = $cantidadPromedio ?? null;
            $datos_producto->ultimo_costo_mn = $equivalentePesosUltimaCantidad ?? null;
            $datos_producto->ultimo_costo_dls = $ultimaCantidad ?? null;
        }

        $datos_producto->save();

        if ($datos_producto->pk_producto) {
            return back()->with('success', 'Guardado');
        } else {
            return back()->with('error', 'Hay algún problema con la información');
        }
    }
}
