<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="img/sitehasa_isotipo.ico" rel="icon">
    <title>Registro de cliente</title>
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

        use App\Models\Regimen_fiscal;
        $datos_reg_fisc=Regimen_fiscal::all();

        use App\Models\Uso_cfdi;
        $datos_uso_cfdi=Uso_cfdi::all();
        
        use App\Models\Agente;
        $datos_agente=Agente::all();

        use App\Models\Grupo_cliente;
        $datos_grp_cli=Grupo_cliente::all();
    @endphp

    <div class="main">
        <div class="container">
            <h2>Registro de cliente</h2>
            <div class="contenido">
                <div class="form1">
                    <form action="{{route('cliente.insertar')}}" method="post" class="form2" id="form2" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">

                            <div class="form-grupo">
                                <h5>Basicos</h5>
                                <div class="form-campo">
                                    <label for="razon_social" class="required">Razón social</label>
                                    <input type="text" name="razon_social" id="razon_social" class="input-no-persona" />
                                    <div style="text-align: center">
                                        <a class="form-detalle" id="persona_fisica" title="Habilitar/deshabilitar persona física">
                                            <i id="icon" class="bi bi-person"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="form-campo">
                                    <label for="nombres" class="required">Nombre</label>
                                    <input type="text" name="nombres" id="nombres" class="input-persona" placeholder="No disponible" disabled />
                                </div>
                                <div class="form-campo">
                                    <label for="a_paterno" class="required">Apellido paterno</label>
                                    <input type="text" name="a_paterno" id="a_paterno" class="input-persona" placeholder="No disponible" disabled />
                                </div>
                                <div class="form-campo">
                                    <label for="a_materno">Apellido materno</label>
                                    <input type="text" name="a_materno" id="a_materno" class="input-persona" placeholder="No disponible" disabled />
                                </div>
                                <div class="form-campo">
                                    <label for="correo" class="required">Correo</label>
                                    <input type="text" name="correo" id="correo" required />
                                </div>
                                <div class="form-campo">
                                    <label for="telefono" class="required">Teléfono</label>
                                    <input type="text" name="telefono" id="telefono" required />
                                </div>
                                <div class="form-campo" class="required">
                                    <label for="rfc" class="required">RFC</label>
                                    <input type="text" name="rfc" id="rfc" required />
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
                                        <option value="{{$dp->pk_pais}}">{{$dp->nom_pais}}</option>
                                    @endforeach
                                </select>

                                <div class="label-flex">
                                    <label class="required">Estado</label>
                                    <a type="button" onclick="openFormEstado()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_estado" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_estado as $dp)
                                        <option value="{{$dp->pk_estado}}">{{$dp->nom_estado}}</option>
                                    @endforeach
                                </select>

                                <div class="label-flex">
                                    <label class="required">Municipio</label>
                                    <a type="button" onclick="openFormMunicipio()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_municipio" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_municipio as $dp)
                                        <option value="{{$dp->pk_municipio}}">{{$dp->nom_municipio}}</option>
                                    @endforeach
                                </select>

                                <div class="label-flex">
                                    <label class="required">Ciudad/Ubicación</label>
                                    <a type="button" onclick="openFormUbicacion()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_ubicacion" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_ubicacion as $dp)
                                        <option value="{{$dp->pk_ubicacion}}">{{$dp->nom_ubicacion}}</option>
                                    @endforeach
                                </select>

                                <div class="label-flex">
                                    <label class="required">Nacionalidad</label>
                                    <a type="button" onclick="openFormNacionalidad()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_nacionalidad" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_nacionalidad as $dp)
                                        <option value="{{$dp->pk_nacionalidad}}">{{$dp->nom_nacionalidad}}</option>
                                    @endforeach
                                </select>

                                <div class="label-flex">
                                    <label class="required">Régimen Fiscal</label>
                                    <a type="button" onclick="openFormRegimenFiscal()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_regimen_fiscal" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_reg_fisc as $dp)
                                        <option value="{{$dp->pk_regimen_fiscal}}">{{$dp->regimen_fiscal}}</option>
                                    @endforeach
                                </select>

                                <div class="label-flex">
                                    <label class="required">Uso CFDI</label>
                                    <a type="button" onclick="openFormUsoCfdi()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_uso_cfdi" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_uso_cfdi as $dp)
                                        <option value="{{$dp->pk_uso_cfdi}}">{{$dp->uso_cfdi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-grupo">
                                <h5>&nbsp</h5>
                                <div class="form-campo">
                                    <label for="calle" class="required">Calle</label>
                                    <input type="text" name="calle" id="calle" required />
                                </div>
                                <div class="form-campo">
                                    <label for="colonia" class="required">Colonia</label>
                                    <input type="text" name="colonia" id="colonia" required />
                                </div>
                                <div class="form-campo">
                                    <label for="numero" class="required">Número</label>
                                    <input type="number" name="numero" id="numero" required />
                                </div>
                                <div class="form-campo">
                                    <label for="cp" class="required">Código postal</label>
                                    <input type="text" name="cp" id="cp" maxlength="5" required />
                                </div>
                                <div class="form-campo">
                                    <label for="curp" class="required">CURP</label>
                                    <input type="text" name="curp" id="curp" required />
                                </div>

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
                                    <label for="constancia_situa_fiscal">Constancia de situación fiscal</label>
                                    <input type="file" name="constancia_situa_fiscal" id="constancia_situa_fiscal" />
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
                                    <label for="cuenta_anticipo">Cuenta anticipo</label>
                                    <input type="text" name="cuenta_anticipo" id="cuenta_anticipo" />
                                </div>
                            </div>
                            <div class="form-grupo">
                                <h5>&nbsp</h5> <br><br><br>
                                <div class="check-grupo label-flex">
                                    <div class="label-flex">
                                        <input class="form-check-input me-3" type="checkbox" name="extranjero" value="si" >
                                        Extranjero
                                    </div>
                                    <br><br>
                                    <div class="label-flex">
                                        <input class="form-check-input me-3" type="checkbox" name="multisucursal" value="si" >
                                        Multisucursal
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr style="height: 2px">
                        <div class="form-row">
                            <div class="form-grupo">
                                <h5>Agente y grupo</h5>
                                <div class="label-flex">
                                    <label class="required">Agente</label>
                                    <a type="button" onclick="openFormAgente()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_agente" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_agente as $dp)
                                        <option value="{{$dp->pk_agente}}">{{$dp->nom_agente}}</option>
                                    @endforeach
                                </select>

                                <div class="label-flex">
                                    <label class="required">Grupo</label>
                                    <a type="button" onclick="openFormGrupoCliente()" class="form-link">agregar</a>
                                </div>
                                <select class="form-select" name="fk_grupo_cliente" required>
                                    <option selected value="">Selecciona una opción</option>
                                    @foreach ($datos_grp_cli as $dp)
                                        <option value="{{$dp->pk_grupo_cliente}}">{{$dp->nom_grupo}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-grupo">
                                <h5>&nbsp</h5> <br><br><br>
                                <div class="check-grupo label-flex">
                                    <div class="label-flex">
                                        <input class="form-check-input me-3" type="checkbox" name="cliente_agricultor" value="si" >
                                        Cliente Agricultor
                                    </div>
                                    <br><br>
                                    <div class="label-flex">
                                        <input class="form-check-input me-3" type="checkbox" name="cliente_iva_extra" value="si" >
                                        Cliente IVA Extra
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

    {{-- Regimen Fiscal --}}
    <dialog id="formDialogRegimenFiscal">
        <form id="formRegimenFiscal" onsubmit="return submitFormRegimenFiscal(event)" action="{{route('agregarRegimenFiscal')}}" method="post">
            <div class="modal-header">
                <h2 class="title-dialog">Agregar régimen fiscal</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormRegimenFiscal()"></button>
            </div>
            @csrf
            <div class="form-grupo">
                <div class="form-campo">
                    <label for="regimen_fiscal" class="required">Define el régimen fiscal</label>
                    <input type="text" name="regimen_fiscal" id="regimen_fiscal" required />
                </div>
                <div class="form-submit">
                    <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
                </div>
            </div>
            <div id="mensajeRegimenFiscal" style="display: none;"></div>
        </form>
    </dialog>

    <script>
        function openFormRegimenFiscal() {
            var dialog = document.getElementById("formDialogRegimenFiscal");
            dialog.showModal();
        }

        function closeFormRegimenFiscal() {
            var dialog = document.getElementById("formDialogRegimenFiscal");
            dialog.close();
        }

        function resetFormRegimenFiscal() {
            var form = document.querySelector("#formRegimenFiscal");
            form.reset();
        }

        function submitFormRegimenFiscal(event) {
            event.preventDefault();

            var regimen_fiscal = document.getElementById('regimen_fiscal').value;

            if (regimen_fiscal.trim() === '') {
                alert('El régimen fiscal es requerido');
                return;
            }

            var form = document.getElementById('formRegimenFiscal');
            var formData = new FormData(form);
            var mensajeTimeout;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var mensaje = document.getElementById("mensajeRegimenFiscal");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_regimen_fiscal"]');
                        var option = document.createElement("option");
                        option.value = response.regimen_fiscal.pk_regimen_fiscal;
                        option.textContent = regimen_fiscal;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormRegimenFiscal();
                            resetFormRegimenFiscal();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeRegimenFiscal");
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

    {{-- Uso CFDI --}}
    <dialog id="formDialogUsoCfdi">
        <form id="formUsoCfdi" onsubmit="return submitFormUsoCfdi(event)" action="{{route('agregarUsoCfdi')}}" method="post">
            <div class="modal-header">
                <h2 class="title-dialog">Agregar uso de CFDI</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormUsoCfdi()"></button>
            </div>
            @csrf
            <div class="form-grupo">
                <div class="form-campo">
                    <label for="uso_cfdi" class="required">Define el uso de CFDI</label>
                    <input type="text" name="uso_cfdi" id="uso_cfdi" required />
                </div>
                <div class="form-submit">
                    <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
                </div>
            </div>
            <div id="mensajeUsoCfdi" style="display: none;"></div>
        </form>
    </dialog>

    <script>
        function openFormUsoCfdi() {
            var dialog = document.getElementById("formDialogUsoCfdi");
            dialog.showModal();
        }

        function closeFormUsoCfdi() {
            var dialog = document.getElementById("formDialogUsoCfdi");
            dialog.close();
        }

        function resetFormUsoCfdi() {
            var form = document.querySelector("#formUsoCfdi");
            form.reset();
        }

        function submitFormUsoCfdi(event) {
            event.preventDefault();

            var uso_cfdi = document.getElementById('uso_cfdi').value;

            if (uso_cfdi.trim() === '') {
                alert('El uso de CFDI es requerido');
                return;
            }

            var form = document.getElementById('formUsoCfdi');
            var formData = new FormData(form);
            var mensajeTimeout;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var mensaje = document.getElementById("mensajeUsoCfdi");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_uso_cfdi"]');
                        var option = document.createElement("option");
                        option.value = response.uso_cfdi.pk_uso_cfdi;
                        option.textContent = uso_cfdi;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormUsoCfdi();
                            resetFormUsoCfdi();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeUsoCfdi");
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

    {{-- Agente --}}
    <dialog id="formDialogAgente">
        <form id="formAgente" onsubmit="return submitFormAgente(event)" action="{{route('agregarAgente')}}" method="post">
            <div class="modal-header">
                <h2 class="title-dialog">Agregar agente</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormAgente()"></button>
            </div>
            @csrf
            <div class="form-grupo">
                <div class="form-campo">
                    <label for="nom_agente" class="required">Nombre del agente</label>
                    <input type="text" name="nom_agente" id="nom_agente" required />
                </div>
                <div class="form-submit">
                    <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
                </div>
            </div>
            <div id="mensajeAgente" style="display: none;"></div>
        </form>
    </dialog>

    <script>
        function openFormAgente() {
            var dialog = document.getElementById("formDialogAgente");
            dialog.showModal();
        }

        function closeFormAgente() {
            var dialog = document.getElementById("formDialogAgente");
            dialog.close();
        }

        function resetFormAgente() {
            var form = document.querySelector("#formAgente");
            form.reset();
        }

        function submitFormAgente(event) {
            event.preventDefault();

            var nom_agente = document.getElementById('nom_agente').value;

            if (nom_agente.trim() === '') {
                alert('El nombre del agente es requerido');
                return;
            }

            var form = document.getElementById('formAgente');
            var formData = new FormData(form);
            var mensajeTimeout;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var mensaje = document.getElementById("mensajeAgente");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_agente"]');
                        var option = document.createElement("option");
                        option.value = response.agente.pk_agente;
                        option.textContent = nom_agente;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormAgente();
                            resetFormAgente();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeAgente");
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

    {{-- Grupo de cliente --}}
    <dialog id="formDialogGrupoCliente">
        <form id="formGrupoCliente" onsubmit="return submitFormGrupoCliente(event)" action="{{route('agregarGrupoCliente')}}" method="post">
            <div class="modal-header">
                <h2 class="title-dialog">Agregar grupo de cliente</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormGrupoCliente()"></button>
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
            <div id="mensajeGrupoCliente" style="display: none;"></div>
        </form>
    </dialog>

    <script>
        function openFormGrupoCliente() {
            var dialog = document.getElementById("formDialogGrupoCliente");
            dialog.showModal();
        }

        function closeFormGrupoCliente() {
            var dialog = document.getElementById("formDialogGrupoCliente");
            dialog.close();
        }

        function resetFormGrupoCliente() {
            var form = document.querySelector("#formGrupoCliente");
            form.reset();
        }

        function submitFormGrupoCliente(event) {
            event.preventDefault();

            var nom_grupo = document.getElementById('nom_grupo').value;

            if (nom_grupo.trim() === '') {
                alert('El grupo de cliente es requerido');
                return;
            }

            var form = document.getElementById('formGrupoCliente');
            var formData = new FormData(form);
            var mensajeTimeout;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var mensaje = document.getElementById("mensajeGrupoCliente");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        var response = JSON.parse(xhr.responseText);
                        var select = document.querySelector('select[name="fk_grupo_cliente"]');
                        var option = document.createElement("option");
                        option.value = response.grupo_cliente.pk_grupo_cliente;
                        option.textContent = nom_grupo;
                        select.appendChild(option);

                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        setTimeout(function() {
                            closeFormGrupoCliente();
                            resetFormGrupoCliente();
                        }, 2000);
                    } else {
                        var mensaje = document.getElementById("mensajeGrupoCliente");
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
    
</body>
</html>