<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/sitehasa_isotipo.ico') }}" rel="icon">
    <title>Salida</title>
</head>
<body class="fondo">
    @include('header2') <br>
    @include('mensaje')

    <div class="main">
        <div class="container">
            @foreach ($datos_salida as $dato)
                <h2>Salida - {{$dato->pk_salida}}</h2>
                <div class="position-regresar">
                    <a href="{{route('salidasRegistradas')}}" title="Regresar">
                        <i id="icono-regresar" class="bi bi-arrow-right"></i>
                    </a>
                </div>
            @endforeach
            <div style="padding-bottom: 4%" class="table-back">
                <table class="table table-bordered border-list table-vertical" id="tabla-completa">
                    @foreach ($datos_salida as $dato)
                        <tr>
                            <th>Código</th>
                            <td>{{$dato->pk_salida}}</td>
                        </tr>
                        <tr>
                            <th>Descripción de la salida</th>
                            <td>{{$dato->descripcion_salida}}</td>
                        </tr>
                        <tr>
                            <th>Tipo de salida</th>
                            <td>{{$dato->nom_salida}}</td>
                        </tr>
                        <tr>
                            <th>Sucursal</th>
                            <td>{{$dato->nom_sucursal}}</td>
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
                            <th>IVA</th>
                            <td>{{$dato->cant_iva}}</td>
                        </tr>
                        <tr>
                            <th>Comentarios</th>
                            <td>{{$dato->comentario_salida}}</td>
                        </tr>
                        <tr>
                            <th>Fecha de salida</th>
                            <td>{{$dato->fecha_salida}}</td>
                        </tr>
                        <tr>
                            <th>Estatus</th>
                            <td>{{$dato->estatus}}</td>
                        </tr>
                        <tr>
                            <table class="table table-bordered border-list" id="tabla-completa">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Código</th>
                                        <th>Unidad</th>
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
                                            @foreach ($dato->salida_producto as $sld_prod)
                                                @if ($sld_prod->fk_almacen_existencias == $producto->pk_producto)
                                                    {{$sld_prod->cant_unidades}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$producto->pk_producto}}</td>
                                        <td>{{$producto->unidad_medida->tipo_unidad}}</td>
                                        <td>
                                            @if ($producto->precio_unitario_mn !== null)
                                                ${{$producto->precio_unitario_mn}}
                                            @else
                                                $0.00
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($dato->salida_producto as $sld_prod)
                                                @if ($sld_prod->fk_almacen_existencias == $producto->pk_producto)
                                                    @if ($sld_prod->importe_mn !== null)
                                                        ${{$sld_prod->importe_mn}}
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
                                            @foreach ($dato->salida_producto as $sld_prod)
                                                @if ($sld_prod->fk_almacen_existencias == $producto->pk_producto)
                                                    @if ($sld_prod->importe_dls !== null)
                                                        ${{$sld_prod->importe_dls}}
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
                    @if ($dato->estatus == 'Activo')
                        <a href="{{route('salida.bloquear', $dato->pk_salida)}}" title="Bloquear" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-lock"></i>
                        </a>
                    @else
                        <a href="{{route('salida.activar', $dato->pk_salida)}}" title="Activar" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-unlock"></i>
                        </a>
                    @endif
                    <a href="{{route('salidasRegistradas')}}" title="Ver salidas" class="filtrados" id="filtrados">
                        <i style="color: white" class="bi bi-list"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>