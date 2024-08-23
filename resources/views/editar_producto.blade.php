<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/sitehasa_isotipo.ico') }}" rel="icon">
    <title>Editor producto</title>
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

        use App\Models\Area_sucursal;
        $datos_area_sucursal=Area_sucursal::all();
        
        use App\Models\Division;
        $datos_division=Division::all();

        use App\Models\Grupo_producto;
        $datos_grupo_producto=Grupo_producto::all();

        use App\Models\Subgrupo_producto;
        $datos_subgrupo_producto=Subgrupo_producto::all();

        use App\Models\Unidad_medida;
        $datos_unidad_medida=Unidad_medida::all();

        use App\Models\Clave_prod_serv_sat;
        $datos_clave_prod_serv_sat=Clave_prod_serv_sat::all();

        use App\Models\Proveedor;
        $datos_proveedor=Proveedor::all();

        use App\Models\Moneda;
        $datos_moneda=Moneda::all();

        use App\Models\Tasa;
        $datos_tasa=Tasa::all();

        use App\Models\Iva;
        $datos_iva=Iva::all();
    @endphp

<div class="main">
    <div class="container">
        <h2>Editor de producto</h2>
        <div class="contenido">
            <div class="form1">
                <form action="{{route('producto.update', $datos_producto->pk_producto)}}" method="post" class="form2" id="form2" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-row">
                        <div class="form-grupo">
                            <h5>Basicos</h5>
                            <div class="form-campo">
                                <label for="nom_producto" class="required">Nombre del producto</label>
                                <input type="text" name="nom_producto" id="nom_producto" value="{{$datos_producto->nom_producto}}" required />
                            </div>
                            <div class="form-campo">
                                <label for="descrip">Descripción</label>
                                <textarea name="descrip" id="descrip" rows="6">{{$datos_producto->descrip}}</textarea>
                            </div>
                        </div>
                        <div class="form-grupo">
                            <h5>&nbsp</h5>
                            <div class="form-campo">
                                <label for="imagen_producto">Imagen del producto</label>
                                <input type="file" name="imagen_producto" id="imagen_producto" />
                            </div>

                            <div class="label-flex">
                                <label class="required">Sucursal</label>
                                <a type="button" onclick="openFormSucursal()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_sucursal" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_sucursal as $dp)
                                    <option @if ($dp->fk_sucursal == $datos_producto->pk_sucursal) selected @endif value="{{$dp->pk_sucursal}}">{{$dp->nom_sucursal}}</option>
                                @endforeach
                            </select>

                            <div class="label-flex">
                                <label class="required">Área de la sucursal</label>
                                <a type="button" onclick="openFormAreaSucursal()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_area_sucursal" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_area_sucursal as $dp)
                                    <option @if ($dp->fk_area_sucursal == $datos_producto->pk_area_sucursal) selected @endif value="{{$dp->pk_area_sucursal}}">{{$dp->nom_area}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr style="height: 2px">
                    <div class="form-row">
                        <div class="form-grupo">
                            <h5>Datos generales</h5>

                            <div class="label-flex">
                                <label class="required">Division</label>
                                <a type="button" onclick="openFormDivision()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_division" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_division as $dp)
                                    <option @if ($dp->fk_division == $datos_producto->pk_division) selected @endif value="{{$dp->pk_division}}">{{$dp->nom_division}}</option>
                                @endforeach
                            </select>

                            <div class="label-flex">
                                <label class="required">Grupo</label>
                                <a type="button" onclick="openFormGrupoProducto()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_grupo_producto" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_grupo_producto as $dp)
                                    <option @if ($dp->fk_grupo_producto == $datos_producto->pk_grupo_producto) selected @endif value="{{$dp->pk_grupo_producto}}">{{$dp->nom_grupo}}</option>
                                @endforeach
                            </select>

                            <div class="label-flex">
                                <label class="required">Subgrupo</label>
                                <a type="button" onclick="openFormSubgrupoProducto()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_subgrupo_producto" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_subgrupo_producto as $dp)
                                    <option @if ($dp->fk_subgrupo_producto == $datos_producto->pk_subgrupo_producto) selected @endif value="{{$dp->pk_subgrupo_producto}}">{{$dp->nom_subgrupo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-grupo">
                            <h5>&nbsp</h5>

                            <div class="label-flex">
                                <label class="required">Unidad de medida</label>
                                <a type="button" onclick="openFormUnidadMedida()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_unidad_medida" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_unidad_medida as $dp)
                                    <option @if ($dp->fk_unidad_medida == $datos_producto->pk_unidad_medida) selected @endif value="{{$dp->pk_unidad_medida}}">{{$dp->tipo_unidad}}</option>
                                @endforeach
                            </select>

                            <div class="label-flex">
                                <label class="required">Clave producto o servicio SAT</label>
                                <a type="button" onclick="openFormClaveProdServSat()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_clave_prod_serv_sat" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_clave_prod_serv_sat as $dp)
                                    <option @if ($dp->fk_clave_prod_serv_sat == $datos_producto->pk_clave_prod_serv_sat) selected @endif value="{{$dp->pk_clave_prod_serv_sat}}">{{$dp->clave_serv}}</option>
                                @endforeach
                            </select>

                            <div class="label-flex">
                                <label>Proveedor</label>
                                <a type="button" href="{{route('agregarProveedores')}}" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_proveedor">
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_proveedor as $dp)
                                    @if ($dp->estatus === 'Activo')
                                        <option @if ($dp->fk_proveedor == $datos_producto->pk_proveedor) selected @endif value="{{$dp->pk_proveedor}}">
                                            {{$dp->razon_social.' '.$dp->datos_comunes->nombres.' '.$dp->datos_comunes->a_paterno.' '.$dp->datos_comunes->a_materno}}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <hr style="height: 2px">
                    <div class="form-row">
                        <div class="form-grupo">
                            <h5>Costos y precios</h5>
                            <div class="form-campo">
                                <label for="cantidad_unitaria" class="required">Precio</label>
                                <input type="number" name="cantidad_unitaria" id="cantidad_unitaria" value="{{$datos_producto->cantidad_unitaria}}" required />
                            </div>
                            <div class="form-campo">
                                <label for="cantidad_proyecto">Precio proyecto</label>
                                <input type="number" name="cantidad_proyecto" id="cantidad_proyecto" value="{{$datos_producto->cantidad_proyecto}}" />
                            </div>
                            <div class="form-campo">
                                <label for="ultima_cantidad">Ultimo costo</label>
                                <input type="number" name="ultima_cantidad" id="ultima_cantidad" value="{{$datos_producto->ultima_cantidad}}" />
                            </div>
                        </div>
                        <div class="form-grupo">
                            <h5>&nbsp</h5>

                            <div class="label-flex">
                                <label class="required">Moneda</label>
                                <a type="button" onclick="openFormMoneda()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="moneda" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_moneda as $dp)
                                    <option @if ($dp->fk_moneda == $datos_producto->pk_moneda) selected @endif value="{{$dp->pk_moneda}}">{{$dp->nom_moneda}}</option>
                                @endforeach
                            </select>

                            <div class="form-campo">
                                <label for="cantidad_especial">Precio especial</label>
                                <input type="number" name="cantidad_especial" id="cantidad_especial" value="{{$datos_producto->cantidad_especial}}" />
                            </div>
                            <div class="form-campo">
                                <label for="margen_utilidad_porcentaje">Margen utilidad %</label>
                                <input type="number" name="margen_utilidad_porcentaje" id="margen_utilidad_porcentaje" placeholder="Sin simbolo %" value="{{$datos_producto->margen_utilidad_porcentaje}}" />
                            </div>
                        </div>
                        <div class="form-grupo">
                            <h5>&nbsp</h5>
                            
                            <div class="label-flex">
                                <label for="tasa" class="required">Tasa de cambio</label>
                                <a 
                                type="button" 
                                href="https://www.google.com/finance/quote/USD-MXN?sa=X&ved=2ahUKEwi079CS6JiAAxXQLEQIHVypAEAQmY0JegQIBhAc" 
                                target="_blank"
                                class="form-link"
                                >
                                    (Dls-MN)
                                </a>
                                <a 
                                type="button" 
                                href="https://www.google.com/finance/quote/MXN-USD?sa=X&ved=2ahUKEwjjgKHY8piAAxWZIkQIHeGSC1YQmY0JegQIBhAc" 
                                target="_blank"
                                class="form-link"
                                >
                                    (MN-Dls)
                                </a>
                                <a type="button" onclick="openFormTasa()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="tasa" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_tasa as $dp)
                                    <option @if ($dp->fk_tasa == $datos_producto->pk_tasa) selected @endif value="{{ $dp->pk_tasa }}">{{ $dp->cant_tasa }} - {{ $dp->tipo_cambio }}</option>
                                @endforeach
                            </select>

                            <div class="form-campo">
                                <label for="cantidad_promedio">Costo promedio</label>
                                <input type="decimal" name="cantidad_promedio" id="cantidad_promedio" value="{{$datos_producto->cantidad_promedio}}" />
                            </div>

                            <div class="label-flex">
                                <label>IVA</label>
                                <a type="button" onclick="openFormIva()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_iva">
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_iva as $dp)
                                    <option @if ($dp->fk_iva == $datos_producto->pk_iva) selected @endif value="{{$dp->pk_iva}}">{{$dp->cant_iva}}%</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <hr style="height: 2px">
                    <div class="form-row">
                        <div class="form-grupo">
                            <div class="form-campo">
                                <label for="existencias">Cantidad en existencia</label>
                                <input type="number" name="existencias" id="existencias" value="{{$datos_producto->existencias}}" />
                            </div>
                            <br>
                            <div class="form-campo">
                                <label for="fecha_ultima_mod">Fecha de modificación: </label>
                                <input type="date" name="fecha_ultima_mod" id="fecha_ultima_mod" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
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

{{-- Area de la sucursal --}}
<dialog id="formDialogAreaSucursal">
    <form id="formAreaSucursal" onsubmit="return submitFormAreaSucursal(event)" action="{{route('agregarAreaSucursal')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar area de sucursal</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormAreaSucursal()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_area" class="required">Nombre del area</label>
                <input type="text" name="nom_area" id="nom_area" required />
            </div>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeAreaSucursal" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormAreaSucursal() {
        var dialog = document.getElementById("formDialogAreaSucursal");
        dialog.showModal();
    }

    function closeFormAreaSucursal() {
        var dialog = document.getElementById("formDialogAreaSucursal");
        dialog.close();
    }

    function resetFormAreaSucursal() {
        var form = document.querySelector("#formAreaSucursal");
        form.reset();
    }

    function submitFormAreaSucursal(event) {
        event.preventDefault();

        var nom_area = document.getElementById('nom_area').value;

        if (nom_area.trim() === '') {
            alert('El area de sucursal es requerida');
            return;
        }

        var form = document.getElementById('formAreaSucursal');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var area_sucursal = response.area_sucursal;
                        var mensaje = document.getElementById("mensajeAreaSucursal");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_area_sucursal"]');
                        var option = document.createElement("option");
                        option.value = response.area_sucursal.pk_area_sucursal;
                        option.textContent = area_sucursal.nom_area;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormAreaSucursal();
                            resetFormAreaSucursal();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeAreaSucursal");
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

{{-- Division --}}
<dialog id="formDialogDivision">
    <form id="formDivision" onsubmit="return submitFormDivision(event)" action="{{route('agregarDivision')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar división</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormDivision()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_division" class="required">Nombre de la división</label>
                <input type="text" name="nom_division" id="nom_division" required />
            </div>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeDivision" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormDivision() {
        var dialog = document.getElementById("formDialogDivision");
        dialog.showModal();
    }

    function closeFormDivision() {
        var dialog = document.getElementById("formDialogDivision");
        dialog.close();
    }

    function resetFormDivision() {
        var form = document.querySelector("#formDivision");
        form.reset();
    }

    function submitFormDivision(event) {
        event.preventDefault();

        var nom_division = document.getElementById('nom_division').value;

        if (nom_division.trim() === '') {
            alert('El nombre de la división es requerida');
            return;
        }

        var form = document.getElementById('formDivision');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var division = response.division;
                        var mensaje = document.getElementById("mensajeDivision");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_division"]');
                        var option = document.createElement("option");
                        option.value = response.division.pk_division;
                        option.textContent = division.nom_division;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormDivision();
                            resetFormDivision();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeDivision");
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

{{-- Grupo de producto --}}
<dialog id="formDialogGrupoProducto">
    <form id="formGrupoProducto" onsubmit="return submitFormGrupoProducto(event)" action="{{route('agregarGrupoProducto')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar grupo de producto</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormGrupoProducto()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_grupo" class="required">Nombre del grupo</label>
                <input type="text" name="nom_grupo" id="nom_grupo" required />
            </div>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeGrupoProducto" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormGrupoProducto() {
        var dialog = document.getElementById("formDialogGrupoProducto");
        dialog.showModal();
    }

    function closeFormGrupoProducto() {
        var dialog = document.getElementById("formDialogGrupoProducto");
        dialog.close();
    }

    function resetFormGrupoProducto() {
        var form = document.querySelector("#formGrupoProducto");
        form.reset();
    }

    function submitFormGrupoProducto(event) {
        event.preventDefault();

        var nom_grupo = document.getElementById('nom_grupo').value;

        if (nom_grupo.trim() === '') {
            alert('El nombre de la división es requerida');
            return;
        }

        var form = document.getElementById('formGrupoProducto');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var grupo_producto = response.grupo_producto;
                        var mensaje = document.getElementById("mensajeGrupoProducto");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var selectPrincipal = document.querySelector('select[name="fk_grupo_producto"]');
                        var optionPrincipal = document.createElement("option");
                        optionPrincipal.value = response.grupo_producto.pk_grupo_producto;
                        optionPrincipal.textContent = grupo_producto.nom_grupo;
                        selectPrincipal.appendChild(optionPrincipal);

                        var selectGrupoProducto = document.querySelector('select[name="fk_grupo_producto_subgrupo"]');
                        var optionGrupoProducto = document.createElement("option");
                        optionGrupoProducto.value = response.grupo_producto.pk_grupo_producto;
                        optionGrupoProducto.textContent = grupo_producto.nom_grupo;
                        selectGrupoProducto.appendChild(optionGrupoProducto);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormGrupoProducto();
                            resetFormGrupoProducto();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeGrupoProducto");
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

{{-- Subgrupo de producto --}}
<dialog id="formDialogSubgrupoProducto">
    <form id="formSubgrupoProducto" onsubmit="return submitFormSubgrupoProducto(event)" action="{{route('agregarSubgrupoProducto')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar subgrupo de producto</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormSubgrupoProducto()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_subgrupo" class="required">Nombre del subgrupo</label>
                <input type="text" name="nom_subgrupo" id="nom_subgrupo" required />
            </div>
            <div class="label-flex">
                <label>Grupo de producto</label>
                <a type="button" onclick="openFormGrupoProducto()" class="form-link">agregar</a>
            </div>
            <select class="form-select" name="fk_grupo_producto_subgrupo">
                <option selected value="">Selecciona una opción</option>
                @foreach ($datos_grupo_producto as $dp)
                    <option value="{{$dp->pk_grupo_producto}}">{{$dp->nom_grupo}}</option>
                @endforeach
            </select>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeSubgrupoProducto" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormSubgrupoProducto() {
        var dialog = document.getElementById("formDialogSubgrupoProducto");
        dialog.showModal();
    }

    function closeFormSubgrupoProducto() {
        var dialog = document.getElementById("formDialogSubgrupoProducto");
        dialog.close();
    }

    function resetFormSubgrupoProducto() {
        var form = document.querySelector("#formSubgrupoProducto");
        form.reset();
    }

    function submitFormSubgrupoProducto(event) {
        event.preventDefault();

        var nom_subgrupo = document.getElementById('nom_subgrupo').value;

        if (nom_subgrupo.trim() === '') {
            alert('El subgrupo es requerido');
            return;
        }

        var form = document.getElementById('formSubgrupoProducto');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var subgrupo_producto = response.subgrupo_producto;
                        var mensaje = document.getElementById("mensajeSubgrupoProducto");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_subgrupo_producto"]');
                        var option = document.createElement("option");
                        option.value = response.subgrupo_producto.pk_subgrupo_producto;
                        option.textContent = subgrupo_producto.nom_subgrupo;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormSubgrupoProducto();
                            resetFormSubgrupoProducto();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeSubgrupoProducto");
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

{{-- Unidad de medida --}}
<dialog id="formDialogUnidadMedida">
    <form id="formUnidadMedida" onsubmit="return submitFormUnidadMedida(event)" action="{{route('agregarUnidadMedida')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar unidad de medida</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormUnidadMedida()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="tipo_unidad" class="required">Tipo de unidad de medida</label>
                <input type="text" name="tipo_unidad" id="tipo_unidad" required />
            </div>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeUnidadMedida" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormUnidadMedida() {
        var dialog = document.getElementById("formDialogUnidadMedida");
        dialog.showModal();
    }

    function closeFormUnidadMedida() {
        var dialog = document.getElementById("formDialogUnidadMedida");
        dialog.close();
    }

    function resetFormUnidadMedida() {
        var form = document.querySelector("#formUnidadMedida");
        form.reset();
    }

    function submitFormUnidadMedida(event) {
        event.preventDefault();

        var tipo_unidad = document.getElementById('tipo_unidad').value;

        if (tipo_unidad.trim() === '') {
            alert('El tipo de unidad es requerida');
            return;
        }

        var form = document.getElementById('formUnidadMedida');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var unidad_medida = response.unidad_medida;
                        var mensaje = document.getElementById("mensajeUnidadMedida");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_unidad_medida"]');
                        var option = document.createElement("option");
                        option.value = response.unidad_medida.pk_unidad_medida;
                        option.textContent = unidad_medida.tipo_unidad;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormUnidadMedida();
                            resetFormUnidadMedida();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeUnidadMedida");
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

{{-- Clave producto o servicio SAT --}}
<dialog id="formDialogClaveProdServSat">
    <form id="formClaveProdServSat" onsubmit="return submitFormClaveProdServSat(event)" action="{{route('agregarClaveProdServSat')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar clave de producto o servicio SAT</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormClaveProdServSat()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="clave_serv" class="required">Clave o servicio</label>
                <input type="text" name="clave_serv" id="clave_serv" required />
            </div>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeClaveProdServSat" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormClaveProdServSat() {
        var dialog = document.getElementById("formDialogClaveProdServSat");
        dialog.showModal();
    }

    function closeFormClaveProdServSat() {
        var dialog = document.getElementById("formDialogClaveProdServSat");
        dialog.close();
    }

    function resetFormClaveProdServSat() {
        var form = document.querySelector("#formClaveProdServSat");
        form.reset();
    }

    function submitFormClaveProdServSat(event) {
        event.preventDefault();

        var clave_serv = document.getElementById('clave_serv').value;

        if (clave_serv.trim() === '') {
            alert('La clave o servicio es requerido');
            return;
        }

        var form = document.getElementById('formClaveProdServSat');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var clave_prod_serv_sat = response.clave_prod_serv_sat;
                        var mensaje = document.getElementById("mensajeClaveProdServSat");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_clave_prod_serv_sat"]');
                        var option = document.createElement("option");
                        option.value = response.clave_prod_serv_sat.pk_clave_prod_serv_sat;
                        option.textContent = clave_prod_serv_sat.clave_serv;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormClaveProdServSat();
                            resetFormClaveProdServSat();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeClaveProdServSat");
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

{{-- Moneda --}}
<dialog id="formDialogMoneda">
    <form id="formMoneda" onsubmit="return submitFormMoneda(event)" action="{{route('agregarMoneda')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar moneda</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormMoneda()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_moneda" class="required">Tipo de moneda</label>
                <input type="text" name="nom_moneda" id="nom_moneda" required />
            </div>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeMoneda" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormMoneda() {
        var dialog = document.getElementById("formDialogMoneda");
        dialog.showModal();
    }

    function closeFormMoneda() {
        var dialog = document.getElementById("formDialogMoneda");
        dialog.close();
    }

    function resetFormMoneda() {
        var form = document.querySelector("#formMoneda");
        form.reset();
    }

    function submitFormMoneda(event) {
        event.preventDefault();

        var nom_moneda = document.getElementById('nom_moneda').value;

        if (nom_moneda.trim() === '') {
            alert('El tipo de moneda es requerido');
            return;
        }

        var form = document.getElementById('formMoneda');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var moneda = response.moneda;
                        var mensaje = document.getElementById("mensajeMoneda");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="moneda"]');
                        var option = document.createElement("option");
                        option.value = response.moneda.pk_moneda;
                        option.textContent = moneda.nom_moneda;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormMoneda();
                            resetFormMoneda();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeMoneda");
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

{{-- Tasa --}}
<dialog id="formDialogTasa">
    <form id="formTasa" onsubmit="return submitFormTasa(event)" action="{{route('agregarTasa')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar tasa de cambio</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormTasa()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="cant_tasa" class="required">Cantidad tasa de cambio</label>
                <input type="decimal" name="cant_tasa" id="cant_tasa" required />
            </div>
            <div class="form-campo">
                <label for="tipo_cambio">Cambio de que tipo de monedas</label>
                <input type="text" name="tipo_cambio" id="tipo_cambio" />
            </div>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeTasa" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormTasa() {
        var dialog = document.getElementById("formDialogTasa");
        dialog.showModal();
    }

    function closeFormTasa() {
        var dialog = document.getElementById("formDialogTasa");
        dialog.close();
    }

    function resetFormTasa() {
        var form = document.querySelector("#formTasa");
        form.reset();
    }

    function submitFormTasa(event) {
        event.preventDefault();

        var cant_tasa = document.getElementById('cant_tasa').value;

        if (cant_tasa.trim() === '') {
            alert('La cantidad de tasa es requerida');
            return;
        }

        var form = document.getElementById('formTasa');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var tasa = response.tasa;
                        var mensaje = document.getElementById("mensajeTasa");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="tasa"]');
                        var option = document.createElement("option");
                        option.value = response.tasa.pk_tasa;
                        option.textContent = tasa.cant_tasa;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormTasa();
                            resetFormTasa();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeTasa");
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

{{-- IVA --}}
<dialog id="formDialogIva">
    <form id="formIva" onsubmit="return submitFormIva(event)" action="{{route('agregarIva')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar IVA</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormIva()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="cant_iva" class="required">Cantidad de IVA</label>
                <input type="decimal" name="cant_iva" id="cant_iva" placeholder="Sin simbolo %" required />
            </div>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeIva" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormIva() {
        var dialog = document.getElementById("formDialogIva");
        dialog.showModal();
    }

    function closeFormIva() {
        var dialog = document.getElementById("formDialogIva");
        dialog.close();
    }

    function resetFormIva() {
        var form = document.querySelector("#formIva");
        form.reset();
    }

    function submitFormIva(event) {
        event.preventDefault();

        var cant_iva = document.getElementById('cant_iva').value;

        if (cant_iva.trim() === '') {
            alert('El IVA es requerido');
            return;
        }

        var form = document.getElementById('formIva');
        var formData = new FormData(form);
        var mensajeTimeout;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var iva = response.iva;
                        var mensaje = document.getElementById("mensajeIva");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_iva"]');
                        var option = document.createElement("option");
                        option.value = response.iva.pk_iva;
                        option.textContent = iva.cant_iva;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormIva();
                            resetFormIva();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeIva");
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