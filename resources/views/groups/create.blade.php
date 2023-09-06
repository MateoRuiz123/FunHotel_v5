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
        function ficha() {
            var nombre = $('#name').val().trim();
    
            if (nombre === '' ) {
                Swal.fire({
                    title: 'Campo vacío',
                    text: 'Por favor, completa el campo antes de continuar.',
                    icon: 'error',
                    confirmButtonColor: '#d33'
                });
            } else {
                Swal.fire({
                    title: 'Confirmación',
                    text: '¿Estás seguro de crear esta ficha?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Estoy seguro',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#12B901',
                    cancelButtonColor: '#E41919'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('FichaForm').submit();
                    }
                });
            }
        }
    </script>
 <script>
        $(document).ready(function() {
            function validarFormulario() {
                var nombre = $('#name').val().trim();

                if (
                    nombre === ''

                    ) {
                    return false;
                }

                return true;
            }
            $('#name').on('input', function() {
                var name = $(this).val();

                if (name.trim() === '') {
                    $('#nameError').text('El número de la ficha es requerida');
                } else if (name.includes(' ')) {
                    $('#nameError').text('El número de la ficha no puede contener espacios');
                } else if (name.length < 3) {
                    $('#nameError').text('El número de la ficha debe tener al menos 5 dígitos');
                } else if (!/^\d+$/.test(name)) {
                    $('#nameError').text('El número de la ficha debe contener solo números');
                } else {
                    $('#nameError').text('');
                }
            });

            $('#submitButton').on('click', function(event) {
                if (!validarFormulario()) {
                    event.preventDefault();
                }
            });
        }); 
    </script>
</head>
<body>
<div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCreateLabel">Registrar nueva ficha</h1><br>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><br>
            <div class="modal-body">
                <form id="FichaForm" action="{{ route('groups.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label for="name">Nombre</label>
                        <input type="text" placeholder="2471447" name="name" id="name" class="form-control">
                        <span id="nameError" class="text-danger"></span>
                    </div>
                </form><br>
                <div class="modal-footer">
                    <button type="submit" onclick="ficha()" class="btn btn-primary" id="submitButton">Crear</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


