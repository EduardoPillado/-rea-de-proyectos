<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="img/sitehasa_isotipo.ico" rel="icon">
    <title>Proyectos</title>
</head>
<body class="fondo">
    @include('header2') <br>
    @include('mensaje')

    <div class="main">
        <div class="container">
            <h2>Proyectos registrados</h2>
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
                                <a class="filtro2 {{Request::route()->getName()=='proyecto_general.mostrar'?'filtro-activo':''}}" id="filtro2" href="{{route('proyecto_general.mostrar')}}">
                                    Todos
                                </a>
                                <br>
                            </div>
                            <div class="filtro1">
                                <a class="filtro2 {{Request::route()->getName()=='proyecto_general.activos'?'filtro-activo':''}}" id="filtro2" href="{{route('proyecto_general.activos')}}">
                                    Activos
                                </a>
                                <br>
                            </div>
                            <div class="filtro1">
                                <a class="filtro2 {{Request::route()->getName()=='proyecto_general.bloqueados'?'filtro-activo':''}}" id="filtro2" href="{{route('proyecto_general.bloqueados')}}">
                                    Bloqueados
                                </a>
                                <br>
                            </div>
                            <div class="filtro1">
                                <a class="filtro2 {{Request::route()->getName()=='proyecto_general.creados'?'filtro-activo':''}}" id="filtro2" href="{{route('proyecto_general.creados')}}">
                                    Creados
                                </a>
                                <br>
                            </div>
                            <div class="filtro1">
                                <a class="filtro2 {{Request::route()->getName()=='proyecto_general.aprobados'?'filtro-activo':''}}" id="filtro2" href="{{route('proyecto_general.aprobados')}}">
                                    Aprobados
                                </a>
                                <br>
                            </div>
                            <div class="filtro1">
                                <a class="filtro2 {{Request::route()->getName()=='proyecto_general.cotizados'?'filtro-activo':''}}" id="filtro2" href="{{route('proyecto_general.cotizados')}}">
                                    Cotizados
                                </a>
                                <br>
                            </div>
                            <div class="filtro1">
                                <a class="filtro2 {{Request::route()->getName()=='proyecto_general.finalizados'?'filtro-activo':''}}" id="filtro2" href="{{route('proyecto_general.finalizados')}}">
                                    Finalizados
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
                                <form action="{{route('proyecto_general.filtrarPorRangoFechas')}}" method="GET">
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
                <table class="table table-bordered border-list" id="tabla-proyectos">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Sistema de riego</th>
                            <th>Cultivo</th>
                            <th>Predio</th>
                            <th>Total MN</th>
                            <th>Total Dls</th>
                            <th>Estatus</th>
                            <th>
                                
                            </th>
                        </tr>
                    </thead>
                    @foreach ($datos_proyecto_general as $dato)
                        <tr>
                            <td>{{$dato->pk_proyecto_general}}</td>
                            <td>{{$dato->cliente->razon_social.' '.$dato->cliente->datos_comunes->nombres.' '.$dato->cliente->datos_comunes->a_paterno.' '.$dato->cliente->datos_comunes->a_materno}}</td>
                            <td>{{$dato->sistema_riego->nom_sistema}}</td>
                            <td>{{$dato->cultivo->nom_cultivo}}</td>
                            <td>{{$dato->predio}}</td>
                            <td>
                                @if ($dato->importe_total_mn !== null)
                                    ${{$dato->importe_total_mn}}
                                @else
                                    $0.00
                                @endif
                            </td>
                            <td>
                                @if ($dato->importe_total_dls !== null)
                                    ${{$dato->importe_total_dls}}
                                @else
                                    $0.00
                                @endif
                            </td>
                            <td>{{$dato->estatus}}</td>
                            <td>
                                <div class="opciones">
                                    <div>
                                        <a href="{{route('proyecto_general.actualizado', $dato->pk_proyecto_general)}}">
                                            <i class="bi bi-pencil-square" title="Editar datos"></i>
                                        </a>
                                    </div>
                                    <div>
                                        @if ($dato->estatus == 'Activo')
                                            <a href="{{route('proyecto_general.bloquear', $dato->pk_proyecto_general)}}">
                                                <i class="bi bi-lock" title="Bloquear"></i>
                                            </a>
                                        @else
                                            <a href="{{route('proyecto_general.activar', $dato->pk_proyecto_general)}}">
                                                <i class="bi bi-unlock" title="Activar"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{route('proyecto_general.allInfo', $dato->pk_proyecto_general)}}">
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
            $('#tabla-proyectos').DataTable({
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

            var tabla = $('#tabla-proyectos').DataTable();

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

            var tabla = $('#tabla-proyectos').DataTable();

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