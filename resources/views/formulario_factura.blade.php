<div class="form-grupo">

    <div class="label-flex">
        <label class="required">Metodo de pago</label>
        <a type="button" onclick="openFormMetodoPago()" class="form-link">agregar</a>
    </div>
    <select class="form-select" name="fk_metodo_pago" required>
        <option selected value="">Selecciona una opción</option>
        @foreach ($datos_metodo_pago as $dp)
            <option value="{{$dp->pk_metodo_pago}}">{{$dp->nom_metodo_pago}}</option>
        @endforeach
    </select>

</div>

{{-- Metodo de pago --}}
<dialog id="formDialogMetodoPago">
    <form id="formMetodoPago" onsubmit="return submitFormMetodoPago(event)" action="{{route('agregarMetodoPago')}}" method="post">
        <div class="modal-header">
            <h2 class="title-dialog">Agregar metodo de pago</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeFormMetodoPago()"></button>
        </div>
        @csrf
        <div class="form-grupo">
            <div class="form-campo">
                <label for="nom_metodo" class="required">Metodo de pago</label>
                <input type="text" name="nom_metodo" id="nom_metodo" required />
            </div>
            <div class="form-submit">
                <input type="submit" value="Guardar" class="submit" id="submit" name="submit" />
            </div>
        </div>
        <div id="mensajeMetodoPago" style="display: none;"></div>
    </form>
</dialog>

<script>
    function openFormMetodoPago() {
        var dialog = document.getElementById("formDialogMetodoPago");
        dialog.showModal();
    }

    function closeFormMetodoPago() {
        var dialog = document.getElementById("formDialogMetodoPago");
        dialog.close();
    }

    function resetFormMetodoPago() {
        var form = document.querySelector("#formMetodoPago");
        form.reset();
    }

    function submitFormMetodoPago(event) {
        // Evita que se envien los datos automaticamente
        event.preventDefault();

        // Traer a la variable el campo del tombre
        var nom_metodo = document.getElementById('nom_metodo').value;

        // Validar que el campo no este vacio
        if (nom_metodo.trim() === '') {
            alert('El metodo de pago es requerido');
            return;
        }

        // Traer a la variable los datos del formulario
        var form = document.getElementById('formMetodoPago');
        // Recopilar los datos
        var formData = new FormData(form);
        // Para manejar la duración del mensaje
        var mensajeTimeout;

        // Llamada AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var metodo_pago = response.metodo_pago;
                        // Éxito en la solicitud
                        var mensaje = document.getElementById("mensajeMetodoPago");
                        mensaje.textContent = "Guardado";
                        mensaje.style.color = "green";

                        // Agregar la nueva opción al select
                        var response = JSON.parse(xhr.responseText); // Analizar la respuesta como JSON
                        var select = document.querySelector('select[name="fk_metodo_pago"]');
                        var option = document.createElement("option");
                        option.value = response.metodo_pago.pk_metodo_pago; // Obtener el ID guardado
                        option.textContent = metodo_pago.nom_metodo; // Obtener el nombre guardado
                        select.appendChild(option);

                        // Duración del mensaje
                        mensajeTimeout = setTimeout(function() {
                            mensaje.style.display = "none";
                        }, 2000);

                        // Duración para cerrar y vaciar campos del form
                        setTimeout(function() {
                            closeFormMetodoPago();
                            resetFormMetodoPago();
                        }, 2000);
                    } else {
                        // Error en la solicitud AJAX
                        var mensaje = document.getElementById("mensajeMetodoPago");
                        mensaje.textContent = "Hay un problema, verifica la información";
                        mensaje.style.color = "red";
                    }
                }
                // Para que aparezca el mensaje en el dialog
                mensaje.style.display = "block";
            }
        };
        xhr.send(formData);
        // Para cancelar en caso de cerrar el dialog antes de tiempo
        clearTimeout(mensajeTimeout);
    }

</script>