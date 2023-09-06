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
        function ServicioC() {
            var nombre = $('#nombre').val().trim();
            var descripcion = $('#descripcion').val().trim();
            var precio = $('#precio').val().trim();
    
            if (nombre === '' || descripcion === '' || precio === '') {
                Swal.fire({
                    title: 'Campos vacíos',
                    text: 'Por favor, completa todos los campos antes de continuar.',
                    icon: 'error',
                    confirmButtonColor: '#d33'
                });
            } else {
                Swal.fire({
                    title: 'Confirmación',
                    text: '¿Estás seguro de editar el cliente?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Estoy seguro',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#12B901',
                    cancelButtonColor: '#E41919'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('Servicio').submit();
                    }
                });
            }
        }

        $(document).ready(function() {
            function validarFormulario() {
                var nombre = $('#numeroHabitacion').val().trim();
                var descripcion = $('#descripcion').val().trim();
                var precio = $('#precio').val().trim();

                if (
                    nombre === '' ||
                    descripcion === '' ||
                    categoria === ''
                ) {
                    return false;
                }

                return true;
            }

            $('#nombre').on('input', function() {
                var nombre = $(this).val();

                if (nombre.trim() === '') {
                    $('#nombreError').text('El nombre del servicio es requerido');
                } else {
                    $('#nombreError').text('');
                }
            });

            $('#descripcion').on('input', function() {
                var descripcion = $(this).val();

                if (descripcion.trim() === '') {
                    $('#descripcionError').text('La descripción del servicio es requerida');
                } else {
                    $('#descripcionError').text('');
                }
            });

            $('#precio').on('input', function() {
                var precio = $(this).val();

                if (precio.trim() === '') {
                    $('#precioSError').text('El precio del servicio es requerido');
                } else {
                    $('#precioSError').text('');
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
                    <h1 class="modal-title fs-5" id="modalCreateLabel">Registrar nuevo servicio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="Servicio" class="row g-3" method="POST" action="{{ route('servicios.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" required>
                            <span id="nombreError" class="text-danger"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" name="precio" id="precio"
                                placeholder="1000000" required>
                            <span id="precioSError" class="text-danger"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea type="text" class="form-control" name="descripcion" id="descripcion" required></textarea>
                            <span id="descripcionError" class="text-danger"></span>
                        </div>
                        <div>
                            <input type="hidden" class="form-control" name="estado" id="estado"
                                value="{{ \App\Models\Servicio::Activo }}">
                        </div>

                        <div>
                            <!-- input hidden donde el valor es un datatime de la fecha y hora actual -->
                            <input type="hidden" name="created_at" id="created_at" value="">
                            <script>
                                // Obtener el elemento del campo de fecha y hora actual
                                var createdAtField = document.getElementById('created_at');

                                // Obtener la fecha y hora actual
                                var currentDate = new Date();

                                // Formatear la fecha y hora actual en el formato deseado (YYYY-MM-DD HH:MM:SS)
                                var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');

                                // Asignar el valor de la fecha y hora actual al campo oculto
                                createdAtField.value = formattedDate;
                            </script>
                        </div>
                    </form><br>
                    <div class="modal-footer" style="margin-right: 30px">
                        <button type="submit" onclick="ServicioC()" class="btn btn-primary">Crear</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
