<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/sitehasa_isotipo.ico') }}" rel="icon">
    <title>Empleado</title>
</head>
<body class="fondo">
    @include('header2') <br>
    @include('mensaje')

    <div class="main">
        <div class="container">
            @foreach ($datos_empleado as $dato)
                <h2>Empleado - {{$dato->pk_empleado}}</h2>
                <div class="position-regresar">
                    <a href="{{route('empleadosRegistrados')}}" title="Regresar">
                        <i id="icono-regresar" class="bi bi-arrow-right"></i>
                    </a>
                </div>
            @endforeach
            <div style="padding-bottom: 4%" class="table-back">
                <table class="table table-bordered border-list table-vertical" id="tabla-completa">
                    @foreach ($datos_empleado as $dato)
                        <tr>
                            <th>Código</th>
                            <td>{{$dato->pk_empleado}}</td>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <td>{{$dato->nombres.' '.$dato->a_paterno.' '.$dato->a_materno}}</td>
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
                            <th>Puesto de empleado</th>
                            <td>{{$dato->nom_puesto}}</td>
                        </tr>
                        <tr>
                            <th>Currículum</th>
                            <td>
                                @if ($dato->curriculum)
                                    <a class="descargar-archivo" href="{{route('empleado.descargar', $dato->pk_empleado)}}" title="Descargar currículum">
                                        Descargar currículum <i class="bi bi-download"></i>
                                    </a>
                                @else
                                    <h6 style="color: rgb(99, 99, 99)">No se ha cargado ningun currículum</h6>
                                @endif
                            </td>
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
                    <a href="{{route('empleado.actualizado', $dato->pk_empleado)}}" title="Editar datos" class="filtrados" id="filtrados">
                        <i style="color: white" class="bi bi-pencil-square"></i>
                    </a>
                    @if ($dato->estatus == 'Activo')
                        <a href="{{route('empleado.bloquear', $dato->pk_empleado)}}" title="Bloquear" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-lock"></i>
                        </a>
                    @else
                        <a href="{{route('empleado.activar', $dato->pk_empleado)}}" title="Activar" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-unlock"></i>
                        </a>
                    @endif
                    <a href="{{route('empleadosRegistrados')}}" title="Ver empleados" class="filtrados" id="filtrados">
                        <i style="color: white" class="bi bi-list"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>