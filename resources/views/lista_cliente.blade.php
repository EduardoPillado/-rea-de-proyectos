<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="img/sitehasa_isotipo.ico" rel="icon">
    <title>Clientes</title>
</head>
<body class="fondo">
    @include('header2') <br>
    @include('mensaje')

    <div class="main">
        <div class="container">
            <h2>Clientes registrados</h2>
            <div class="position-filtro">
                <button class="filtrados" id="filtrados" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                    Ordenar y filtrar
                </button>
            </div>
            {{-- Ordenar y filtrar --}}
                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                        <div class="offcanvas-header">
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="filtro1">
                                <a class="filtro2 {{Request::route()->getName()=='cliente.mostrar'?'filtro-activo':''}}" id="filtro2" href="{{route('cliente.mostrar')}}">
                                    Todos
                                </a>
                                <br>
                            </div>
                            <div class="filtro1">
                                <a class="filtro2 {{Request::route()->getName()=='cliente.activos'?'filtro-activo':''}}" id="filtro2" href="{{route('cliente.activos')}}">
                                    Activos
                                </a>
                                <br>
                            </div>
                            <div class="filtro1">
                                <a class="filtro2 {{Request::route()->getName()=='cliente.bloqueados'?'filtro-activo':''}}" id="filtro2" href="{{route('cliente.bloqueados')}}">
                                    Bloqueados
                                </a>
                                <br>
                            </div>
                            <hr>
                            <div class="filtro1">
                                <a class="filtro2" id="filtro2" href="#" onclick="ordenarTablaAsc(event)">
                                    A - Z
                                </a>
                                <br>
                            </div>
                            <div class="filtro1">
                                <a class="filtro2" id="filtro2" href="#" onclick="ordenarTablaDesc(event)">
                                    Z - A
                                </a>
                                <br>
                            </div>
                            <hr>
                            <div class="filtro1">
                                <form action="{{route('cliente.filtrarPorRangoFechas')}}" method="GET">
                                    <label style="margin-left: 20px">Fecha Inicial</label>
                                    <input class="filtro3" type="date" name="fecha_inicio">
                                    <label style="margin-left: 20px">Fecha Final</label>
                                    <input class="filtro3" type="date" name="fecha_fin">
                                    <br>
                                    <button class="filtro2" id="filtro2" type="submit">Filtrar fechas</button>
                                </form>
                                <br>
                            </div>
                        </div>
                    </div>
            <div class="table-back">
                <table class="table table-bordered border-list" id="tabla-clientes">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Razón social o nombre</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Sucursal</th>
                            <th>RFC</th>
                            <th>Régimen fiscal</th>
                            <th>Uso CFDI</th>
                            <th>Situación Fiscal</th>
                            <th>Estatus</th>
                            <th>
                                
                            </th>
                        </tr>
                    </thead>
                    @foreach ($datos_cliente as $dato)
                        <tr>
                            <td>{{$dato->pk_cliente}}</td>
                            <td>{{$dato->razon_social.' '.$dato->nombres.' '.$dato->a_paterno.' '.$dato->a_materno}}</td>
                            <td>{{$dato->telefono}}</td>
                            <td>{{$dato->correo}}</td>
                            <td>{{$dato->nom_sucursal}}</td>
                            <td>{{$dato->rfc}}</td>
                            <td>{{$dato->regimen_fiscal}}</td>
                            <td>{{$dato->uso_cfdi}}</td>
                            <td align="center">
                                @if ($dato->constancia_situa_fiscal)
                                    <a href="{{route('cliente.descargar', $dato->pk_cliente)}}">
                                        <i class="bi bi-download" title="Descargar constancia"></i>
                                    </a>
                                @else
                                    <h6 style="color: rgb(99, 99, 99)">No se ha cargado ninguna constancia</h6>
                                @endif
                            </td>
                            <td>{{$dato->estatus}}</td>
                            <td>
                                <div class="opciones">
                                    <div>
                                        <a href="{{route('cliente.actualizado', $dato->pk_cliente)}}">
                                            <i class="bi bi-pencil-square" title="Editar datos"></i>
                                        </a>
                                    </div>
                                    <div>
                                        @if ($dato->estatus == 'Activo')
                                            <a href="{{route('cliente.bloquear', $dato->pk_cliente)}}">
                                                <i class="bi bi-lock" title="Bloquear"></i>
                                            </a>
                                        @else
                                            <a href="{{route('cliente.activar', $dato->pk_cliente)}}">
                                                <i class="bi bi-unlock" title="Activar"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{route('cliente.allInfo', $dato->pk_cliente)}}">
                                            <i class="bi bi-info-square" title="Más información"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <script>
        // Tabla con DataTable
        $(document).ready(function () {
            $('#tabla-clientes').DataTable({
                "language": {
                "search": "Buscar:",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "zeroRecords": "Sin resultados",
                "lengthMenu": "Mostrar _MENU_ registros por página",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });

        // Orden Ascendente
        function ordenarTablaAsc(event) {
            event.preventDefault();

            var tabla = $('#tabla-clientes').DataTable();

            tabla.order([1, 'asc']).draw();

            var enlace = event.target;
            var enlaces = document.getElementsByClassName('filtro2');
            for (var i = 0; i < enlaces.length; i++) {
                if (enlaces[i] === enlace) {
                enlace.classList.add('filtro-activo');
                } else {
                enlaces[i].classList.remove('filtro-activo');
                }
            }
        }

        // Orden Descendente
        function ordenarTablaDesc(event) {
            event.preventDefault();

            var tabla = $('#tabla-clientes').DataTable();

            tabla.order([1, 'desc']).draw();

            var enlace = event.target;
            var enlaces = document.getElementsByClassName('filtro2');
            for (var i = 0; i < enlaces.length; i++) {
                if (enlaces[i] === enlace) {
                enlace.classList.add('filtro-activo');
                } else {
                enlaces[i].classList.remove('filtro-activo');
                }
            }
        }
    </script>
    

</body>
</html>