<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="img/sitehasa_isotipo.ico" rel="icon">
    <title>Agregar proyecto</title>
</head>
<body class="fondo">
    @include('header2') <br>
    @include('mensaje')

    @php
        use Carbon\Carbon;

        use App\Models\Pais;
        $datos_pais=Pais::all();

        use App\Models\Estado;
        $datos_estado=Estado::all();

        use App\Models\Municipio;
        $datos_municipio=Municipio::all();

        use App\Models\Ubicacion;
        $datos_ubicacion=Ubicacion::all();

        use App\Models\Sucursal;
        $datos_sucursal=Sucursal::all();

        use App\Models\Sistema_riego;
        $datos_sistema_riego=Sistema_riego::all();

        use App\Models\Cultivo;
        $datos_cultivo=Cultivo::all();

        use App\Models\Categoria_proyecto;
        $datos_categoria_proyecto=Categoria_proyecto::all();

        use App\Models\Etapa;
        $datos_etapa=Etapa::all();

        use App\Models\Cotizacion;
        $datos_cotizacion=Cotizacion::all();

        use App\Models\Cliente;
        $datos_cliente=Cliente::all();

        use App\Models\Producto;
        $datos_producto=Producto::all();

        use App\Models\Almacen_existencias;
        $datos_almacen_existencias=Almacen_existencias::all();

        use App\Models\Empleado;
        $datos_empleado=Empleado::all();
    @endphp

<div class="main">
    <div class="container">
        <h2>Agregar proyecto</h2>
        <div class="contenido">
            <div class="form1">
                <form action="{{route('proyecto_general.insertar')}}" method="post" class="form2" id="form2" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-grupo">

                            <div class="label-flex">
                                <label class="required">Cliente</label>
                                <a type="button" href="{{route('agregarClientes')}}" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_cliente" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_cliente as $dp)
                                    @if ($dp->estatus === 'Activo')
                                        <option value="{{ $dp->pk_cliente }}">
                                            {{ $dp->razon_social.' '.$dp->datos_comunes->nombres.' '.$dp->datos_comunes->a_paterno.' '.$dp->datos_comunes->a_materno }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                            <div class="form-campo">
                                <label for="nom_proyecto_general" class="required">Nombre del proyecto</label>
                                <input type="text" name="nom_proyecto_general" id="nom_proyecto_general" required>
                            </div>
                        </div>
                        <div class="form-grupo">

                            <div class="label-flex">
                                <label class="required">Sucursal</label>
                                <a type="button" onclick="openFormSucursal()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_sucursal" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_sucursal as $dp)
                                    <option value="{{$dp->pk_sucursal}}">{{$dp->nom_sucursal}}</option>
                                @endforeach
                            </select>

                            <div class="label-flex">
                                <label class="required">Cultivo</label>
                                <a type="button" onclick="openFormCultivo()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_cultivo" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_cultivo as $dp)
                                    <option value="{{$dp->pk_cultivo}}">{{$dp->nom_cultivo}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-grupo">

                            <div class="label-flex">
                                <label class="required">Sistema de riego</label>
                                <a type="button" onclick="openFormSistemaRiego()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_sistema_riego" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_sistema_riego as $dp)
                                    <option value="{{$dp->pk_sistema_riego}}">{{$dp->nom_sistema}}</option>
                                @endforeach
                            </select>

                            <div class="form-campo">
                                <label for="superficie" class="required">Superficie (Hectáreas)</label>
                                <input type="decimal" name="superficie" id="superficie" required />
                            </div>
                        </div>
                    </div>
                    <hr style="height: 2px">
                    <div class="form-row">
                        <div class="form-grupo">
                            <div class="form-campo">
                                <label for="vigencia_dias" class="required">Vigencia (Días)</label>
                                <input type="number" name="vigencia_dias" id="vigencia_dias" required>
                            </div>
                        </div>
                        <div class="form-grupo">
                            <div class="form-campo">
                                <label for="predio" class="required">Predio</label>
                                <input type="text" name="predio" id="predio" required>
                            </div>
                        </div>
                        <div class="form-grupo">
                            <div class="label-flex">
                                <label class="required">Etapa</label>
                                <a type="button" onclick="openFormEtapa()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_etapa" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_etapa as $dp)
                                    <option value="{{$dp->pk_etapa}}">{{$dp->nom_etapa}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-grupo">

                            <div class="label-flex">
                                <label>Categoria de proyecto</label>
                                <a type="button" onclick="openFormCategoriaProyecto()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_categoria_proyecto">
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_categoria_proyecto as $dp)
                                    <option value="{{$dp->pk_categoria_proyecto}}">{{$dp->nom_cat_proy}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-grupo">

                            <div class="label-flex">
                                <label>Cotización</label>
                                <a type="button" href="{{route('agregarCotizacion')}}" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_cotizacion">
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_cotizacion as $dp)
                                    @if ($dp->estatus === 'Activo')
                                        <option value="{{$dp->pk_cotizacion}}">{{$dp->nom_archivo}}</option>
                                    @endif
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <hr style="height: 2px">
                    <div class="form-row">
                        <div class="form-grupo">
                            <div class="form-campo">
                                <label for="nom_ubicacion_proyecto" class="required">Nombre de la ubicación</label>
                                <input type="text" name="nom_ubicacion_proyecto" id="nom_ubicacion_proyecto" required>
                            </div>
                        </div>
                        <div class="form-grupo">

                            <div class="form-campo">
                                <div class="label-flex">
                                    <label for="imagen_ubicacion">Imagen de la ubicación</label>
                                    <a 
                                    type="button" 
                                    href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwi-sum9g_3_AhU4LUQIHQmCCfsQFnoECA4QAQ&url=https%3A%2F%2Fmaps.google.com.mx%2F&usg=AOvVaw2o_5i9bEqELS4JAlR-LRVQ&opi=89978449" 
                                    target="_blank"
                                    class="form-link">
                                        buscar ubicación
                                    </a>
                                </div>
                                    <input type="file" name="imagen_ubicacion" id="imagen_ubicacion" />
                            </div>

                        </div>
                        <div class="form-grupo">
                            
                            <div class="form-campo">
                                <label for="plano_pdf">Plano PDF</label>
                                <input type="file" name="plano_pdf" id="plano_pdf" />
                            </div>

                        </div>
                    </div>
                    <hr style="height: 2px">
                    <div class="form-row">
                        <div class="form-grupo-completo">
                            <label class="required">Productos</label>
                            <div class="table-back">
                                <table class="table border-list table-select-prod">
                                    <tr>
                                        <th>Selección</th>
                                        <th>Producto</th>
                                        <th>Existencias</th>
                                        <th>Cantidad</th>
                                        <th>Descuento</th>
                                    </tr>
                                    @foreach ($datos_almacen_existencias as $dp)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="fk_almacen_existencias[]"
                                                    value="{{ $dp->pk_almacen_existencias }}" 
                                                    class="seleccionado form-check-input me-3"
                                                    onchange="actualizar(this)"
                                                    >
                                            </td>
                                            <td>{{ $dp->producto->nom_producto }}</td>
                                            <td>{{ $dp->cant_existencias }}</td>
                                            <td>
                                                <input type="number" name="cant_unidades_{{ $dp->pk_almacen_existencias }}" id="cant_unidades">
                                            </td>
                                            <td>
                                                <input type="decimal" name="descuento_{{ $dp->pk_almacen_existencias }}" id="descuento">
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr style="height: 2px">
                    <div class="form-row">
                        <div class="form-grupo">

                            <div class="label-flex">
                                <label class="required">Autoriza</label>
                                <a type="button" href="{{route('agregarEmpleados')}}" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_empleado" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_empleado as $dp)
                                    @if ($dp->estatus === 'Activo')
                                        <option value="{{$dp->pk_empleado}}">
                                            {{$dp->datos_comunes->nombres.' '.$dp->datos_comunes->a_paterno.' '.$dp->datos_comunes->a_materno}}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <br><hr style="height: 2px"><br>
                    <div class="form-row">
                        <div class="form-grupo">
                            <div class="form-campo">
                                <label for="fecha_inicio">Fecha de inicio: </label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-submit">
                        <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
                    </div>

                    <h6 style="color: red">* Campos obligatorios</h6>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function actualizar(checkbox) {
        var inputCantidadUnidades = checkbox.parentNode.parentNode.querySelector('input[id="cant_unidades"]');
        var inputDescuento = checkbox.parentNode.parentNode.querySelector('input[id="descuento"]');
        inputCantidadUnidades.value = checkbox.checked ? '1' : '';
        inputDescuento.value = checkbox.checked ? '0' : '';
    }
</script>

{{-- Pais --}}
<dialog id="formDialogPais">
    <form id="formPais" onsubmit="return submitFormPais(event)" action="{{route('agregarPais')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar país</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormPais()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_pais" class="required">Nombre del país</label>
                <input type="text" name="nom_pais" id="nom_pais" required />
            </div>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajePais" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormPais() {
        var dialog = document.getElementById("formDialogPais");
        dialog.showModal();
    }

    function closeFormPais() {
        var dialog = document.getElementById("formDialogPais");
        dialog.close();
    }

    function resetFormPais() {
        var form = document.querySelector("#formPais");
        form.reset();

        resetFormEstado();
    }

    function submitFormPais(event) {
        event.preventDefault();

        var nom_pais = document.getElementById('nom_pais').value;

        if (nom_pais.trim() === '') {
            alert('El nombre del país es requerido');
            return;
        }

        var form = document.getElementById('formPais');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var pais = response.pais;
                        var mensaje = document.getElementById("mensajePais");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var selectEstado = document.querySelector('select[name="fk_pais_estado"]');
                        var optionEstado = document.createElement("option");
                        optionEstado.value = response.pais.pk_pais;
                        optionEstado.textContent = pais.nom_pais;
                        selectEstado.appendChild(optionEstado);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormPais();
                            resetFormPais();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajePais");
                        mensaje.textContent = "Hay un problema, verifica la información";
                        mensaje.style.color = "red";
                    }
                }
                mensaje.style.display = "block";
            }
        };
        xhr.send(formData);
        clearTimeout(mensajeTimeout);
    }

</script>

{{-- Estado --}}
<dialog id="formDialogEstado">
    <form id="formEstado" onsubmit="return submitFormEstado(event)" action="{{route('agregarEstado')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar estado</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormEstado()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_estado" class="required">Nombre del estado</label>
                <input type="text" name="nom_estado" id="nom_estado" required />
            </div>
            <div class="label-flex">
                <label>País</label>
                <a type="button" onclick="openFormPais()" class="form-link">agregar</a>
            </div>
            <select class="form-select" name="fk_pais_estado">
                <option selected value="">Selecciona una opción</option>
                @foreach ($datos_pais as $dp)
                    <option value="{{$dp->pk_pais}}">{{$dp->nom_pais}}</option>
                @endforeach
            </select>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeEstado" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormEstado() {
        var dialog = document.getElementById("formDialogEstado");
        dialog.showModal();
    }

    function closeFormEstado() {
        var dialog = document.getElementById("formDialogEstado");
        dialog.close();
    }

    function resetFormEstado() {
        var form = document.querySelector("#formEstado");
        form.reset();

        resetFormMunicipio();
    }

    function submitFormEstado(event) {
        event.preventDefault();

        var nom_estado = document.getElementById('nom_estado').value;

        if (nom_estado.trim() === '') {
            alert('El nombre del estado es requerido');
            return;
        }

        var form = document.getElementById('formEstado');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var estado = response.estado;
                        var mensaje = document.getElementById("mensajeEstado");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var selectMunicipio = document.querySelector('select[name="fk_estado_municipio"]');
                        var optionMunicipio = document.createElement("option");
                        optionMunicipio.value = response.estado.pk_estado;
                        optionMunicipio.textContent = estado.nom_estado;
                        selectMunicipio.appendChild(optionMunicipio);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormEstado();
                            resetFormEstado();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeEstado");
                        mensaje.textContent = "Hay un problema, verifica la información";
                        mensaje.style.color = "red";
                    }
                }
                mensaje.style.display = "block";
            }
        };
        xhr.send(formData);
        clearTimeout(mensajeTimeout);
    }

</script>

{{-- Municipio --}}
<dialog id="formDialogMunicipio">
    <form id="formMunicipio" onsubmit="return submitFormMunicipio(event)" action="{{route('agregarMunicipio')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar municipio</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormMunicipio()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_municipio" class="required">Nombre del municipio</label>
                <input type="text" name="nom_municipio" id="nom_municipio" required />
            </div>
            <div class="label-flex">
                <label>Estado</label>
                <a type="button" onclick="openFormEstado()" class="form-link">agregar</a>
            </div>
            <select class="form-select" name="fk_estado_municipio">
                <option selected value="">Selecciona una opción</option>
                @foreach ($datos_estado as $dp)
                    <option value="{{$dp->pk_estado}}">{{$dp->nom_estado}}</option>
                @endforeach
            </select>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeMunicipio" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormMunicipio() {
        var dialog = document.getElementById("formDialogMunicipio");
        dialog.showModal();
    }

    function closeFormMunicipio() {
        var dialog = document.getElementById("formDialogMunicipio");
        dialog.close();
    }

    function resetFormMunicipio() {
        var form = document.querySelector("#formMunicipio");
        form.reset();

        resetFormUbicacion();
    }

    function submitFormMunicipio(event) {
        event.preventDefault();

        var nom_municipio = document.getElementById('nom_municipio').value;

        if (nom_municipio.trim() === '') {
            alert('El nombre del municipio es requerido');
            return;
        }

        var form = document.getElementById('formMunicipio');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var municipio = response.municipio;
                        var mensaje = document.getElementById("mensajeMunicipio");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var selectUbicacion = document.querySelector('select[name="fk_municipio_ubicacion"]');
                        var optionUbicacion = document.createElement("option");
                        optionUbicacion.value = response.municipio.pk_municipio;
                        optionUbicacion.textContent = municipio.nom_municipio;
                        selectUbicacion.appendChild(optionUbicacion);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormMunicipio();
                            resetFormMunicipio();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeMunicipio");
                        mensaje.textContent = "Hay un problema, verifica la información";
                        mensaje.style.color = "red";
                    }
                }
                mensaje.style.display = "block";
            }
        };
        xhr.send(formData);
        clearTimeout(mensajeTimeout);
    }

</script>

{{-- Ubicacion --}}
<dialog id="formDialogUbicacion">
    <form id="formUbicacion" onsubmit="return submitFormUbicacion(event)" action="{{route('agregarUbicacion')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar ciudad/ubicación</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormUbicacion()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_ubicacion" class="required">Nombre de la ciudad/ubicación</label>
                <input type="text" name="nom_ubicacion" id="nom_ubicacion" required />
            </div>
            <div class="label-flex">
                <label>Municipio</label>
                <a type="button" onclick="openFormMunicipio()" class="form-link">agregar</a>
            </div>
            <select class="form-select" name="fk_municipio_ubicacion">
                <option selected value="">Selecciona una opción</option>
                @foreach ($datos_municipio as $dp)
                    <option value="{{$dp->pk_municipio}}">{{$dp->nom_municipio}}</option>
                @endforeach
            </select>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeUbicacion" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormUbicacion() {
        var dialog = document.getElementById("formDialogUbicacion");
        dialog.showModal();
    }

    function closeFormUbicacion() {
        var dialog = document.getElementById("formDialogUbicacion");
        dialog.close();
    }

    function resetFormUbicacion() {
        var form = document.querySelector("#formUbicacion");
        form.reset();

        resetFormUbicacion();
    }

    function submitFormUbicacion(event) {
        event.preventDefault();

        var nom_ubicacion = document.getElementById('nom_ubicacion').value;

        if (nom_ubicacion.trim() === '') {
            alert('El nombre de la ciudad/ubicación es requerido');
            return;
        }

        var form = document.getElementById('formUbicacion');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var ubicacion = response.ubicacion;
                        var mensaje = document.getElementById("mensajeUbicacion");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var selectSucursal = document.querySelector('select[name="fk_ubicacion_sucursal"]');
                        var optionSucursal = document.createElement("option");
                        optionSucursal.value = response.ubicacion.pk_ubicacion;
                        optionSucursal.textContent = ubicacion.nom_ubicacion;
                        selectSucursal.appendChild(optionSucursal);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormUbicacion();
                            resetFormUbicacion();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeUbicacion");
                        mensaje.textContent = "Hay un problema, verifica la información";
                        mensaje.style.color = "red";
                    }
                }
                mensaje.style.display = "block";
            }
        };
        xhr.send(formData);
        clearTimeout(mensajeTimeout);
    }

</script>

{{-- Sucursal --}}
<dialog id="formDialogSucursal">
    <form id="formSucursal" onsubmit="return submitFormSucursal(event)" action="{{route('agregarSucursal')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar sucursal</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormSucursal()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_sucursal" class="required">Nombre de la sucursal</label>
                <input type="text" name="nom_sucursal" id="nom_sucursal" required />
            </div>
            <div class="label-flex">
                <label>Ciudad/Ubicación</label>
                <a type="button" onclick="openFormUbicacion()" class="form-link">agregar</a>
            </div>
            <select class="form-select" name="fk_ubicacion_sucursal">
                <option selected value="">Selecciona una opción</option>
                @foreach ($datos_ubicacion as $dp)
                    <option value="{{$dp->pk_ubicacion}}">{{$dp->nom_ubicacion}}</option>
                @endforeach
            </select>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeSucursal" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormSucursal() {
        var dialog = document.getElementById("formDialogSucursal");
        dialog.showModal();
    }

    function closeFormSucursal() {
        var dialog = document.getElementById("formDialogSucursal");
        dialog.close();
    }

    function resetFormSucursal() {
        var form = document.querySelector("#formSucursal");
        form.reset();
    }

    function submitFormSucursal(event) {
        event.preventDefault();

        var nom_sucursal = document.getElementById('nom_sucursal').value;

        if (nom_sucursal.trim() === '') {
            alert('La sucursal es requerida');
            return;
        }

        var form = document.getElementById('formSucursal');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var sucursal = response.sucursal;
                        var mensaje = document.getElementById("mensajeSucursal");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_sucursal"]');
                        var option = document.createElement("option");
                        option.value = response.sucursal.pk_sucursal;
                        option.textContent = sucursal.nom_sucursal;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormSucursal();
                            resetFormSucursal();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeSucursal");
                        mensaje.textContent = "Hay un problema, verifica la información";
                        mensaje.style.color = "red";
                    }
                }
                mensaje.style.display = "block";
            }
        };
        xhr.send(formData);
        clearTimeout(mensajeTimeout);
    }

</script>

{{-- Sistema de riego --}}
<dialog id="formDialogSistemaRiego">
    <form id="formSistemaRiego" onsubmit="return submitFormSistemaRiego(event)" action="{{route('agregarSistemaRiego')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar sistema de riego</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormSistemaRiego()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_sistema" class="required">Tipo de sistema de riego</label>
                <input type="text" name="nom_sistema" id="nom_sistema" required />
            </div>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeSistemaRiego" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormSistemaRiego() {
        var dialog = document.getElementById("formDialogSistemaRiego");
        dialog.showModal();
    }

    function closeFormSistemaRiego() {
        var dialog = document.getElementById("formDialogSistemaRiego");
        dialog.close();
    }

    function resetFormSistemaRiego() {
        var form = document.querySelector("#formSistemaRiego");
        form.reset();
    }

    function submitFormSistemaRiego(event) {
        event.preventDefault();

        var nom_sistema = document.getElementById('nom_sistema').value;

        if (nom_sistema.trim() === '') {
            alert('El sistema de riego es requerido');
            return;
        }

        var form = document.getElementById('formSistemaRiego');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var sistema_riego = response.sistema_riego;
                        var mensaje = document.getElementById("mensajeSistemaRiego");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_sistema_riego"]');
                        var option = document.createElement("option");
                        option.value = response.sistema_riego.pk_sistema_riego;
                        option.textContent = sistema_riego.nom_sistema;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormSistemaRiego();
                            resetFormSistemaRiego();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeSistemaRiego");
                        mensaje.textContent = "Hay un problema, verifica la información";
                        mensaje.style.color = "red";
                    }
                }
                mensaje.style.display = "block";
            }
        };
        xhr.send(formData);
        clearTimeout(mensajeTimeout);
    }

</script>

{{-- Cultivo --}}
<dialog id="formDialogCultivo">
    <form id="formCultivo" onsubmit="return submitFormCultivo(event)" action="{{route('agregarCultivo')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar cultivo</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormCultivo()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_cultivo" class="required">Tipo de cultivo</label>
                <input type="text" name="nom_cultivo" id="nom_cultivo" required />
            </div>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeCultivo" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormCultivo() {
        var dialog = document.getElementById("formDialogCultivo");
        dialog.showModal();
    }

    function closeFormCultivo() {
        var dialog = document.getElementById("formDialogCultivo");
        dialog.close();
    }

    function resetFormCultivo() {
        var form = document.querySelector("#formCultivo");
        form.reset();
    }

    function submitFormCultivo(event) {
        event.preventDefault();

        var nom_cultivo = document.getElementById('nom_cultivo').value;

        if (nom_cultivo.trim() === '') {
            alert('El tipo de cultivo es requerido');
            return;
        }

        var form = document.getElementById('formCultivo');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var cultivo = response.cultivo;
                        var mensaje = document.getElementById("mensajeCultivo");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_cultivo"]');
                        var option = document.createElement("option");
                        option.value = response.cultivo.pk_cultivo;
                        option.textContent = cultivo.nom_cultivo;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormCultivo();
                            resetFormCultivo();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeCultivo");
                        mensaje.textContent = "Hay un problema, verifica la información";
                        mensaje.style.color = "red";
                    }
                }
                mensaje.style.display = "block";
            }
        };
        xhr.send(formData);
        clearTimeout(mensajeTimeout);
    }

</script>

{{-- Categoria de proyecto --}}
<dialog id="formDialogCategoriaProyecto">
    <form id="formCategoriaProyecto" onsubmit="return submitFormCategoriaProyecto(event)" action="{{route('agregarCategoriaProyecto')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar categoria de proyecto</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormCategoriaProyecto()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_cat_proy" class="required">Nombre de la categoria</label>
                <input type="text" name="nom_cat_proy" id="nom_cat_proy" required />
            </div>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeCategoriaProyecto" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormCategoriaProyecto() {
        var dialog = document.getElementById("formDialogCategoriaProyecto");
        dialog.showModal();
    }

    function closeFormCategoriaProyecto() {
        var dialog = document.getElementById("formDialogCategoriaProyecto");
        dialog.close();
    }

    function resetFormCategoriaProyecto() {
        var form = document.querySelector("#formCategoriaProyecto");
        form.reset();
    }

    function submitFormCategoriaProyecto(event) {
        event.preventDefault();

        var nom_cat_proy = document.getElementById('nom_cat_proy').value;

        if (nom_cat_proy.trim() === '') {
            alert('La categoria de proyecto es requerida');
            return;
        }

        var form = document.getElementById('formCategoriaProyecto');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var categoria_proyecto = response.categoria_proyecto;
                        var mensaje = document.getElementById("mensajeCategoriaProyecto");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_categoria_proyecto"]');
                        var option = document.createElement("option");
                        option.value = response.categoria_proyecto.pk_categoria_proyecto;
                        option.textContent = categoria_proyecto.nom_cat_proy;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormCategoriaProyecto();
                            resetFormCategoriaProyecto();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeCategoriaProyecto");
                        mensaje.textContent = "Hay un problema, verifica la información";
                        mensaje.style.color = "red";
                    }
                }
                mensaje.style.display = "block";
            }
        };
        xhr.send(formData);
        clearTimeout(mensajeTimeout);
    }

</script>

{{-- Etapa --}}
<dialog id="formDialogEtapa">
    <form id="formEtapa" onsubmit="return submitFormEtapa(event)" action="{{route('agregarEtapa')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar etapa</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormEtapa()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_etapa" class="required">Nombre de la etapa</label>
                <input type="text" name="nom_etapa" id="nom_etapa" required />
            </div>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeEtapa" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormEtapa() {
        var dialog = document.getElementById("formDialogEtapa");
        dialog.showModal();
    }

    function closeFormEtapa() {
        var dialog = document.getElementById("formDialogEtapa");
        dialog.close();
    }

    function resetFormEtapa() {
        var form = document.querySelector("#formEtapa");
        form.reset();
    }

    function submitFormEtapa(event) {
        event.preventDefault();

        var nom_etapa = document.getElementById('nom_etapa').value;

        if (nom_etapa.trim() === '') {
            alert('La Etapa es requerida');
            return;
        }

        var form = document.getElementById('formEtapa');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var etapa = response.etapa;
                        var mensaje = document.getElementById("mensajeEtapa");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_etapa"]');
                        var option = document.createElement("option");
                        option.value = response.etapa.pk_etapa;
                        option.textContent = etapa.nom_etapa;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormEtapa();
                            resetFormEtapa();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeEtapa");
                        mensaje.textContent = "Hay un problema, verifica la información";
                        mensaje.style.color = "red";
                    }
                }
                mensaje.style.display = "block";
            }
        };
        xhr.send(formData);
        clearTimeout(mensajeTimeout);
    }

</script>

</body>
</html>