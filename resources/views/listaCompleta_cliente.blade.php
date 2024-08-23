<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/sitehasa_isotipo.ico') }}" rel="icon">
    <title>Cliente</title>
</head>
<body class="fondo">
    @include('header2') <br>
    @include('mensaje')

    <div class="main">
        <div class="container">
            @foreach ($datos_cliente as $dato)
                <h2>Cliente - {{$dato->pk_cliente}}</h2>
                <div class="position-regresar">
                    <a href="{{route('clientesRegistrados')}}" title="Regresar">
                        <i id="icono-regresar" class="bi bi-arrow-right"></i>
                    </a>
                </div>
            @endforeach
            <div style="padding-bottom: 4%" class="table-back">
                <table class="table table-bordered border-list table-vertical" id="tabla-completa">
                    @foreach ($datos_cliente as $dato)
                        <tr>
                            <th>Código</th>
                            <td>{{$dato->pk_cliente}}</td>
                        </tr>
                        <tr>
                            <th>Razón social o nombre</th>
                            <td>{{$dato->razon_social.' '.$dato->nombres.' '.$dato->a_paterno.' '.$dato->a_materno}}</td>
                        </tr>
                        <tr>
                            <th>Correo</th>
                            <td>{{$dato->correo}}</td>
                        </tr>
                        <tr>
                            <th>Teléfono</th>
                            <td>{{$dato->telefono}}</td>
                        </tr>
                        <tr>
                            <th>RFC</th>
                            <td>{{$dato->rfc}}</td>
                        </tr>
                        <tr>
                            <th>País</th>
                            <td>{{$dato->datos_comunes->pais->nom_pais}}</td>
                        </tr>
                        <tr>
                            <th>Estado</th>
                            <td>{{$dato->datos_comunes->estado->nom_estado}}</td>
                        </tr>
                        <tr>
                            <th>Municipio</th>
                            <td>{{$dato->datos_comunes->municipio->nom_municipio}}</td>
                        </tr>
                        <tr>
                            <th>Ciudad/Ubicación</th>
                            <td>{{$dato->datos_comunes->ubicacion->nom_ubicacion}}</td>
                        </tr>
                        <tr>
                            <th>Nacionalidad</th>
                            <td>{{$dato->datos_comunes->nacionalidad->nom_nacionalidad}}</td>
                        </tr>
                        <tr>
                            <th>Régimen fiscal</th>
                            <td>{{$dato->regimen_fiscal}}</td>
                        </tr>
                        <tr>
                            <th>Uso de CFDI</th>
                            <td>{{$dato->uso_cfdi}}</td>
                        </tr>
                        <tr>
                            <th>Calle</th>
                            <td>{{$dato->datos_comunes->direccion->calle}}</td>
                        </tr>
                        <tr>
                            <th>Colonia</th>
                            <td>{{$dato->datos_comunes->direccion->colonia}}</td>
                        </tr>
                        <tr>
                            <th>Número</th>
                            <td>{{$dato->datos_comunes->direccion->numero}}</td>
                        </tr>
                        <tr>
                            <th>Código postal</th>
                            <td>{{$dato->datos_comunes->direccion->cp}}</td>
                        </tr>
                        <tr>
                            <th>CURP</th>
                            <td>{{$dato->curp}}</td>
                        </tr>
                        <tr>
                            <th>Sucursal</th>
                            <td>{{$dato->nom_sucursal}}</td>
                        </tr>
                        <tr>
                            <th>Constancia de situación fiscal</th>
                            <td>
                                @if ($dato->constancia_situa_fiscal)
                                    <a class="descargar-archivo" href="{{route('cliente.descargar', $dato->pk_cliente)}}" title="Descargar constancia">
                                        Descargar constancia <i class="bi bi-download"></i>
                                    </a>
                                @else
                                    <h6 style="color: rgb(99, 99, 99)">No se ha cargado ninguna constancia</h6>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Cuenta contable MN</th>
                            <td>{{$dato->cuenta_contable_mn}}</td>
                        </tr>
                        <tr>
                            <th>Cuenta anticipo</th>
                            <td>{{$dato->cuenta_anticipo}}</td>
                        </tr>
                        <tr>
                            <th>Extranjero</th>
                            <td>{{$dato->extranjero}}</td>
                        </tr>
                        <tr>
                            <th>Multisucursal</th>
                            <td>{{$dato->multisucursal}}</td>
                        </tr>
                        <tr>
                            <th>Agente</th>
                            <td>{{$dato->nom_agente}}</td>
                        </tr>
                        <tr>
                            <th>Grupo de cliente</th>
                            <td>{{$dato->nom_grupo}}</td>
                        </tr>
                        <tr>
                            <th>Cliente agricultor</th>
                            <td>{{$dato->cliente_agricultor}}</td>
                        </tr>
                        <tr>
                            <th>Cliente IVA extra</th>
                            <td>{{$dato->cliente_iva_extra}}</td>
                        </tr>
                        <tr>
                            <th>Fecha de registro</th>
                            <td>{{$dato->fecha_alta}}</td>
                        </tr>
                        <tr>
                            <th>Fecha de ultima modificación</th>
                            <td>{{$dato->fecha_ult_mod}}</td>
                        </tr>
                        <tr>
                            <th>Estatus</th>
                            <td>{{$dato->estatus}}</td>
                        </tr>
                    @endforeach
                </table>

                <div style="text-align: center">
                    <a href="{{route('cliente.actualizado', $dato->pk_cliente)}}" title="Editar datos" class="filtrados" id="filtrados">
                        <i style="color: white" class="bi bi-pencil-square"></i>
                    </a>
                    @if ($dato->estatus == 'Activo')
                        <a href="{{route('cliente.bloquear', $dato->pk_cliente)}}" title="Bloquear" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-lock"></i>
                        </a>
                    @else
                        <a href="{{route('cliente.activar', $dato->pk_cliente)}}" title="Activar" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-unlock"></i>
                        </a>
                    @endif
                    <a href="{{route('clientesRegistrados')}}" title="Ver clientes" class="filtrados" id="filtrados">
                        <i style="color: white" class="bi bi-list"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>