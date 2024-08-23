<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/sitehasa_isotipo.ico') }}" rel="icon">
    <title>Producto</title>
</head>
<body class="fondo">
    @include('header2') <br>
    @include('mensaje')

    <div class="main">
        <div class="container">
            @foreach ($datos_producto as $dato)
                <h2>Producto - {{$dato->pk_producto}}</h2>
                <div class="position-regresar">
                    <a href="{{route('productosExistentes')}}" title="Regresar">
                        <i id="icono-regresar" class="bi bi-arrow-right"></i>
                    </a>
                </div>
            @endforeach
            <div style="padding-bottom: 4%" class="table-back">
                <table class="table table-bordered border-list table-vertical" id="tabla-completa">
                    @foreach ($datos_producto as $dato)
                        <tr>
                            <th>Código</th>
                            <td>{{$dato->pk_producto}}</td>
                        </tr>
                        <tr>
                            <th>Nombre del producto</th>
                            <td>{{$dato->nom_producto}}</td>
                        </tr>
                        <tr>
                            <th>Descripción</th>
                            <td>{{$dato->descrip}}</td>
                        </tr>
                        <tr>
                            <th>Imagen del producto</th>
                            <td>
                                @if ($dato->imagen_producto)
                                    <a class="descargar-archivo" href="{{route('producto.descargar', $dato->pk_producto)}}">
                                        Descargar imagen <i class="bi bi-download" title="Descargar imagen"></i>
                                    </a>
                                @else
                                    <h6 style="color: rgb(99, 99, 99)">No se ha cargado una imagen</h6>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Sucursal</th>
                            <td>{{$dato->sucursal->nom_sucursal}}</td>
                        </tr>
                        <tr>
                            <th>Área de sucursal</th>
                            <td>{{$dato->area_sucursal->nom_area}}</td>
                        </tr>
                        <tr>
                            <th>División</th>
                            <td>{{$dato->division->nom_division}}</td>
                        </tr>
                        <tr>
                            <th>Grupo de producto</th>
                            <td>{{$dato->grupo_producto->nom_grupo}}</td>
                        </tr>
                        <tr>
                            <th>Subgrupo de producto</th>
                            <td>{{$dato->subgrupo_producto->nom_subgrupo}}</td>
                        </tr>
                        <tr>
                            <th>Unidad de medida</th>
                            <td>{{$dato->unidad_medida->tipo_unidad}}</td>
                        </tr>
                        <tr>
                            <th>Clave de producto o servicio SAT</th>
                            <td>{{$dato->clave_prod_serv_sat->clave_serv}}</td>
                        </tr>
                        <tr>
                            <th>Proveedor del producto</th>
                            <td>
                                {{$dato->proveedor->razon_social.' '.$dato->proveedor->datos_comunes->nombres.' '.$dato->proveedor->datos_comunes->a_paterno.' '.$dato->proveedor->datos_comunes->a_materno}} - 
                                <a class="ver_codigo" href="{{ route('proveedoresRegistrados', $dato->pk_proveedor) }}">
                                    <i class="bi bi-eye" title="Ver proveedor"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Moneda</th>
                            <td>{{$dato->moneda->nom_moneda}}</td>
                        </tr>
                        <tr>
                            <th>Precio unitario MN</th>
                            <td>
                                @if ($dato->precio_unitario_mn !== null)
                                    ${{$dato->precio_unitario_mn}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Precio unitario Dls</th>
                            <td>
                                @if ($dato->precio_unitario_dls !== null)
                                    ${{$dato->precio_unitario_dls}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Precio proyecto MN</th>
                            <td>
                                @if ($dato->precio_proyecto_mn !== null)
                                    ${{$dato->precio_proyecto_mn}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Precio proyecto Dls</th>
                            <td>
                                @if ($dato->precio_proyecto_dls !== null)
                                    ${{$dato->precio_proyecto_dls}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Precio especial MN</th>
                            <td>
                                @if ($dato->precio_especial_mn !== null)
                                    ${{$dato->precio_especial_mn}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Precio especial Dls</th>
                            <td>
                                @if ($dato->precio_especial_dls !== null)
                                    ${{$dato->precio_especial_dls}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Costo promedio MN</th>
                            <td>
                                @if ($dato->costo_promedio_mn !== null)
                                    ${{$dato->costo_promedio_mn}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Costo promedio Dls</th>
                            <td>
                                @if ($dato->costo_promedio_dls !== null)
                                    ${{$dato->costo_promedio_dls}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Ultimo costo MN</th>
                            <td>
                                @if ($dato->ultimo_costo_mn !== null)
                                    ${{$dato->ultimo_costo_mn}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Ultimo costo Dls</th>
                            <td>
                                @if ($dato->ultimo_costo_dls !== null)
                                    ${{$dato->ultimo_costo_dls}}
                                @else
                                    $0.00
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Margen de utilidad %</th>
                            <td>
                                @if ($dato->margen_utilidad_porcentaje !== null)
                                    {{$dato->margen_utilidad_porcentaje}}%
                                @else
                                    0%
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>IVA</th>
                            <td>
                                @if ($dato->iva->cant_iva !== null)
                                    {{$dato->iva->cant_iva}}%
                                @else
                                    0.00%
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha de ultima modificación</th>
                            <td>{{$dato->fecha_ultima_mod}}</td>
                        </tr>
                        <tr>
                            <th>Estatus</th>
                            <td>{{$dato->estatus}}</td>
                        </tr>
                    @endforeach
                </table>

                <div style="text-align: center">
                    <a href="{{route('producto.actualizado', $dato->pk_producto)}}" title="Editar datos" class="filtrados" id="filtrados">
                        <i style="color: white" class="bi bi-pencil-square"></i>
                    </a>
                    @if ($dato->estatus == 'Activo')
                        <a href="{{route('producto.bloquear', $dato->pk_producto)}}" title="Bloquear" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-lock"></i>
                        </a>
                    @else
                        <a href="{{route('producto.activar', $dato->pk_producto)}}" title="Activar" class="filtrados" id="filtrados">
                            <i style="color: white" class="bi bi-unlock"></i>
                        </a>
                    @endif
                    <a href="{{route('productosExistentes')}}" title="Ver productos" class="filtrados" id="filtrados">
                        <i style="color: white" class="bi bi-list"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>