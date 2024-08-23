<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/sitehasa_isotipo.ico') }}" rel="icon">
    <title>Proveedor</title>
</head>
<body class="fondo">
    @include('header2') <br>
    @include('mensaje')

    <div class="main">
        <div class="container">
            @foreach ($datos_proveedor as $dato)
                <h2>Proveedor - {{$dato->pk_proveedor}}</h2>
                <div class="position-regresar">
                    <a href="{{route('proveedoresRegistrados')}}" title="Regresar">
                        <i id="icono-regresar" class="bi bi-arrow-right"></i>
                    </a>
                </div>
            @endforeach
            <div style="padding-bottom: 4%" class="table-back">
                <table class="table table-bordered border-list table-vertical" id="tabla-completa">
                    @foreach ($datos_proveedor as $dato)
                        <tr>
                            <th>Código</th>
                            <td>{{$dato->pk_proveedor}}</td>
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
                            <td>{{$dato->datos_comunes->ubicacion->municipio->estado->pais->nom_pais}}</td>
                        </tr>
                        <tr>
                            <th>Estado</th>
                            <td>{{$dato->datos_comunes->ubicacion->municipio->estado->nom_estado}}</td>
                        </tr>
                        <tr>
                            <th>Municipio</th>
                            <td>{{$dato->datos_comunes->ubicacion->municipio->nom_municipio}}</td>
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
                            <th>Extranjero</th>
                            <td>{{$dato->extranjero}}</td>
                        </tr>
                        <tr>
                            <th>Multiafectable</th>
                            <td>{{$dato->multiafectable}}</td>
                        </tr>
                        <tr>
                            <th>Riego (Tipo de proveedor)</th>
                            <td>{{$dato->riego}}</td>
                        </tr>
                        <tr>
                            <th>Cuenta contable MN</th>
                            <td>{{$dato->cuenta_contable_mn}}</td>
                        </tr>
                        <tr>
                            <th>Cuenta contable Dls</th>
                            <td>{{$dato->cuenta_contable_dls}}</td>
                        </tr>
                        <tr>
                            <th>Cuenta complementaria</th>
                            <td>{{$dato->cuenta_complementaria}}</td>
                        </tr>
                        <tr>
                            <th>Cuenta afectable</th>
                            <td>{{$dato->cuenta_afectable}}</td>
                        </tr>
                        <tr>
                            <th>Días de crédito</th>
                            <td>{{$dato->dias_credito}}</td>
                        </tr>
                        <tr>
                            <th>Tiempo de surtido</th>
                            <td>{{$dato->tiempo_surtido}}</td>
                        </tr>
                        <tr>
                            <th>Tipo de proveedor</th>
                            <td>{{$dato->nom_tipo_proveedor}}</td>
                        </tr>
                        <tr>
                            <th>Tipo de operación</th>
                            <td>{{$dato->nom_tipo_operacion}}</td>
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
                    <a href="{{route('proveedor.actualizado', $dato->pk_proveedor)}}" title="Editar datos" class="filtrados" id="filtrados">
                        <i style="color: white" class="bi bi-pencil-square"></i>
                    </a>
                    @if ($dato->estatus == 'Activo')
                        <a href="{{route('proveedor.bloquear', $dato->pk_proveedor)}}" title="Bloquear" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-lock"></i>
                        </a>
                    @else
                        <a href="{{route('proveedor.activar', $dato->pk_proveedor)}}" title="Activar" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-unlock"></i>
                        </a>
                    @endif
                    <a href="{{route('proveedoresRegistrados')}}" title="Ver proveedores" class="filtrados" id="filtrados">
                        <i style="color: white" class="bi bi-list"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>