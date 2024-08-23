<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/sitehasa_isotipo.ico') }}" rel="icon">
    <title>Pago</title>
</head>
<body class="fondo">
    @include('header2') <br>
    @include('mensaje')

    <div class="main">
        <div class="container">
            @foreach ($datos_pago as $dato)
                <h2>Pago - {{$dato->pk_pago}}</h2>
                <div class="position-regresar">
                    <a href="{{route('pagosRealizados')}}" title="Regresar">
                        <i id="icono-regresar" class="bi bi-arrow-right"></i>
                    </a>
                </div>
            @endforeach
            <div style="padding-bottom: 4%" class="table-back">
                <table class="table table-bordered border-list table-vertical" id="tabla-completa">
                    @foreach ($datos_pago as $dato)
                        <tr>
                            <th>Código</th>
                            <td>{{$dato->pk_pago}}</td>
                        </tr>
                        <tr>
                            <th>Cliente</th>
                            <td>{{$dato->cliente->razon_social.' '.$dato->cliente->datos_comunes->nombres.' '.$dato->cliente->datos_comunes->a_paterno.' '.$dato->cliente->datos_comunes->a_materno}}</td>
                        </tr>
                        <tr>
                            <th>Sucursal</th>
                            <td>{{$dato->sucursal->nom_sucursal}}</td>
                        </tr>
                        <tr>
                            <th>Cantidad en pesos mexicanos</th>
                            <td>
                                @if ($dato->cant_pago_mn !== null)
                                        ${{$dato->cant_pago_mn}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Cantidad en dólares</th>
                            <td>
                                @if ($dato->cant_pago_dls !== null)
                                        ${{$dato->cant_pago_dls}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Moneda</th>
                            <td>{{$dato->moneda->nom_moneda}}</td>
                        </tr>
                        <tr>
                            <th>Tasa de conversión</th>
                            <td>{{$dato->tasa->cant_tasa}} - {{$dato->tasa->tipo_cambio}}</td>
                        </tr>
                        <tr>
                            <th>Tipo de pago</th>
                            <td>{{$dato->tipo_pago->nom_tipo_pago}}</td>
                        </tr>
                        <tr>
                            <th>Forma de pago</th>
                            <td>{{$dato->forma_pago->nom_forma_pago}}</td>
                        </tr>
                        <tr>
                            <th>Proyecto</th>
                            <td>
                                {{$dato->proyecto_general->nom_proyecto_general}} - 
                                <a class="ver_codigo" href="{{route('proyectosRegistrados', $dato->pk_proyecto_general)}}">
                                    <i class="bi bi-eye" title="Ver proyecto"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha de pago</th>
                            <td>{{$dato->fecha_pago}}</td>
                        </tr>
                        <tr>
                            <th>Estatus</th>
                            <td>{{$dato->estatus}}</td>
                        </tr>
                    @endforeach
                </table>

                <div style="text-align: center">
                    @if ($dato->estatus == 'Activo')
                        <a href="{{route('pago.bloquear', $dato->pk_pago)}}" title="Bloquear" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-lock"></i>
                        </a>
                    @else
                        <a href="{{route('pago.activar', $dato->pk_pago)}}" title="Activar" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-unlock"></i>
                        </a>
                    @endif
                    <a href="{{route('pagosRealizados')}}" title="Ver pagos" class="filtrados" id="filtrados">
                        <i style="color: white" class="bi bi-list"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>