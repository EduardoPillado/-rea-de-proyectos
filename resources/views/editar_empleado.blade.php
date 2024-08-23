<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('img/sitehasa_isotipo.ico') }}" rel="icon">
    <title>Editor de empleado</title>
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

        use App\Models\Nacionalidad;
        $datos_nacionalidad=Nacionalidad::all();

        use App\Models\Puesto_empleado;
        $datos_puesto_empleado=Puesto_empleado::all();
    @endphp

    <div class="main">
        <div class="container">
            <h2>Editor de empleado</h2>
            <div class="contenido">
                <div class="form1">
                    <form action="{{route('empleado.update', $datos_empleado->pk_empleado)}}" method="post" class="form2" id="form2" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-row">

                            <div class="form-grupo">
                                <h5>Basicos</h5>
                                <div class="form-campo">
                                    <label for="nombres" class="required">Nombre</label>
                                    <input type="text" name="nombres" id="nombres" value="{{$datos_empleado->datos_comunes->nombres}}" required/>
                                </div>
                                <div class="form-campo">
                                    <label for="a_paterno" class="required">Apellido paterno</label>
                                    <input type="text" name="a_paterno" id="a_paterno" value="{{$datos_empleado->datos_comunes->a_paterno}}" required/>
                                </div>
                                <div class="form-campo">
                                    <label for="a_materno">Apellido materno</label>
                                    <input type="text" name="a_materno" id="a_materno" value="{{$datos_empleado->datos_comunes->a_materno}}"/>
                                </div>
                                <div class="form-campo">
                                    <label for="correo" class="required">Correo</label>
                                    <input type="text" name="correo" id="correo" value="{{$datos_empleado->datos_comunes->correo}}" required />
                                </div>
                                <div class="form-campo">
                                    <label for="telefono" class="required">Teléfono</label>
                                    <input type="text" name="telefono" id="telefono" value="{{$datos_empleado->datos_comunes->telefono}}" required />
                                </div>
                            </div>
                            <div class="form-grupo">
                                <h5>&nbsp</h5>
                                <div class="label-flex">
                                    <label class="required">País</label>
                                    <a type="button" onclick="openFormPais()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_pais" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_pais as $dp)
                                        <option @if ($dp->fk_pais == $datos_empleado->pk_pais) selected @endif value="{{$dp->pk_pais}}">{{$dp->nom_pais}}</option>
                                    @endforeach
                                </select>

                                <div class="label-flex">
                                    <label class="required">Estado</label>
                                    <a type="button" onclick="openFormEstado()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_estado" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_estado as $dp)
                                        <option @if ($dp->fk_estado == $datos_empleado->pk_estado) selected @endif value="{{$dp->pk_estado}}">{{$dp->nom_estado}}</option>
                                    @endforeach
                                </select>

                                <div class="label-flex">
                                    <label class="required">Municipio</label>
                                    <a type="button" onclick="openFormMunicipio()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_municipio" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_municipio as $dp)
                                        <option @if ($dp->fk_municipio == $datos_empleado->pk_municipio) selected @endif value="{{$dp->pk_municipio}}">{{$dp->nom_municipio}}</option>
                                    @endforeach
                                </select>

                                <div class="label-flex">
                                    <label class="required">Ciudad/Ubicación</label>
                                    <a type="button" onclick="openFormUbicacion()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_ubicacion" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_ubicacion as $dp)
                                        <option @if ($dp->fk_ubicacion == $datos_empleado->pk_ubicacion) selected @endif value="{{$dp->pk_ubicacion}}">{{$dp->nom_ubicacion}}</option>
                                    @endforeach
                                </select>

                                <div class="label-flex">
                                    <label class="required">Nacionalidad</label>
                                    <a type="button" onclick="openFormNacionalidad()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_nacionalidad" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_nacionalidad as $dp)
                                        <option @if ($dp->fk_nacionalidad == $datos_empleado->pk_nacionalidad) selected @endif value="{{$dp->pk_nacionalidad}}">{{$dp->nom_nacionalidad}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-grupo">
                                <h5>&nbsp</h5>
                                <div class="form-campo">
                                    <label for="calle" class="required">Calle</label>
                                    <input type="text" name="calle" id="calle" value="{{$datos_empleado->datos_comunes->direccion->calle}}" required />
                                </div>
                                <div class="form-campo">
                                    <label for="colonia" class="required">Colonia</label>
                                    <input type="text" name="colonia" id="colonia" value="{{$datos_empleado->datos_comunes->direccion->colonia}}" required />
                                </div>
                                <div class="form-campo">
                                    <label for="numero" class="required">Número</label>
                                    <input type="number" name="numero" id="numero" value="{{$datos_empleado->datos_comunes->direccion->numero}}" required />
                                </div>
                                <div class="form-campo">
                                    <label for="cp" class="required">Código postal</label>
                                    <input type="text" name="cp" id="cp" maxlength="5" value="{{$datos_empleado->datos_comunes->direccion->cp}}" required />
                                </div>
                                <div class="form-campo">
                                    <label for="curp" class="required">CURP</label>
                                    <input type="text" name="curp" id="curp" value="{{$datos_empleado->datos_comunes->curp}}" required />
                                </div>
                            </div>
                            
                        </div>
                        <hr style="height: 2px">
                        <div class="form-row">
                            <div class="form-grupo">
                                <div class="form-campo">
                                    <label for="curriculum">Currículum</label>
                                    <input type="file" name="curriculum" id="curriculum" />
                                </div>
                            </div>
                            <div class="form-grupo">
                                <div class="label-flex">
                                    <label class="required">Puesto de empleado</label>
                                    <a type="button" onclick="openFormPuestoEmpleado()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_puesto_empleado" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_puesto_empleado as $dp)
                                        <option @if ($dp->fk_puesto_empleado == $datos_empleado->pk_puesto_empleado) selected @endif value="{{$dp->pk_puesto_empleado}}">{{$dp->nom_puesto}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br><hr style="height: 2px"><br>
                        <div class="form-row">
                            <div class="form-grupo">
                                <div class="form-campo">
                                    <label for="fecha_ult_mod">Fecha de actualización: </label>
                                    <input type="date" name="fecha_ult_mod" id="fecha_ult_mod" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
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

                            var response = JSON.parse(xhr.responseText);
                            var selectPrincipal = document.querySelector('select[name="fk_pais"]');
                            var optionPrincipal = document.createElement("option");
                            optionPrincipal.value = response.pais.pk_pais;
                            optionPrincipal.textContent = pais.nom_pais;
                            selectPrincipal.appendChild(optionPrincipal);

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

                            var response = JSON.parse(xhr.responseText);
                            var selectPrincipal = document.querySelector('select[name="fk_municipio"]');
                            var optionPrincipal = document.createElement("option");
                            optionPrincipal.value = response.municipio.pk_municipio;
                            optionPrincipal.textContent = municipio.nom_municipio;
                            selectPrincipal.appendChild(optionPrincipal);

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
                            var select = document.querySelector('select[name="fk_ubicacion"]');
                            var option = document.createElement("option");
                            option.value = response.ubicacion.pk_ubicacion;
                            option.textContent = ubicacion.nom_ubicacion;
                            select.appendChild(option);

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

    {{-- Nacionalidad --}}
    <dialog id="formDialogNacionalidad">
        <form id="formNacionalidad" onsubmit="return submitFormNacionalidad(event)" action="{{route('agregarNacionalidad')}}" method="post">
            <div class="modal-header">
                <h2 class="title-dialog">Agregar nacionalidad</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormNacionalidad()"></button>
            </div>
            @csrf
            <div class="form-grupo">
                <div class="form-campo">
                    <label for="nom_nacionalidad" class="required">Define la nacionalidad</label>
                    <input type="text" name="nom_nacionalidad" id="nom_nacionalidad" required />
                </div>
                <div class="form-submit">
                    <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
                </div>
            </div>
            <div id="mensajeNacionalidad" style="display: none;"></div>
        </form>
    </dialog>

    <script>
        function openFormNacionalidad() {
            var dialog = document.getElementById("formDialogNacionalidad");
            dialog.showModal();
        }

        function closeFormNacionalidad() {
            var dialog = document.getElementById("formDialogNacionalidad");
            dialog.close();
        }

        function resetFormNacionalidad() {
            var form = document.querySelector("#formNacionalidad");
            form.reset();
        }
        
        function submitFormNacionalidad(event) {
            event.preventDefault();

            var nom_nacionalidad = document.getElementById('nom_nacionalidad').value;

            if (nom_nacionalidad.trim() === '') {
                alert('El tipo de nacionalidad es requerido');
                return;
            }

            var form = document.getElementById('formNacionalidad');
            var formData = new FormData(form);
            var mensajeTimeout;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var mensaje = document.getElementById("mensajeNacionalidad");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_nacionalidad"]');
                        var option = document.createElement("option");
                        option.value = response.nacionalidad.pk_nacionalidad;
                        option.textContent = nom_nacionalidad;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormNacionalidad();
                            resetFormNacionalidad();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeNacionalidad");
                        mensaje.textContent = "Hay un problema, verifica la información";
                        mensaje.style.color = "red";
                    }

                    mensaje.style.display = "block";
                    
                }
            };
            xhr.send(formData);
            clearTimeout(mensajeTimeout);
        }

    </script>

    {{-- Puesto de empleado --}}
    <dialog id="formDialogPuestoEmpleado">
        <form id="formPuestoEmpleado" onsubmit="return submitFormPuestoEmpleado(event)" action="{{route('agregarPuestoEmpleado')}}" method="post">
            <div class="modal-header">
                <h2 class="title-dialog">Agregar puesto de empleado</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormPuestoEmpleado()"></button>
            </div>
            @csrf
            <div class="form-grupo">
                <div class="form-campo">
                    <label for="nom_puesto" class="required">Nombre del puesto</label>
                    <input type="text" name="nom_puesto" id="nom_puesto" required />
                </div>
                <div class="form-submit">
                    <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
                </div>
            </div>
            <div id="mensajePuestoEmpleado" style="display: none;"></div>
        </form>
    </dialog>

    <script>
        function openFormPuestoEmpleado() {
            var dialog = document.getElementById("formDialogPuestoEmpleado");
            dialog.showModal();
        }

        function closeFormPuestoEmpleado() {
            var dialog = document.getElementById("formDialogPuestoEmpleado");
            dialog.close();
        }

        function resetFormPuestoEmpleado() {
            var form = document.querySelector("#formPuestoEmpleado");
            form.reset();
        }

        function submitFormPuestoEmpleado(event) {
            event.preventDefault();

            var nom_puesto = document.getElementById('nom_puesto').value;

            if (nom_puesto.trim() === '') {
                alert('El nombre del puesto es requerido');
                return;
            }

            var form = document.getElementById('formPuestoEmpleado');
            var formData = new FormData(form);
            var mensajeTimeout;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            var puesto_empleado = response.puesto_empleado;
                            var mensaje = document.getElementById("mensajePuestoEmpleado");
                            mensaje.textContent = "Guardado";
                            mensaje.style.color = "green";

                            var response = JSON.parse(xhr.responseText);
                            var select = document.querySelector('select[name="fk_puesto_empleado"]');
                            var option = document.createElement("option");
                            option.value = response.puesto_empleado.pk_puesto_empleado;
                            option.textContent = puesto_empleado.nom_puesto;
                            select.appendChild(option);

                            mensajeTimeout = setTimeout(function() {
                                mensaje.style.display = "none";
                            }, 2000);

                            setTimeout(function() {
                                closeFormPuestoEmpleado();
                                resetFormPuestoEmpleado();
                            }, 2000);
                        } else {
                            var mensaje = document.getElementById("mensajePuestoEmpleado");
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