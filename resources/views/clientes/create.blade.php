<!-- MODAL  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function clienteConfirmacion() {
            var nombre = $('#primernombre').val().trim();
            var apellido = $('#primerapellido').val().trim();
            var tipoDocumento = $('#tipodocumento').val();
            var documento = $('#documento').val().trim();
            var celular = $('#celular').val().trim();
            var correo = $('#correo').val().trim();

            if (nombre === '' || apellido === '' || tipoDocumento === '' || documento === '' || celular === '' || correo ===
                '') {
                Swal.fire({
                    title: 'Campos vacíos',
                    text: 'Por favor, completa todos los campos antes de continuar.',
                    icon: 'error',
                    confirmButtonColor: '#d33'
                });
            } else {
                Swal.fire({
                    title: 'Confirmación',
                    text: '¿Estás seguro de crear el cliente?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Estoy seguro',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#12B901',
                    cancelButtonColor: '#E41919'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('clienteForm').submit();
                    }
                });
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            function validarFormulario() {
                var nombre = $('#primernombre').val().trim();
                var nombre2 = $('#segundonombre').val().trim();
                var apellido = $('#primerapellido').val().trim();
                var segundoapellido = $('#segundoapellido').val();
                var tipoDocumento = $('#tipodocumento').val();
                var documento = $('#documento').val().trim();
                var celular = $('#celular').val().trim();
                var correo = $('#correo').val().trim();

                if (
                    nombre === '' ||
                    apellido === '' ||
                    tipoDocumento === '' ||
                    documento === '' ||
                    celular === '' ||
                    correo === ''
                ) {
                    return false;
                }

                return true;
            }

            $('#primernombre').on('input', function() {
                var primernombre = $(this).val();

                if (primernombre.trim() === '') {
                    $('#nombreError').text('El nombre es requerido');
                } else if (primernombre.includes(' ')) {
                    $('#nombreError').text('El nombre no puede contener espacios');
                } else {
                    $('#nombreError').text('');
                }
            });

            $('#segundonombre').on('input', function() {
                var segundonombre = $(this).val();

                if (segundonombre.trim() === '') {
                    $('#nombreSError').text('Este campo no es requerido');
                } else if (segundonombre.includes(' ')) {
                    $('#nombreSError').text('El nombre no puede contener espacios');
                } else {
                    $('#nombreSError').text('');
                }
            });

            $('#primerapellido').on('input', function() {
                var primerapellido = $(this).val();

                if (primerapellido.trim() === '') {
                    $('#apellidoError').text('El apellido es requerido');
                } else if (primerapellido.includes(' ')) {
                    $('#apellidoError').text('El apellido no puede contener espacios');
                } else {
                    $('#apellidoError').text('');
                }
            });

            $('#segundoapellido').on('input', function() {
                var segundoapellido = $(this).val();

                if (segundoapellido.trim() === '') {
                    $('#apellidoSError').text('Este campo no es requerido');
                } else if (segundoapellido.includes(' ')) {
                    $('#apellidoSError').text('El apellido no puede contener espacios');
                } else {
                    $('#apellidoSError').text('');
                }
            });

            $('#tipodocumento').on('change', function() {
                var tipodoc = $(this).val();

                if (tipodoc === '') {
                    $('#tipodocError').text('Seleccione el tipo documento');
                } else {
                    $('#tipodocError').text('');
                }
            });

            $('#documento').on('input', function() {
                var documento = $(this).val();

                if (documento.trim() === '') {
                    $('#documentoError').text('El documento es requerido');
                } else if (documento.includes(' ')) {
                    $('#documentoError').text('El documento no puede contener espacios');
                } else if (documento.length < 6) {
                    $('#documentoError').text('El documento de identidad debe tener al menos 6 dígitos');
                } else {
                    $('#documentoError').text('');
                }
            });

            $('#celular').on('input', function() {
                var celular = $(this).val();

                if (celular.trim() === '') {
                    $('#celularError').text('El número de celular es requerido');
                } else if (celular.includes(' ')) {
                    $('#celularError').text('El número de celular no puede contener espacios');
                } else if (celular.length < 10) {
                    $('#celularError').text('El celular debe tener 10 dígitos');
                } else if (!/^\d+$/.test(celular)) {
                    $('#celularError').text('El número de celular debe contener solo dígitos');
                } else {
                    $('#celularError').text('');
                }
            });

            $('#correo').on('input', function() {
                var correo = $(this).val(); //1

                if (correo.trim() === '') { //2
                    $('#correoError').text('El correo es requerido'); //3
                } else if (!validateEmail(correo)) { //4
                    $('#correoError').text('El correo no tiene un formato válido'); //5
                } else {
                    $('#correoError').text(''); //6
                }
            });

            function validateEmail(email) {
                var re = /\S+@\S+\.\S+/;
                return re.test(email);
            }

            $('#submitButton').on('click', function(event) {
                if (!validarFormulario()) {
                    event.preventDefault();
                }
            });
        });
    </script>
</head>

<body>
    <div class="modal fade" id="modalCre" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar cliente</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="clienteForm" action="{{ route('clientes.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <!--Clave evita error -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Nombre <span class="required-field"
                                        style="color: red; font-size: 16px;">*</span></label>
                                <input type="text" placeholder="" class="form-control" id="primernombre"
                                    name="primernombre" required>
                                <span id="nombreError" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Segundo Nombre</label>
                                <input type="text" placeholder="" class="form-control" id="segundonombre"
                                    name="segundonombre">
                                <span id="nombreSError" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Primer Apellido <span class="required-field"
                                        style="color: red; font-size: 16px;">*</span></label>
                                <input type="text" placeholder="" class="form-control" id="primerapellido"
                                    name="primerapellido" required>
                                <span id="apellidoError" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Segundo Apellido</label>
                                <input type="text" placeholder="" class="form-control" id="segundoapellido"
                                    name="segundoapellido">
                                <span id="apellidoSError" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Documento <span class="required-field"
                                        style="color: red; font-size: 16px;">*</span></label>
                                <input type="number" placeholder="" class="form-control" id="documento"
                                    name="documento" required>
                                <span id="documentoError" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="tipodocumento" class="form-label">Tipo documento <span
                                        class="required-field" style="color: red; font-size: 16px;">*</span></label>
                                <select name="tipodocumento" id="tipodocumento" class="form-control">
                                    <option value="">Seleccione el tipo documento</option>
                                    <option value="CC">Cédula ciudadana</option>
                                    <option value="CE">Cédula extranjera</option>
                                    <option value="T.I">Tarjeta Identidad</option>
                                    <option value="N.T">Nit</option>
                                    <option value="PA">Pasaporte</option>
                                </select>
                                <span id="tipodocError" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Celular <span class="required-field"
                                        style="color: red; font-size: 16px;">*</span></label>
                                <input type="number" placeholder="" class="form-control" id="celular"
                                    name="celular" required>
                                <span id="celularError" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Correo <span class="required-field"
                                        style="color: red; font-size: 16px;">*</span></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="email" placeholder="" class="form-control" id="correo"
                                        name="correo" aria-describedby="inputGroupPrepend" required>
                                </div>
                                <span id="correoError" class="text-danger"></span>
                            </div>
                            <div>
                                <input type="hidden" name="estado" id="estado"
                                    value="{{ app\models\Cliente::Activo }}">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">

                    <button class="btn btn-primary" onclick="clienteConfirmacion()" type="submit" >Crear</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
