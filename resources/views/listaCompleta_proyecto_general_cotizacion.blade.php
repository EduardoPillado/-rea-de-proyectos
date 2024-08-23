<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/sitehasa_isotipo.ico') }}" rel="icon">
    <title>Proyecto</title>
</head>
<body class="fondo">
    @include('header2') <br>
    @include('mensaje')

    <div class="main">
        <div class="container">
            @foreach ($datos_proyecto_general as $dato)
                <h2>Proyecto - {{$dato->pk_proyecto_general}}</h2>
                <div class="position-regresar">
                    <a href="{{route('proyectosRegistrados')}}" title="Regresar">
                        <i id="icono-regresar" class="bi bi-arrow-right"></i>
                    </a>
                </div>
            @endforeach
            <div style="padding-bottom: 4%" class="table-back">
                <table class="table table-bordered border-list table-vertical" id="tabla-completa">
                    @foreach ($datos_proyecto_general as $dato)
                        <tr>
                            <th>Código</th>
                            <td>{{$dato->pk_proyecto_general}}</td>
                        </tr>
                        <tr>
                            <th>Cliente</th>
                            <td>
                                {{$dato->cliente->razon_social.' '.$dato->cliente->datos_comunes->nombres.' '.$dato->cliente->datos_comunes->a_paterno.' '.$dato->cliente->datos_comunes->a_materno}} - 
                                <a class="ver_codigo" href="{{route('clientesRegistrados', $dato->pk_cliente)}}">
                                    <i class="bi bi-eye" title="Ver cliente"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Nombre del proyecto</th>
                            <td>{{$dato->nom_proyecto_general}}</td>
                        </tr>
                        <tr>
                            <th>Sucursal</th>
                            <td>{{$dato->sucursal->nom_sucursal}}</td>
                        </tr>
                        <tr>
                            <th>Sistema de riego</th>
                            <td>{{$dato->sistema_riego->nom_sistema}}</td>
                        </tr>
                        <tr>
                            <th>Cultivo</th>
                            <td>{{$dato->cultivo->nom_cultivo}}</td>
                        </tr>
                        <tr>
                            <th>Fecha de inicio</th>
                            <td>{{$dato->fecha_inicio}}</td>
                        </tr>
                        <tr>
                            <th>Superficie</th>
                            <td>{{$dato->superficie}}</td>
                        </tr>
                        <tr>
                            <th>Vigencia (Días)</th>
                            <td>{{$dato->vigencia_dias}}</td>
                        </tr>
                        <tr>
                            <th>Predio</th>
                            <td>{{$dato->predio}}</td>
                        </tr>
                        <tr>
                            <th>Categoría de proyecto</th>
                            <td>{{$dato->categoria_proyecto->nom_cat_proy}}</td>
                        </tr>
                        <tr>
                            <th>Etapa</th>
                            <td>{{$dato->etapa->nom_etapa}}</td>
                        </tr>
                        <tr>
                            <th>Archivo excel de cotización</th>
                            <td>
                                {{$dato->cotizacion->nom_archivo}}
                                @if ($dato->cotizacion->ruta_archivo)
                                    &nbsp- 
                                    <a class="descargar-archivo" href="{{ route('cotizacion.descargarCotizacion', $dato->pk_proyecto_general) }}" title="Descargar archivo">
                                        ( <i class="bi bi-download"></i> )
                                    </a>
                                    <a class="ver_codigo" href="{{ route('cotizacionesRegistradas', $dato->pk_cotizacion) }}" title="Ver cotización">
                                        - ( <i class="bi bi-eye"></i> )
                                    </a>
                                @else
                                    <h6 style="color: rgb(99, 99, 99)">No se ha cargado ninguna cotización</h6>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Ubicación</th>
                            <td>
                                {{$dato->nom_ubicacion_proyecto}}
                                @if ($dato->imagen_ubicacion)
                                    &nbsp- 
                                    <a class="descargar-archivo" href="{{route('proyecto_general.descargarImagen', $dato->pk_proyecto_general)}}" title="Descargar imagen">
                                        ( <i class="bi bi-download"></i> )
                                    </a>
                                @else
                                    <h6 style="color: rgb(99, 99, 99)">No se ha cargado ninguna imagen</h6>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Plano PDF</th>
                            <td>
                                @if ($dato->plano_pdf)
                                    <a class="descargar-archivo" href="{{route('proyecto_general.descargarPlano', $dato->pk_proyecto_general)}}" title="Descargar plano">
                                        Descargar plano <i class="bi bi-download"></i>
                                    </a>
                                @else
                                    <h6 style="color: rgb(99, 99, 99)">No se ha cargado ningun plano</h6>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Empleado que autorizó</th>
                            <td>
                                {{$dato->empleado->datos_comunes->nombres.' '.$dato->empleado->datos_comunes->a_paterno.' '.$dato->empleado->datos_comunes->a_materno}} - 
                                <a class="ver_codigo" href="{{ route('empleadosRegistrados', $dato->pk_empleado) }}">
                                    <i class="bi bi-eye" title="Ver empleado"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Total MN</th>
                            <td>
                                @if ($dato->importe_total_mn !== null)
                                    ${{$dato->importe_total_mn}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Cantidad restante MN</th>
                            <td>
                                @if ($dato->cantidad_restante_mn !== null)
                                    ${{$dato->cantidad_restante_mn}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Total Dls</th>
                            <td>
                                @if ($dato->importe_total_dls !== null)
                                    ${{$dato->importe_total_dls}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Cantidad restante Dls</th>
                            <td>
                                @if ($dato->cantidad_restante_dls !== null)
                                    ${{$dato->cantidad_restante_dls}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Estatus</th>
                            <td>{{$dato->estatus}}</td>
                        </tr>
                        <tr>
                            <table class="table table-bordered border-list table-vertical" id="tabla-completa">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Código</th>
                                        <th>Unidad</th>
                                        <th>Descuento</th>
                                        <th>Precio unitario MN</th>
                                        <th>Importe MN</th>
                                        <th>Precio unitario DLS</th>
                                        <th>Importe DLS</th>
                                    </tr>
                                </thead>
                                @foreach ($dato->productos as $producto)
                                    <tr>
                                        <td>{{$producto->nom_producto}}</td>
                                        <td>
                                            @foreach ($dato->proyecto_producto as $proy_prod)
                                                @if ($proy_prod->fk_almacen_existencias == $producto->pk_producto)
                                                    {{$proy_prod->cant_unidades}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$producto->pk_producto}}</td>
                                        <td>{{$producto->unidad_medida->tipo_unidad}}</td>
                                        <td>
                                            @foreach ($dato->proyecto_producto as $proy_prod)
                                                @if ($proy_prod->fk_almacen_existencias == $producto->pk_producto)
                                                    {{$proy_prod->descuento}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($producto->precio_unitario_mn !== null)
                                                ${{$producto->precio_unitario_mn}}
                                            @else
                                                $0.00
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($dato->proyecto_producto as $proy_prod)
                                                @if ($proy_prod->fk_almacen_existencias == $producto->pk_producto)
                                                    @if ($proy_prod->importe_mn !== null)
                                                        ${{$proy_prod->importe_mn}}
                                                    @else
                                                        $0.00
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($producto->precio_unitario_dls !== null)
                                                ${{$producto->precio_unitario_dls}}
                                            @else
                                                $0.00
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($dato->proyecto_producto as $proy_prod)
                                                @if ($proy_prod->fk_almacen_existencias == $producto->pk_producto)
                                                    @if ($proy_prod->importe_dls !== null)
                                                        ${{$proy_prod->importe_dls}}
                                                    @else
                                                        $0.00
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </tr>
                    @endforeach
                </table>

                <div style="text-align: center">
                    <a href="{{route('proyecto_general.actualizado', $dato->pk_proyecto_general)}}" title="Editar datos" class="filtrados" id="filtrados">
                        <i style="color: white" class="bi bi-pencil-square"></i>
                    </a>
                    @if ($dato->estatus == 'Activo')
                        <a href="{{route('proyecto_general.bloquear', $dato->pk_proyecto_general)}}" title="Bloquear" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-lock"></i>
                        </a>
                    @else
                        <a href="{{route('proyecto_general.activar', $dato->pk_proyecto_general)}}" title="Activar" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-unlock"></i>
                        </a>
                    @endif
                    <a href="{{route('proyectosRegistrados')}}" title="Ver proyectos" class="filtrados" id="filtrados">
                        <i style="color: white" class="bi bi-list"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>