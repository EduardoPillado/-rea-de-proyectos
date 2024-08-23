<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/sitehasa_isotipo.ico') }}" rel="icon">
    <title>Cotización</title>
</head>
<body class="fondo">
    @include('header2') <br>
    @include('mensaje')

    <div class="main">
        <div class="container">
            @foreach ($datos_cotizacion as $dato)
                <h2>Cotización - {{$dato->pk_cotizacion}}</h2>
                <div class="position-regresar">
                    <a href="{{route('cotizacionesRegistradas')}}" title="Regresar">
                        <i id="icono-regresar" class="bi bi-arrow-right"></i>
                    </a>
                </div>
            @endforeach
            <div style="padding-bottom: 4%" class="table-back">
                <table class="table table-bordered border-list table-vertical" id="tabla-completa">
                    @foreach ($datos_cotizacion as $dato)
                        <tr>
                            <th>Código</th>
                            <td>{{$dato->pk_cotizacion}}</td>
                        </tr>
                        <tr>
                            <th>Nombre de la cotización</th>
                            <td>{{$dato->nom_archivo}}</td>
                        </tr>
                        <tr>
                            <th>Archivo excel de cotización</th>
                            <td>
                                @if ($dato->ruta_archivo)
                                    <a class="descargar-archivo" href="{{route('cotizacion.descargarCotizacion', $dato->pk_cotizacion)}}" title="Descargar archivo">
                                        <i class="bi bi-download"></i>
                                    </a>
                                @else
                                    <h6 style="color: rgb(99, 99, 99)">No se ha cargado ninguna cotización</h6>
                                @endif
                            </td>
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
                            <th>Estado</th>
                            <td>{{$dato->estado->nom_estado}}</td>
                        </tr>
                        <tr>
                            <th>Ubicación</th>
                            <td>{{$dato->ubicacion->nom_ubicacion}}</td>
                        </tr>
                        <tr>
                            <th>Sucursal</th>
                            <td>{{$dato->sucursal->nom_sucursal}}</td>
                        </tr>
                        <tr>
                            <th>Área regable</th>
                            <td>{{$dato->area_regable}}</td>
                        </tr>
                        <tr>
                            <th>Vigencia de la cotización (Días)</th>
                            <td>{{$dato->vigencia_cotizacion}}</td>
                        </tr>
                        <tr>
                            <th>Subtotal moneda nacional</th>
                            <td>
                                @if ($dato->coti_importe_total_mn !== null)
                                    ${{$dato->coti_importe_total_mn}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Subtotal dólares</th>
                            <td>
                                @if ($dato->coti_importe_total_dls !== null)
                                    ${{$dato->coti_importe_total_dls}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha de cotización</th>
                            <td>{{$dato->fecha_cotizacion}}</td>
                        </tr>
                        <tr>
                            <th>Estatus</th>
                            <td>{{$dato->estatus}}</td>
                        </tr>
                        <tr>
                            <table class="table table-bordered border-list table-vertical" id="tabla-completa">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Concepto</th>
                                        <th>Unidad</th>
                                        <th>Cantidad</th>
                                        <th>Precio unitario moneda nacional</th>
                                        <th>Importe moneda nacional</th>
                                        <th>Precio unitario dólares</th>
                                        <th>Importe dólares</th>
                                    </tr>
                                </thead>
                                    @foreach ($dato->excelCotizaciones as $dp)
                                        <tr>
                                            <td>{{$dp->pk_excel_cotizacion}}</td>
                                            <td>{{$dp->concepto}}</td>
                                            <td>{{$dp->coti_unidad}}</td>
                                            <td>{{$dp->coti_cant_unidades}}</td>
                                            <td>
                                                @if ($dp->coti_precio_unitario_mn !== null)
                                                    ${{$dp->coti_precio_unitario_mn}}
                                                @else
                                                    $0.00
                                                @endif
                                            </td>
                                            <td>
                                                @if ($dp->coti_importe_mn !== null)
                                                    ${{$dp->coti_importe_mn}}
                                                @else
                                                    $0.00
                                                @endif
                                            </td>
                                            <td>
                                                @if ($dp->coti_precio_unitario_dls !== null)
                                                    ${{$dp->coti_precio_unitario_dls}}
                                                @else
                                                    $0.00
                                                @endif
                                            </td>
                                            <td>
                                                @if ($dp->coti_importe_dls !== null)
                                                    ${{$dp->coti_importe_dls}}
                                                @else
                                                    $0.00
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </tr>
                    @endforeach
                </table>

                <div style="text-align: center">
                    @if ($dato->estatus == 'Activo')
                        <a href="{{route('cotizacion.bloquear', $dato->pk_cotizacion)}}" title="Bloquear" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-lock"></i>
                        </a>
                    @else
                        <a href="{{route('cotizacion.activar', $dato->pk_cotizacion)}}" title="Activar" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-unlock"></i>
                        </a>
                    @endif
                    <a href="{{route('cotizacionesRegistradas')}}" title="Ver cotizaciones" class="filtrados" id="filtrados">
                        <i style="color: white" class="bi bi-list"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>