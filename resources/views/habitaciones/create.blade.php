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
        function Habiven() {
            var numero = $('#numeroHabitacion').val().trim();
            var descripcion = $('#descripcion').val().trim();
            var categoria = $('#idCategoria').val().trim();
    
            if (numero === '' || descripcion === '' ||  idCategoria === '' ) {
                Swal.fire({
                    title: 'Campos vacíos',
                    text: 'Por favor, completa todos los campos antes de continuar.',
                    icon: 'error',
                    confirmButtonColor: '#d33'
                });
            } else {
                Swal.fire({
                    title: 'Confirmación',
                    text: '¿Estás seguro de crear la habitación?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Estoy seguro',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#12B901',
                    cancelButtonColor: '#E41919'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('Habitacionform').submit();
                    }
                });
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            function validarFormulario() {
                var numero = $('#numeroHabitacion').val().trim();
                var descripcion = $('#descripcion').val().trim();
                var categoria = $('#idCategoria').val().trim();

                if (
                    numero === '' ||
                    descripcion === '' ||
                    categoria === '' 
                ) {
                    return false;
                }

                return true;
            }
            $('#numeroHabitacion').on('input', function() {
                var numero = $(this).val();

                if (numero.trim() === '') {
                    $('#numeroSError').text('El número de la habitación es requerido');
                }  else if (numero.length < 3) {
                    $('#numeroSError').text('El número de la habitación debe tener al menos 3 dígitos');
                } else if (numero.includes(' ')) {
                    $('#numeroSError').text('El número de la habitación no puede contener espacios');
                } else if (numero.length < 3) {
                    $('#numeroSError').text('El número de la habitación debe tener al menos 3 dígitos');
                } else if (!/^\d+$/.test(numero)) {
                    $('#numeroSError').text('El número de la habitación debe contener solo números');
                } else {
                    $('#numeroSError').text('');
                }
            });

            $('#descripcion').on('input', function() {
                var descripcion = $(this).val();

                if (descripcion.trim() === '') {
                    $('#descripcionError').text('La descripción de la habitación es requerida');
                } else {
                    $('#descripcionError').text('');
                }
            });
            
            $('#idCategoria').on('change', function() {
                var categoria = $(this).val();

                if (categoria === '') {
                    $('#categoriaError').text('Seleccione la categoría de la habitación');
                } else {
                    $('#categoriaError').text('');
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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCreateLabel">Registrar nueva habitación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="Habitacionform" action="{{ route('habitaciones.store') }}" method="post" enctype="multipart/form-data"
                    class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label for="">Número de Habitación</label>
                        <input class="form-control" type="text" name="numeroHabitacion" id="numeroHabitacion">
                        <span id="numeroSError" class="text-danger"></span>
                    </div>
                    <div class="col-md-6">
                        <!-- Select idCategoria -->
                        <label for="">Categoría</label>
                        <select class="form-select" name="idCategoria" id="idCategoria">
                            <option selected disabled value="" >Seleccione</option>
                            @foreach ($categorias as $categoria)
                            @if($categoria->estado == 1)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endif
                            @endforeach
                        </select>
                        <span id="categoriaError" class="text-danger"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="">Descripción</label>
                        <textarea class="form-control" type="text" name="descripcion" id="descripcion"></textarea>
                        <span id="descripcionError" class="text-danger"></span>
                    </div>
                    <div>
                        <input type="hidden" id="estado" name="estado" value="{{ \App\Models\Habitacion::Disponible}}">
                    </div>
                </form>
                <div class="modal-footer"><br>
                    <button class="btn btn-primary" id="submitButton" onclick="Habiven()" type="submit">Crear</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>