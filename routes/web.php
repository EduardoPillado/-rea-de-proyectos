<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pais_controller;
use App\Http\Controllers\Estado_controller;
use App\Http\Controllers\Municipio_controller;
use App\Http\Controllers\Ubicacion_controller;
use App\Http\Controllers\Nacionalidad_controller;
use App\Http\Controllers\Regimen_fiscal_controller;
use App\Http\Controllers\Uso_cfdi_controller;
use App\Http\Controllers\Sucursal_controller;
use App\Http\Controllers\Agente_controller;
use App\Http\Controllers\Grupo_cliente_controller;
use App\Http\Controllers\Area_sucursal_controller;
use App\Http\Controllers\Division_controller;
use App\Http\Controllers\Grupo_producto_controller;
use App\Http\Controllers\Subgrupo_producto_controller;
use App\Http\Controllers\Unidad_medida_controller;
use App\Http\Controllers\Clave_prod_serv_sat_controller;
use App\Http\Controllers\Moneda_controller;
use App\Http\Controllers\Tasa_controller;
use App\Http\Controllers\Iva_controller;
use App\Http\Controllers\Sistema_riego_controller;
use App\Http\Controllers\Cultivo_controller;
use App\Http\Controllers\Categoria_proyecto_controller;
use App\Http\Controllers\Etapa_controller;
use App\Http\Controllers\Puesto_empleado_controller;
use App\Http\Controllers\Tipo_proveedor_controller;
use App\Http\Controllers\Tipo_operacion_controller;
use App\Http\Controllers\Tipo_pago_controller;
use App\Http\Controllers\Forma_pago_controller;
use App\Http\Controllers\Metodo_pago_controller;
use App\Http\Controllers\Tipo_entrada_controller;
use App\Http\Controllers\Tipo_salida_controller;
use App\Http\Controllers\Producto_controller;
use App\Http\Controllers\Cliente_controller;
use App\Http\Controllers\Empleado_controller;
use App\Http\Controllers\Proveedor_controller;
use App\Http\Controllers\Proyecto_general_controller;
use App\Http\Controllers\Pago_controller;
use App\Http\Controllers\Entrada_controller;
use App\Http\Controllers\Salida_controller;
use App\Http\Controllers\Excel_cotizacion_controller;
use App\Http\Controllers\Almacen_existencias_controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// País -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroPais', [Pais_controller::class, 'agregarPais'])->name('agregarPais');

// Estado -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroEstado', [Estado_controller::class, 'agregarEstado'])->name('agregarEstado');

// Municipio -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroMunicipio', [Municipio_controller::class, 'agregarMunicipio'])->name('agregarMunicipio');

// Ubicación -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroUbicacion', [Ubicacion_controller::class, 'agregarUbicacion'])->name('agregarUbicacion');

// Nacionalidad -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroNacionalidad', [Nacionalidad_controller::class, 'agregarNacionalidad'])->name('agregarNacionalidad');

// Régimen fiscal -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroRegimenFiscal', [Regimen_fiscal_controller::class, 'agregarRegimenFiscal'])->name('agregarRegimenFiscal');

// Uso de CFDI -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroUsoCfdi', [Uso_cfdi_controller::class, 'agregarUsoCfdi'])->name('agregarUsoCfdi');

// Sucursal -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroSucursal', [Sucursal_controller::class, 'agregarSucursal'])->name('agregarSucursal');

// Agente -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroAgente', [Agente_controller::class, 'agregarAgente'])->name('agregarAgente');

// Grupo de cliente -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroGrupoCliente', [Grupo_cliente_controller::class, 'agregarGrupoCliente'])->name('agregarGrupoCliente');

// Area de sucursal -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroAreaSucursal', [Area_sucursal_controller::class, 'agregarAreaSucursal'])->name('agregarAreaSucursal');

// División -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroDivision', [Division_controller::class, 'agregarDivision'])->name('agregarDivision');

// Grupo de producto -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroGrupoProducto', [Grupo_producto_controller::class, 'agregarGrupoProducto'])->name('agregarGrupoProducto');

// Subgrupo de producto -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroSubgrupoProducto', [Subgrupo_producto_controller::class, 'agregarSubgrupoProducto'])->name('agregarSubgrupoProducto');

// Unidad de medida -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroUnidadMedida', [Unidad_medida_controller::class, 'agregarUnidadMedida'])->name('agregarUnidadMedida');

// Clave de producto o servicio SAT -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroClaveProdServSat', [Clave_prod_serv_sat_controller::class, 'agregarClaveProdServSat'])->name('agregarClaveProdServSat');

// Moneda -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroMoneda', [Moneda_controller::class, 'agregarMoneda'])->name('agregarMoneda');

// Tasa de cambio -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroTasa', [Tasa_controller::class, 'agregarTasa'])->name('agregarTasa');

// IVA -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroIva', [Iva_controller::class, 'agregarIva'])->name('agregarIva');

// Sistema de riego -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroSistemaRiego', [Sistema_riego_controller::class, 'agregarSistemaRiego'])->name('agregarSistemaRiego');

// Cultivo -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroCultivo', [Cultivo_controller::class, 'agregarCultivo'])->name('agregarCultivo');

// Categoria de proyecto -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroCategoriaProyecto', [Categoria_proyecto_controller::class, 'agregarCategoriaProyecto'])->name('agregarCategoriaProyecto');

// Etapa -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroEtapa', [Etapa_controller::class, 'agregarEtapa'])->name('agregarEtapa');

// Puesto de empleado -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroPuestoEmpleado', [Puesto_empleado_controller::class, 'agregarPuestoEmpleado'])->name('agregarPuestoEmpleado');

// Tipo de proveedor -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroTipoProveedor', [Tipo_proveedor_controller::class, 'agregarTipoProveedor'])->name('agregarTipoProveedor');

// Tipo de operación -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroTipoOperacion', [Tipo_operacion_controller::class, 'agregarTipoOperacion'])->name('agregarTipoOperacion');

// Tipo de pago -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroTipoPago', [Tipo_pago_controller::class, 'agregarTipoPago'])->name('agregarTipoPago');

// Forma de pago -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroFormaPago', [Forma_pago_controller::class, 'agregarFormaPago'])->name('agregarFormaPago');

// Metodo de pago -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroMetodoPago', [Metodo_pago_controller::class, 'agregarMetodoPago'])->name('agregarMetodoPago');

// Tipo de entrada -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroTipoEntrada', [Tipo_entrada_controller::class, 'agregarTipoEntrada'])->name('agregarTipoEntrada');

// Tipo de salida -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/registroTipoSalida', [Tipo_salida_controller::class, 'agregarTipoSalida'])->name('agregarTipoSalida');

// Producto -------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/producto', function () {
    return view('formulario_producto');
})->name('agregarProductos');
Route::post('/listadoProductos', function () {
    return view('lista_productos');
})->name('productosExistentes');

Route::post('/registroProducto', [Producto_controller::class, 'insertar'])->name('producto.insertar');

Route::get('/listadoProductos', [Producto_controller::class, 'mostrar'])->name('producto.mostrar');
Route::get('/listadoProductosActivos', [Producto_controller::class, 'activos'])->name('producto.activos');
Route::get('/listadoProductosBloqueados', [Producto_controller::class, 'bloqueados'])->name('producto.bloqueados');
Route::get('/listadoProductosOrdenFechas', [Producto_controller::class, 'filtrarPorRangoFechas'])->name('producto.filtrarPorRangoFechas');
Route::get('/producto/{pk_producto}', [Producto_controller::class, 'allInfo'])->name('producto.allInfo');

Route::put('/producto/{pk_producto}/update', [Producto_controller::class, 'update'])->name('producto.update');
Route::get('/producto/{pk_producto}/update', [Producto_controller::class, 'actualizado'])->name('producto.actualizado');
Route::get('/imagen/{pk_producto}/descargar', [Producto_controller::class, 'descargar'])->name('producto.descargar');
Route::get('/bloquearProducto/{pk_producto}', [Producto_controller::class, 'bloquear'])->name('producto.bloquear');
Route::get('/activarProducto/{pk_producto}', [Producto_controller::class, 'activar'])->name('producto.activar');

// Cliente -------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/cliente', function () {
    return view('formulario_cliente');
})->name('agregarClientes');
Route::post('/listadoClientes', function () {
    return view('lista_cliente');
})->name('clientesRegistrados');

Route::post('/registroCliente', [Cliente_controller::class, 'insertar'])->name('cliente.insertar');

Route::get('/listadoClientes', [Cliente_controller::class, 'mostrar'])->name('cliente.mostrar');
Route::get('/listadoClientesActivos', [Cliente_controller::class, 'activos'])->name('cliente.activos');
Route::get('/listadoClientesBloqueados', [Cliente_controller::class, 'bloqueados'])->name('cliente.bloqueados');
Route::get('/listadoClientesOrdenFechas', [Cliente_controller::class, 'filtrarPorRangoFechas'])->name('cliente.filtrarPorRangoFechas');
Route::get('/cliente/{pk_cliente}', [Cliente_controller::class, 'allInfo'])->name('cliente.allInfo');

Route::put('/cliente/{pk_cliente}/update', [Cliente_controller::class, 'update'])->name('cliente.update');
Route::get('/cliente/{pk_cliente}/update', [Cliente_controller::class, 'actualizado'])->name('cliente.actualizado');
Route::get('/constancia/{pk_cliente}/descargar', [Cliente_controller::class, 'descargar'])->name('cliente.descargar');
Route::get('/bloquearCliente/{pk_cliente}', [Cliente_controller::class, 'bloquear'])->name('cliente.bloquear');
Route::get('/activarCliente/{pk_cliente}', [Cliente_controller::class, 'activar'])->name('cliente.activar');

// Empleado -------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/empleado', function () {
    return view('formulario_empleado');
})->name('agregarEmpleados');
Route::post('/listadoEmpleados', function () {
    return view('lista_empleado');
})->name('empleadosRegistrados');

Route::post('/registroEmpleado', [Empleado_controller::class, 'insertar'])->name('empleado.insertar');

Route::get('/listadoEmpleados', [Empleado_controller::class, 'mostrar'])->name('empleado.mostrar');
Route::get('/listadoEmpleadosActivos', [Empleado_controller::class, 'activos'])->name('empleado.activos');
Route::get('/listadoEmpleadosBloqueados', [Empleado_controller::class, 'bloqueados'])->name('empleado.bloqueados');
Route::get('/listadoEmpleadosOrdenFechas', [Empleado_controller::class, 'filtrarPorRangoFechas'])->name('empleado.filtrarPorRangoFechas');
Route::get('/empleado/{pk_empleado}', [Empleado_controller::class, 'allInfo'])->name('empleado.allInfo');

Route::put('/empleado/{pk_empleado}/update', [Empleado_controller::class, 'update'])->name('empleado.update');
Route::get('/empleado/{pk_empleado}/update', [Empleado_controller::class, 'actualizado'])->name('empleado.actualizado');
Route::get('/currículum/{pk_empleado}/descargar', [Empleado_controller::class, 'descargar'])->name('empleado.descargar');
Route::get('/bloquearEmpleado/{pk_empleado}', [Empleado_controller::class, 'bloquear'])->name('empleado.bloquear');
Route::get('/activarEmpleado/{pk_empleado}', [Empleado_controller::class, 'activar'])->name('empleado.activar');

// Proveedor -------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/proveedor', function () {
    return view('formulario_proveedor');
})->name('agregarProveedores');
Route::post('/listadoProveedores', function () {
    return view('lista_proveedor');
})->name('proveedoresRegistrados');

Route::post('/registroProveedor', [Proveedor_controller::class, 'insertar'])->name('proveedor.insertar');

Route::get('/listadoProveedores', [Proveedor_controller::class, 'mostrar'])->name('proveedor.mostrar');
Route::get('/listadoProveedoresActivos', [Proveedor_controller::class, 'activos'])->name('proveedor.activos');
Route::get('/listadoProveedoresBloqueados', [Proveedor_controller::class, 'bloqueados'])->name('proveedor.bloqueados');
Route::get('/listadoProveedoresOrdenFechas', [Proveedor_controller::class, 'filtrarPorRangoFechas'])->name('proveedor.filtrarPorRangoFechas');
Route::get('/proveedor/{pk_proveedor}', [Proveedor_controller::class, 'allInfo'])->name('proveedor.allInfo');

Route::put('/proveedor/{pk_proveedor}/update', [Proveedor_controller::class, 'update'])->name('proveedor.update');
Route::get('/proveedor/{pk_proveedor}/update', [Proveedor_controller::class, 'actualizado'])->name('proveedor.actualizado');
Route::get('/bloquearProveedor/{pk_proveedor}', [Proveedor_controller::class, 'bloquear'])->name('proveedor.bloquear');
Route::get('/activarProveedor/{pk_proveedor}', [Proveedor_controller::class, 'activar'])->name('proveedor.activar');

// Proyecto general -------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/proyecto', function () {
    return view('formulario_proyecto_general');
})->name('agregarProyectos');
Route::post('/listadoProyectos', function () {
    return view('lista_proyecto_general');
})->name('proyectosRegistrados');

Route::post('/registroProyecto', [Proyecto_general_controller::class, 'insertar'])->name('proyecto_general.insertar');

Route::get('/listadoProyectos', [Proyecto_general_controller::class, 'mostrar'])->name('proyecto_general.mostrar');
Route::get('/listadoProyectosActivos', [Proyecto_general_controller::class, 'activos'])->name('proyecto_general.activos');
Route::get('/listadoProyectosBloqueados', [Proyecto_general_controller::class, 'bloqueados'])->name('proyecto_general.bloqueados');
Route::get('/listadoProyectosCreados', [Proyecto_general_controller::class, 'creados'])->name('proyecto_general.creados');
Route::get('/listadoProyectosAprobados', [Proyecto_general_controller::class, 'aprobados'])->name('proyecto_general.aprobados');
Route::get('/listadoProyectosCotizados', [Proyecto_general_controller::class, 'cotizados'])->name('proyecto_general.cotizados');
Route::get('/listadoProyectosFinalizados', [Proyecto_general_controller::class, 'finalizados'])->name('proyecto_general.finalizados');
Route::get('/listadoProyectosOrdenFechas', [Proyecto_general_controller::class, 'filtrarPorRangoFechas'])->name('proyecto_general.filtrarPorRangoFechas');
Route::get('/proyecto/{pk_proyecto_general}', [Proyecto_general_controller::class, 'allInfo'])->name('proyecto_general.allInfo');

Route::put('/proyecto/{pk_proyecto_general}/update', [Proyecto_general_controller::class, 'update'])->name('proyecto_general.update');
Route::get('/proyecto/{pk_proyecto_general}/update', [Proyecto_general_controller::class, 'actualizado'])->name('proyecto_general.actualizado');
Route::get('/imagen/{pk_proyecto_general}/descargar', [Proyecto_general_controller::class, 'descargarImagen'])->name('proyecto_general.descargarImagen');
Route::get('/plano/{pk_proyecto_general}/descargar', [Proyecto_general_controller::class, 'descargarPlano'])->name('proyecto_general.descargarPlano');
Route::get('/bloquearProyecto/{pk_proyecto_general}', [Proyecto_general_controller::class, 'bloquear'])->name('proyecto_general.bloquear');
Route::get('/activarProyecto/{pk_proyecto_general}', [Proyecto_general_controller::class, 'activar'])->name('proyecto_general.activar');

// Pago -------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/pago', function () {
    return view('formulario_pago');
})->name('agregarPagos');
Route::post('/listadoPagos', function () {
    return view('lista_pago');
})->name('pagosRealizados');

Route::post('/registroPago', [Pago_controller::class, 'insertar'])->name('pago.insertar');

Route::get('/listadoPagos', [Pago_controller::class, 'mostrar'])->name('pago.mostrar');
Route::get('/listadoPagosActivos', [Pago_controller::class, 'activos'])->name('pago.activos');
Route::get('/listadoPagosBloqueados', [Pago_controller::class, 'bloqueados'])->name('pago.bloqueados');
Route::get('/listadoPagosAnticipo', [Pago_controller::class, 'anticipo'])->name('pago.anticipo');
Route::get('/listadoPagosCompletos', [Pago_controller::class, 'pagoCompleto'])->name('pago.pagoCompleto');
Route::get('/listadoPagosAbono', [Pago_controller::class, 'abono'])->name('pago.abono');
Route::get('/listadoPagosEfectivo', [Pago_controller::class, 'efectivo'])->name('pago.efectivo');
Route::get('/listadoPagosTarjeta', [Pago_controller::class, 'tarjeta'])->name('pago.tarjeta');
Route::get('/listadoPagosCheque', [Pago_controller::class, 'cheque'])->name('pago.cheque');
Route::get('/listadoPagosOrdenFechas', [Pago_controller::class, 'filtrarPorRangoFechas'])->name('pago.filtrarPorRangoFechas');
Route::get('/pago/{pk_pago}', [Pago_controller::class, 'allInfo'])->name('pago.allInfo');

Route::get('/bloquearPago/{pk_pago}', [Pago_controller::class, 'bloquear'])->name('pago.bloquear');
Route::get('/activarPago/{pk_pago}', [Pago_controller::class, 'activar'])->name('pago.activar');

// Entrada -------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/entrada', function () {
    return view('formulario_entrada');
})->name('agregarEntradas');
Route::post('/listadoEntradas', function () {
    return view('lista_entrada');
})->name('entradasRegistradas');

Route::post('/registroEntrada', [Entrada_controller::class, 'insertar'])->name('entrada.insertar');

Route::get('/listadoEntradas', [Entrada_controller::class, 'mostrar'])->name('entrada.mostrar');
Route::get('/listadoEntradasActivas', [Entrada_controller::class, 'activos'])->name('entrada.activos');
Route::get('/listadoEntradasBloqueadas', [Entrada_controller::class, 'bloqueados'])->name('entrada.bloqueados');
Route::get('/listadoEntradasOrdenFechas', [Entrada_controller::class, 'filtrarPorRangoFechas'])->name('entrada.filtrarPorRangoFechas');
Route::get('/entrada/{pk_entrada}', [Entrada_controller::class, 'allInfo'])->name('entrada.allInfo');

Route::get('/bloquearEntrada/{pk_entrada}', [Entrada_controller::class, 'bloquear'])->name('entrada.bloquear');
Route::get('/activarEntrada/{pk_entrada}', [Entrada_controller::class, 'activar'])->name('entrada.activar');

// Salida -------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/salida', function () {
    return view('formulario_salida');
})->name('agregarSalidas');
Route::post('/listadoSalidas', function () {
    return view('lista_salida');
})->name('salidasRegistradas');

Route::post('/registroSalida', [Salida_controller::class, 'insertar'])->name('salida.insertar');

Route::get('/listadoSalidas', [Salida_controller::class, 'mostrar'])->name('salida.mostrar');
Route::get('/listadoSalidasActivas', [Salida_controller::class, 'activos'])->name('salida.activos');
Route::get('/listadoSalidasBloqueadas', [Salida_controller::class, 'bloqueados'])->name('salida.bloqueados');
Route::get('/listadoSalidasOrdenFechas', [Salida_controller::class, 'filtrarPorRangoFechas'])->name('salida.filtrarPorRangoFechas');
Route::get('/salida/{pk_salida}', [Salida_controller::class, 'allInfo'])->name('salida.allInfo');

Route::get('/bloquearSalida/{pk_salida}', [Salida_controller::class, 'bloquear'])->name('salida.bloquear');
Route::get('/activarSalida/{pk_salida}', [Salida_controller::class, 'activar'])->name('salida.activar');

// Excel de cotización -------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/cotización', function () {
    return view('formulario_excel_cotizacion');
})->name('agregarCotizacion');
Route::post('/listadoCotizaciones', function () {
    return view('lista_excel_cotizacion');
})->name('cotizacionesRegistradas');

Route::post('/registroCotizacion', [Excel_cotizacion_controller::class, 'importarCotizacion'])->name('importarCotizacion');

Route::get('/listadoCotizaciones', [Excel_cotizacion_controller::class, 'mostrar'])->name('cotizacion.mostrar');
Route::get('/listadoCotizacionesActivas', [Excel_cotizacion_controller::class, 'activos'])->name('cotizacion.activos');
Route::get('/listadoCotizacionesBloqueadas', [Excel_cotizacion_controller::class, 'bloqueados'])->name('cotizacion.bloqueados');
Route::get('/listadoCotizacionesOrdenFechas', [Excel_cotizacion_controller::class, 'filtrarPorRangoFechas'])->name('cotizacion.filtrarPorRangoFechas');
Route::get('/cotizacion/{pk_cotizacion}', [Excel_cotizacion_controller::class, 'allInfo'])->name('cotizacion.allInfo');

Route::get('/cotizacion/{pk_cotizacion}/descargar', [Excel_cotizacion_controller::class, 'descargarCotizacion'])->name('cotizacion.descargarCotizacion');
Route::get('/bloquearCotizacion/{pk_cotizacion}', [Excel_cotizacion_controller::class, 'bloquear'])->name('cotizacion.bloquear');
Route::get('/activarCotizacion/{pk_cotizacion}', [Excel_cotizacion_controller::class, 'activar'])->name('cotizacion.activar');

// Almacen de existencias -------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/listadoExistenciasAlmacen', function () {
    return view('lista_almacen_existencias');
})->name('productoAlmacenados');

Route::get('/listadoExistenciasAlmacen', [Almacen_existencias_controller::class, 'mostrar'])->name('almacen_existencias.mostrar');

Route::get('/listadoPocasExistencias', [Almacen_existencias_controller::class, 'diezOmenosExistencias'])->name('almacen_existencias.diezOmenosExistencias');
Route::get('/listadoMuchasExistencias', [Almacen_existencias_controller::class, 'doscientasOmasExistencias'])->name('almacen_existencias.doscientasOmasExistencias');

Route::get('/listadoExistenciasTresMeses', [Almacen_existencias_controller::class, 'tresMesesSinCambios'])->name('almacen_existencias.tresMesesSinCambios');
Route::get('/listadoExistenciasSeisMeses', [Almacen_existencias_controller::class, 'seisMesesSinCambios'])->name('almacen_existencias.seisMesesSinCambios');
Route::get('/listadoExistenciasNueveMeses', [Almacen_existencias_controller::class, 'nueveMesesSinCambios'])->name('almacen_existencias.nueveMesesSinCambios');
Route::get('/listadoExistenciasMasDeOnceMeses', [Almacen_existencias_controller::class, 'onceMesesSinCambios'])->name('almacen_existencias.onceMesesSinCambios');
Route::get('/listadoExistenciasOrdenFechas', [Almacen_existencias_controller::class, 'filtrarPorRangoFechas'])->name('almacen_existencias.filtrarPorRangoFechas');

// -------------------------------------------------------------------------------------------------------------------------------------------------



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
