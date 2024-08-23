<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="img/sitehasa_isotipo.ico" rel="icon">
    <title>Entradas</title>
</head>
<body class="fondo">
    @include('header2') <br>
    @include('mensaje')

    <div class="main">
        <div class="container">
            <h2>Entradas registradas</h2>
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
                                <a class="filtro2 {{Request::route()->getName()=='entrada.mostrar'?'filtro-activo':''}}" id="filtro2" href="{{route('entrada.mostrar')}}">
                                    Todos
                                </a>
                                <br>
                            </div>
                            <div class="filtro1">
                                <a class="filtro2 {{Request::route()->getName()=='entrada.activos'?'filtro-activo':''}}" id="filtro2" href="{{route('entrada.activos')}}">
                                    Activos
                                </a>
                                <br>
                            </div>
                            <div class="filtro1">
                                <a class="filtro2 {{Request::route()->getName()=='entrada.bloqueados'?'filtro-activo':''}}" id="filtro2" href="{{route('entrada.bloqueados')}}">
                                    Bloqueados
                                </a>
                                <br>
                            </div>
                            <hr>
                            <div class="filtro1">
                                <form action="{{route('entrada.filtrarPorRangoFechas')}}" method="GET">
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
                <table class="table table-bordered border-list" id="tabla-entradas">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descripción de la entrada</th>
                            <th>Tipo de entrada</th>
                            <th>Sucursal</th>
                            <th>Fecha de entrada</th>
                            <th>Estatus</th>
                            <th>
                                
                            </th>
                        </tr>
                    </thead>
                    @foreach ($datos_entrada as $dato)
                        <tr>
                            <td>{{$dato->pk_entrada}}</td>
                            <td>{{$dato->descripcion_entrada}}</td>
                            <td>{{$dato->nom_entrada}}</td>
                            <td>{{$dato->nom_sucursal}}</td>
                            <td>{{$dato->fecha_entrada}}</td>
                            <td>{{$dato->estatus}}</td>
                            <td>
                                <div class="opciones">
                                    <div>
                                        @if ($dato->estatus == 'Activo')
                                            <a href="{{route('entrada.bloquear', $dato->pk_entrada)}}">
                                                <i class="bi bi-lock" title="Bloquear"></i>
                                            </a>
                                        @else
                                            <a href="{{route('entrada.activar', $dato->pk_entrada)}}">
                                                <i class="bi bi-unlock" title="Activar"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{route('entrada.allInfo', $dato->pk_entrada)}}">
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
            $('#tabla-entradas').DataTable({
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
    </script>
    

</body>
</html>