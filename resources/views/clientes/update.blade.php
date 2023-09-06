<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var requiredFields = document.querySelectorAll('.custom-form-control[required]');

            requiredFields.forEach(function(field) {
                field.addEventListener('input', function() {
                    validarCampo(this);
                    validarLongitud(this);
                    validarCorreo(this);
                });
            });
        });

            function validarCampo(field) {
            var errorMessage = field.parentNode.querySelector('.invalid-feedback');

            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                errorMessage.textContent = 'Este campo es requerido';
            } else if (field.value.trim() !== field.value) {
                field.classList.add('is-invalid');
                errorMessage.textContent = 'El campo no puede contener espacios';
            } else {
                field.classList.remove('is-invalid');
                errorMessage.textContent = ''; 
            }
        }

            function validarLongitud(field) {
            var value = field.value.replace(/\D/g, '');

            if (field.id === 'celular') {
                validarLongitudCelular(field, value);
            } else if (field.id === 'documen') {
                validarLongitudDocumento(field, value);
            }
        }

        function validarLongitudCelular(field, value) {
            var errorMessage = field.parentNode.querySelector('.invalid-feedback');
            if (value.length !== 10) {
                field.classList.add('is-invalid');
                errorMessage.textContent = 'El número de celular debe tener 10 dígitos';
            } else {
                field.classList.remove('is-invalid');
                errorMessage.textContent = ''; 
            }
        }

        function validarLongitudDocumento(field, value) {
            var errorMessage = field.parentNode.querySelector('.invalid-feedback');
            if (value.length < 6) {
                field.classList.add('is-invalid');
                errorMessage.textContent = 'El documento debe tener al menos 6 dígitos';
            } else {
                field.classList.remove('is-invalid');
                errorMessage.textContent = '';
            }
        }

        function validarCorreo(field) {
            var errorMessage = field.parentNode.querySelector('.invalid-feedback');

            if (field.type === 'email') {
                var correo = field.value.trim();
                var correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.(com|co|edu)$/;

                if (!correoRegex.test(correo)) {
                    field.classList.add('is-invalid');
                    errorMessage.textContent = 'Correo electrónico inválido';
                } else {
                    field.classList.remove('is-invalid');
                    errorMessage.textContent = ''; 
            }
        }
   };
</script>
</head>
<body>
    <div class="modal fade" id="EDITAR{{ $cliente->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Editar cliente</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit-form" action="{{ route('clientes.update', $cliente->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Nombre <span class="required-field" style="color: red; font-size: 16px;">*</span></label>
                                    <input type="text" class="form-control custom-form-control" name="primernombre" id="nombre12"
                                        aria-describedby="helpId" placeholder="" value="{{ $cliente->primerNombre }}" required>
                                        <small class="invalid-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Segundo Nombre</label>
                                    <input type="text" class="form-control custom-form-control" name="segundonombre" id="nombresegundo" aria-describedby="helpId" placeholder="" value="{{ $cliente->segundoNombre }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Primer Apellido <span class="required-field" style="color: red; font-size: 16px;">*</span></label>
                                    <input type="text" class="form-control custom-form-control" name="primerapellido" id="apellidouno"
                                        aria-describedby="helpId" placeholder="" value="{{ $cliente->primerApellido }}" required>
                                    <small class="invalid-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Segundo Apellido</label>
                                    <input type="text" class="form-control custom-form-control" name="segundoapellido" id="apelli"
                                        aria-describedby="helpId" placeholder="" value="{{ $cliente->segundoApellido }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Tipo documento <span class="required-field" style="color: red; font-size: 16px;">*</span></label>
                                    <select class="form-control custom-form-control" name="documento" id="" required>
                                        <option selected value="{{ $cliente->documento }}">
                                            {{ $cliente->documento }}</option>
                                        <option value="CC">Cédula ciudadana</option>
                                        <option value="CE">Cédula extranjera</option>
                                        <option value="TI">Tarjeta Identidad</option>
                                        <option value="NIT">Nit</option>
                                        <option value="PA">Pasaporte</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Documento <span class="required-field" style="color: red; font-size: 16px;">*</span></label>
                                    <input type="number" class="form-control custom-form-control" name="numeroDocumento" id="documen"
                                        aria-describedby="helpId" placeholder="" value="{{ $cliente->numeroDocumento }}" required>
                                    <small class="invalid-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="celular" class="form-label">Celular <span class="required-field" style="color: red; font-size: 16px;">*</span></label>
                                    <input type="number" class="form-control custom-form-control" name="celular" id="celular"
                                        aria-describedby="helpId" placeholder="" value="{{ $cliente->celular }}" required>
                                    <small class="invalid-feedback"></small>
                                </div>
                            </div><br>
                            <div class="col-md-6">
                                <label for="validationCustomUsername" class="form-label">Correo <span class="required-field" style="color: red; font-size: 16px;">*</span></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="email" placeholder="Correo" id="corr" class="form-control custom-form-control"
                                        id="validationCustomUsername" name="correo" id="corr" aria-describedby="inputGroupPrepend"
                                        value="{{ $cliente->correo }}" required><br>
                                    <small class="invalid-feedback"></small>
                                </div>        
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Estado</label>
                                <select class="form-select" name="estado" id="estado">
                                    <option value="{{ \App\Models\Cliente::Activo }}" @if ($cliente->estado ==
                                        \App\Models\Cliente::Activo) selected @endif>Activo</option>
                                    <option value="{{ \App\Models\Cliente::Inactivo }}" @if ($cliente->estado ==
                                        \App\Models\Cliente::Inactivo) selected @endif>Inactivo</option>
                                </select>
                            </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" onclick="validarCampo()">Actualizar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
