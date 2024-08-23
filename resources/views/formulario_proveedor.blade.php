<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="img/sitehasa_isotipo.ico" rel="icon">
    <title>Registro de proveedor</title>
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

        use App\Models\Nacionalidad;
        $datos_nacionalidad=Nacionalidad::all();

        use App\Models\Credito;
        $datos_credito=Credito::all();

        use App\Models\Tipo_proveedor;
        $datos_tipo_proveedor=Tipo_proveedor::all();

        use App\Models\Tipo_operacion;
        $datos_tipo_operacion=Tipo_operacion::all();
    @endphp

    <div class="main">
        <div class="container">
            <h2>Registro de proveedor</h2>
            <div class="contenido">
                <div class="form1">
                    <form action="{{route('proveedor.insertar')}}" method="post" class="form2" id="form2" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">

                            <div class="form-grupo">
                                <h5>Basicos</h5>
                                <div class="form-campo">
                                    <label for="razon_social" class="required">Razón social</label>
                                    <input style="background-color: white" type="text" name="razon_social" id="razon_social" class="input-no-persona" />
                                    <div style="text-align: center">
                                        <a class="form-detalle" id="persona_fisica" title="Habilitar/deshabilitar persona física">
                                            <i id="icon" class="bi bi-person"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="form-campo">
                                    <label for="nombres" class="required">Nombre</label>
                                    <input style="background-color: rgb(205, 205, 205)" type="text" name="nombres" id="nombres" class="input-persona" placeholder="No disponible" disabled />
                                </div>
                                <div class="form-campo">
                                    <label for="a_paterno" class="required">Apellido paterno</label>
                                    <input style="background-color: rgb(205, 205, 205)" type="text" name="a_paterno" id="a_paterno" class="input-persona" placeholder="No disponible" disabled />
                                </div>
                                <div class="form-campo">
                                    <label for="a_materno">Apellido materno</label>
                                    <input style="background-color: rgb(205, 205, 205)" type="text" name="a_materno" id="a_materno" class="input-persona" placeholder="No disponible" disabled />
                                </div>
                                <div class="form-campo">
                                    <label for="correo">Correo</label>
                                    <input type="text" name="correo" id="correo" />
                                </div>
                                <div class="form-campo">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" name="telefono" id="telefono" />
                                </div>
                            </div>
                            <div class="form-grupo">
                                <h5>&nbsp</h5>
                                <div class="label-flex">
                                    <label>País</label>
                                    <a type="button" onclick="openFormPais()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_pais">
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_pais as $dp)
                                        <option value="{{$dp->pk_pais}}">{{$dp->nom_pais}}</option>
                                    @endforeach
                                </select>

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
                                    <label>Municipio</label>
                                    <a type="button" onclick="openFormMunicipio()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_municipio">
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_municipio as $dp)
                                        <option value="{{$dp->pk_municipio}}">{{$dp->nom_municipio}}</option>
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

                                <div class="label-flex">
                                    <label>Nacionalidad</label>
                                    <a type="button" onclick="openFormNacionalidad()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_nacionalidad">
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_nacionalidad as $dp)
                                        <option value="{{$dp->pk_nacionalidad}}">{{$dp->nom_nacionalidad}}</option>
                                    @endforeach
                                </select>

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

                            </div>
                            <div class="form-grupo">
                                <h5>&nbsp</h5>
                                <div class="form-campo">
                                    <label for="calle">Calle</label>
                                    <input type="text" name="calle" id="calle" />
                                </div>
                                <div class="form-campo">
                                    <label for="colonia">Colonia</label>
                                    <input type="text" name="colonia" id="colonia" />
                                </div>
                                <div class="form-campo">
                                    <label for="numero">Número</label>
                                    <input type="number" name="numero" id="numero" />
                                </div>
                                <div class="form-campo">
                                    <label for="cp" class="required">Código postal</label>
                                    <input type="text" name="cp" id="cp" maxlength="5" required />
                                </div>
                                <div class="form-campo">
                                    <label for="curp">CURP</label>
                                    <input type="text" name="curp" id="curp" />
                                </div>
                                <div class="form-campo">
                                    <label for="rfc" class="required">RFC</label>
                                    <input type="text" name="rfc" id="rfc" required />
                                </div>
                            </div>
                            
                        </div>
                        <hr style="height: 2px">
                        <div class="form-row">

                            <div class="form-grupo">
                                <h5>Contable</h5>
                                <div class="form-campo">
                                    <label for="cuenta_contable_mn">Cuenta contable MN</label>
                                    <input type="text" name="cuenta_contable_mn" id="cuenta_contable_mn" />
                                </div>
                                <div class="form-campo">
                                    <label for="cuenta_contable_dls">Cuenta contable Dls</label>
                                    <input type="text" name="cuenta_contable_dls" id="cuenta_contable_dls" />
                                </div>
                            </div>
                            <div class="form-grupo">
                                <h5>&nbsp</h5>
                                <div class="form-campo">
                                    <label for="cuenta_complementaria">Cuenta complementaria</label>
                                    <input type="text" name="cuenta_complementaria" id="cuenta_complementaria" />
                                </div>
                                <div class="form-campo">
                                    <label for="cuenta_afectable">Cuenta afectable</label>
                                    <input type="text" name="cuenta_afectable" id="cuenta_afectable" />
                                </div>
                            </div>
                        </div>
                        <hr style="height: 2px">
                        <div class="form-row">
                            <div class="form-grupo">
                                <h5>Crédito</h5>
                                <div class="form-campo">
                                    <label for="dias_credito" class="required">Días de crédito</label>
                                    <input type="number" name="dias_credito" id="dias_credito" required />
                                </div>
                                <div class="form-campo">
                                    <label for="tiempo_surtido" class="required">Tiempo de surtido</label>
                                    <input type="number" name="tiempo_surtido" id="tiempo_surtido" required />
                                </div>

                                <div class="label-flex">
                                    <label class="required">Tipo de proveedor</label>
                                    <a type="button" onclick="openFormTipoProveedor()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_tipo_proveedor" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_tipo_proveedor as $dp)
                                        <option value="{{$dp->pk_tipo_proveedor}}">{{$dp->nom_tipo_proveedor}}</option>
                                    @endforeach
                                </select>

                                <div class="label-flex">
                                    <label class="required">Tipo de operación</label>
                                    <a type="button" onclick="openFormTipoOperacion()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_tipo_operacion" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_tipo_operacion as $dp)
                                        <option value="{{$dp->pk_tipo_operacion}}">{{$dp->nom_tipo_operacion}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-grupo">
                                <h5>&nbsp</h5><br><br><br><br><br>
                                <div class="check-grupo label-flex">
                                    <div class="label-flex">
                                        <input class="form-check-input me-3" type="checkbox" name="extranjero" value="si" >
                                        <label for="extranjero">Extranjero</label>
                                    </div>
                                    <br><br><br>
                                    <div class="label-flex">
                                        <input class="form-check-input me-3" type="checkbox" name="multiafectable" value="si" >
                                        <label for="multiafectable">Multiafectable</label>
                                    </div>
                                    <br><br><br>
                                    <div class="label-flex">
                                        <input class="form-check-input me-3" type="checkbox" name="riego" value="si" >
                                        <label for="riego">Riego (Tipo de proveedor)</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <br><hr style="height: 2px"><br>
                        <div class="form-row">
                            <div class="form-grupo">
                                <div class="form-campo">
                                    <label for="fecha_alta">Fecha de registro: </label>
                                    <input type="date" name="fecha_alta" id="fecha_alta" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
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
    $(document).ready(function() {
        $('#persona_fisica').click(function() {
            $('.input-persona').each(function() {
                $(this).prop('disabled', !$(this).prop('disabled'));
                $(this).toggleClass('persona-activa');
            });
            $(this).toggleClass('activado');

            if ($(this).hasClass('activado')) {
                $('#icon').removeClass('bi bi-person').addClass('bi bi-person-fill')
                $('#nombres').attr('placeholder', '');
                $('#a_paterno').attr('placeholder', '');
                $('#a_materno').attr('placeholder', '');
            } else {
                $('#icon').removeClass('bi bi-person-fill').addClass('bi bi-person');
                $('#nombres').attr('placeholder', 'No disponible');
                $('#a_paterno').attr('placeholder', 'No disponible');
                $('#a_materno').attr('placeholder', 'No disponible');
            }

            $('.input-no-persona').each(function() {
                $('#razon_social').prop('disabled', !$('#razon_social').prop('disabled'));
                $('#razon_social').toggleClass('persona-inactiva');
            });
            $('#razon_social').toggleClass('desactivado');

            if ($('#razon_social').hasClass('desactivado')) {
                $('#razon_social').attr('placeholder', 'No disponible');
            } else {
                $('#razon_social').attr('placeholder', '');
            }
        });
    });
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

    {{-- Tipo de proveedor --}}
    <dialog id="formDialogTipoProveedor">
        <form id="formTipoProveedor" onsubmit="return submitFormTipoProveedor(event)" action="{{route('agregarTipoProveedor')}}" method="post">
            <div class="modal-header">
                <h2 class="title-dialog">Agregar tipo de proveedor</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormTipoProveedor()"></button>
            </div>
            @csrf
            <div class="form-grupo">
                <div class="form-campo">
                    <label for="nom_tipo_proveedor" class="required">Nombre del tipo</label>
                    <input type="text" name="nom_tipo_proveedor" id="nom_tipo_proveedor" required />
                </div>
                <div class="form-submit">
                    <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
                </div>
            </div>
            <div id="mensajeTipoProveedor" style="display: none;"></div>
        </form>
    </dialog>

    <script>
        function openFormTipoProveedor() {
            var dialog = document.getElementById("formDialogTipoProveedor");
            dialog.showModal();
        }

        function closeFormTipoProveedor() {
            var dialog = document.getElementById("formDialogTipoProveedor");
            dialog.close();
        }

        function resetFormTipoProveedor() {
            var form = document.querySelector("#formTipoProveedor");
            form.reset();
        }

        function submitFormTipoProveedor(event) {
            event.preventDefault();

            var nom_tipo_proveedor = document.getElementById('nom_tipo_proveedor').value;

            if (nom_tipo_proveedor.trim() === '') {
                alert('El tipo de proveedor es requerido');
                return;
            }

            var form = document.getElementById('formTipoProveedor');
            var formData = new FormData(form);
            var mensajeTimeout;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            var tipo_proveedor = response.tipo_proveedor;
                            var mensaje = document.getElementById("mensajeTipoProveedor");
                            mensaje.textContent = "Guardado";
                            mensaje.style.color = "green";

                            var response = JSON.parse(xhr.responseText);
                            var select = document.querySelector('select[name="fk_tipo_proveedor"]');
                            var option = document.createElement("option");
                            option.value = response.tipo_proveedor.pk_tipo_proveedor;
                            option.textContent = tipo_proveedor.nom_tipo_proveedor;
                            select.appendChild(option);

                            mensajeTimeout = setTimeout(function() {
                                mensaje.style.display = "none";
                            }, 2000);

                            setTimeout(function() {
                                closeFormTipoProveedor();
                                resetFormTipoProveedor();
                            }, 2000);
                        } else {
                            var mensaje = document.getElementById("mensajeTipoProveedor");
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

    {{-- Tipo de operación --}}
    <dialog id="formDialogTipoOperacion">
        <form id="formTipoOperacion" onsubmit="return submitFormTipoOperacion(event)" action="{{route('agregarTipoOperacion')}}" method="post">
            <div class="modal-header">
                <h2 class="title-dialog">Agregar tipo de operación</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormTipoOperacion()"></button>
            </div>
            @csrf
            <div class="form-grupo">
                <div class="form-campo">
                    <label for="nom_tipo_operacion" class="required">Nombre del tipo</label>
                    <input type="text" name="nom_tipo_operacion" id="nom_tipo_operacion" required />
                </div>
                <div class="form-submit">
                    <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
                </div>
            </div>
            <div id="mensajeTipoOperacion" style="display: none;"></div>
        </form>
    </dialog>

    <script>
        function openFormTipoOperacion() {
            var dialog = document.getElementById("formDialogTipoOperacion");
            dialog.showModal();
        }

        function closeFormTipoOperacion() {
            var dialog = document.getElementById("formDialogTipoOperacion");
            dialog.close();
        }

        function resetFormTipoOperacion() {
            var form = document.querySelector("#formTipoOperacion");
            form.reset();
        }

        function submitFormTipoOperacion(event) {
            event.preventDefault();

            var nom_tipo_operacion = document.getElementById('nom_tipo_operacion').value;

            if (nom_tipo_operacion.trim() === '') {
                alert('El tipo de operación es requerido');
                return;
            }

            var form = document.getElementById('formTipoOperacion');
            var formData = new FormData(form);
            var mensajeTimeout;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            var tipo_operacion = response.tipo_operacion;
                            var mensaje = document.getElementById("mensajeTipoOperacion");
                            mensaje.textContent = "Guardado";
                            mensaje.style.color = "green";

                            var response = JSON.parse(xhr.responseText);
                            var select = document.querySelector('select[name="fk_tipo_operacion"]');
                            var option = document.createElement("option");
                            option.value = response.tipo_operacion.pk_tipo_operacion;
                            option.textContent = tipo_operacion.nom_tipo_operacion;
                            select.appendChild(option);

                            mensajeTimeout = setTimeout(function() {
                                mensaje.style.display = "none";
                            }, 2000);

                            setTimeout(function() {
                                closeFormTipoOperacion();
                                resetFormTipoOperacion();
                            }, 2000);
                        } else {
                            var mensaje = document.getElementById("mensajeTipoOperacion");
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