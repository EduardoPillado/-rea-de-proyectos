<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="img/sitehasa_isotipo.ico" rel="icon">
    <title>Pagos</title>
</head>
<body class="fondo">
    @include('header2') <br>
    @include('mensaje')

    <div class="main">
        <div class="container">
            <h2>Pagos realizados</h2>
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
                                <a class="filtro2 {{Request::route()->getName()=='pago.mostrar'?'filtro-activo':''}}" id="filtro2" href="{{route('pago.mostrar')}}">
                                    Todos
                                </a>
                                <br>
                            </div>
                            <div class="filtro1">
                                <a class="filtro2 {{Request::route()->getName()=='pago.activos'?'filtro-activo':''}}" id="filtro2" href="{{route('pago.activos')}}">
                                    Activos
                                </a>
                                <br>
                            </div>
                            <div class="filtro1">
                                <a class="filtro2 {{Request::route()->getName()=='pago.bloqueados'?'filtro-activo':''}}" id="filtro2" href="{{route('pago.bloqueados')}}">
                                    Bloqueados
                                </a>
                                <br>
                            </div>
                            <hr>
                            <div class="filtro1">
                                <form action="{{route('pago.filtrarPorRangoFechas')}}" method="GET">
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
                <table class="table table-bordered border-list" id="tabla-pagos">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Sucursal</th>
                            <th>Cantidad</th>
                            <th>Moneda</th>
                            <th>Proyecto</th>
                            <th>Fecha de pago</th>
                            <th>Estatus</th>
                            <th>
                                
                            </th>
                        </tr>
                    </thead>
                    @foreach ($datos_pago as $dato)
                        <tr>
                            <td>{{$dato->pk_pago}}</td>
                            <td>{{$dato->cliente->razon_social.' '.$dato->cliente->datos_comunes->nombres.' '.$dato->cliente->datos_comunes->a_paterno.' '.$dato->cliente->datos_comunes->a_materno}}</td>
                            <td>{{$dato->sucursal->nom_sucursal}}</td>
                            <td>
                                @if ($dato->moneda->nom_moneda === 'Pesos mexicanos'
                                  || $dato->moneda->nom_moneda === 'pesos mexicanos'
                                  || $dato->moneda->nom_moneda === 'PESOS MEXICANOS'
                                  || $dato->moneda->nom_moneda === 'Pesos Mexicanos'
                                  || $dato->moneda->nom_moneda === 'Peso mexicano'
                                  || $dato->moneda->nom_moneda === 'peso mexicano'
                                  || $dato->moneda->nom_moneda === 'PESO MEXICANO'
                                  || $dato->moneda->nom_moneda === 'Peso Mexicano'
                                  || $dato->moneda->nom_moneda === 'Pesos'
                                  || $dato->moneda->nom_moneda === 'pesos'
                                  || $dato->moneda->nom_moneda === 'PESOS'
                                  || $dato->moneda->nom_moneda === 'Peso'
                                  || $dato->moneda->nom_moneda === 'peso'
                                  || $dato->moneda->nom_moneda === 'PESO'
                                  || $dato->moneda->nom_moneda === 'MN'
                                  || $dato->moneda->nom_moneda === 'mn'
                                  || $dato->moneda->nom_moneda === 'Mn'
                                  || $dato->moneda->nom_moneda === 'MXN'
                                  || $dato->moneda->nom_moneda === 'mxn'
                                  || $dato->moneda->nom_moneda === 'Mxn')
                                    @if ($dato->cant_pago_mn !== null)
                                        ${{$dato->cant_pago_mn}}
                                    @else
                                        $0.00
                                    @endif
                                @elseif ($dato->moneda->nom_moneda === 'Dólares'
                                  || $dato->moneda->nom_moneda === 'Dolares'
                                  || $dato->moneda->nom_moneda === 'dólares'
                                  || $dato->moneda->nom_moneda === 'dolares'
                                  || $dato->moneda->nom_moneda === 'DÓLARES'
                                  || $dato->moneda->nom_moneda === 'DOLARES'
                                  || $dato->moneda->nom_moneda === 'Dólar'
                                  || $dato->moneda->nom_moneda === 'Dolar'
                                  || $dato->moneda->nom_moneda === 'dólar'
                                  || $dato->moneda->nom_moneda === 'dolar'
                                  || $dato->moneda->nom_moneda === 'DÓLAR'
                                  || $dato->moneda->nom_moneda === 'DOLAR'
                                  || $dato->moneda->nom_moneda === 'DLS'
                                  || $dato->moneda->nom_moneda === 'dls'
                                  || $dato->moneda->nom_moneda === 'Dls'
                                  || $dato->moneda->nom_moneda === 'USD'
                                  || $dato->moneda->nom_moneda === 'usd'
                                  || $dato->moneda->nom_moneda === 'Usd')
                                    @if ($dato->cant_pago_dls !== null)
                                        ${{$dato->cant_pago_dls}}
                                    @else
                                        $0.00
                                    @endif
                                @endif
                            </td>
                            <td>{{$dato->moneda->nom_moneda}}</td>
                            <td>
                                <a class="ver_codigo" href="{{route('proyectosRegistrados', $dato->pk_proyecto_general)}}" title="Ver proyecto">
                                    {{$dato->proyecto_general->nom_proyecto_general}}
                                </a>
                            </td>
                            <td>{{$dato->fecha_pago}}</td>
                            <td>{{$dato->estatus}}</td>
                            <td>
                                <div class="opciones">
                                    <div>
                                        @if ($dato->estatus == 'Activo')
                                            <a href="{{route('pago.bloquear', $dato->pk_pago)}}">
                                                <i class="bi bi-lock" title="Bloquear"></i>
                                            </a>
                                        @else
                                            <a href="{{route('pago.activar', $dato->pk_pago)}}">
                                                <i class="bi bi-unlock" title="Activar"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{route('pago.allInfo', $dato->pk_pago)}}">
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
            $('#tabla-pagos').DataTable({
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