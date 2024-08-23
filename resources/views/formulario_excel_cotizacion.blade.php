<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="img/sitehasa_isotipo.ico" rel="icon">
    <title>Agregar cotización</title>
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

        use App\Models\Cliente;
        $datos_cliente=Cliente::all();

        use App\Models\Sucursal;
        $datos_sucursal=Sucursal::all();

        use App\Models\Proyecto_general;
        $datos_proyecto_general=Proyecto_general::all();
    @endphp

<div class="main">
    <div class="container">
        <h2>Agregar cotización</h2>
        <div class="contenido">
            <div class="form1">
                <form action="{{route('importarCotizacion')}}" method="post" class="form2" id="form2" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-grupo">

                            <div class="form-campo">
                                <label for="nom_archivo" class="required">Nombre de la cotización</label>
                                <input type="text" name="nom_archivo" id="nom_archivo" required />
                            </div>

                            <div class="label-flex">
                                <label class="required">Cliente</label>
                                <a type="button" href="{{route('agregarClientes')}}" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_cliente" required>
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_cliente as $dp)
                                    @if ($dp->estatus === 'Activo')
                                        <option value="{{$dp->pk_cliente}}">
                                            {{$dp->razon_social.' '.$dp->datos_comunes->nombres.' '.$dp->datos_comunes->a_paterno.' '.$dp->datos_comunes->a_materno}}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                        </div>
                        <div class="form-grupo">

                            <div class="label-flex">
                                <label>Estado</label>
                                <a type="button" onclick="openFormEstado()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_estado">
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_estado as $dp)
                                    <option value="{{$dp->pk_estado}}">{{$dp->nom_estado}}</option>
                                @endforeach
                            </select>

                            <div class="label-flex">
                                <label>Ciudad/Ubicación</label>
                                <a type="button" onclick="openFormUbicacion()" class="form-link">agregar</a>
                            </div>
                            <select class="form-select" name="fk_ubicacion">
                                <option selected value="">Selecciona una opción</option>
                                @foreach ($datos_ubicacion as $dp)
                                    <option value="{{$dp->pk_ubicacion}}">{{$dp->nom_ubicacion}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-row">
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

                            <div class="form-campo">
                                <label for="area_regable" class="required">Área regable</label>
                                <input type="number" name="area_regable" id="area_regable" required />
                            </div>

                        </div>
                        <div class="form-grupo">
                            <div class="form-campo">
                                <label for="fecha_cotizacion">Fecha de cotización</label>
                                <input type="date" name="fecha_cotizacion" id="fecha_cotizacion" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                            </div>
                            <div class="form-campo">
                                <label for="vigencia_cotizacion" class="required">Vigencia de la cotización (Días)</label>
                                <input type="number" name="vigencia_cotizacion" id="vigencia_cotizacion" required />
                            </div>
                        </div>
                    </div>

                    <br><hr style="height: 2px"><br>
                    <div class="form-row">
                        <div class="form-grupo">
                            <div class="form-campo">
                                <label for="archivo_cotizacion" class="required">Archivo excel de cotización</label>
                                <input type="file" name="archivo_cotizacion" id="archivo_cotizacion" required />
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

                        var response = JSON.parse(xhr.responseText);
                        var selectPrincipal = document.querySelector('select[name="fk_estado"]');
                        var optionPrincipal = document.createElement("option");
                        optionPrincipal.value = response.estado.pk_estado;
                        optionPrincipal.textContent = estado.nom_estado;
                        selectPrincipal.appendChild(optionPrincipal);

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

                        var response = JSON.parse(xhr.responseText);
                        var selectPrincipal = document.querySelector('select[name="fk_ubicacion"]');
                        var optionPrincipal = document.createElement("option");
                        optionPrincipal.value = response.ubicacion.pk_ubicacion;
                        optionPrincipal.textContent = ubicacion.nom_ubicacion;
                        selectPrincipal.appendChild(optionPrincipal);

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

</body>
</html>