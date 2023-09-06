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
        function categoria() {
            var nombre = $('#nombre').val().trim();
            var descripcion = $('#descripcion').val().trim();
    
            if (nombre === '' || descripcion === '' ) {
                Swal.fire({
                    title: 'Campos vacíos',
                    text: 'Por favor, completa todos los campos antes de continuar.',
                    icon: 'error',
                    confirmButtonColor: '#d33'
                });
            } else {
                Swal.fire({
                    title: 'Confirmación',
                    text: '¿Estás seguro de crear la categoría?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Estoy seguro',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#12B901',
                    cancelButtonColor: '#E41919'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('CategoriaForm').submit();
                    }
                });
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            function validarFormulario() {
                var nombre = $('#nombre').val().trim();
                var descripcion = $('#descripcion').val().trim();

                if (
                    nombre === '' ||
                    descripcion === '' 
                ) {
                    return false;
                }

                return true;
            }
            
            $('#nombre').on('input', function() {
                var nombre = $(this).val();

                if (nombre.trim() === '') {
                    $('#nombreError').text('El nombre de la categoría es requerida');
                } else {
                    $('#nombreError').text('');
                }
            });
            
            $('#descripcion').on('input', function() {
                var descripcion = $(this).val();

                if (descripcion.trim() === '') {
                    $('#descripcionError').text('La descripción de la categoría es requerida');
                } else {
                    $('#descripcionError').text('');
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
                <h1 class="modal-title fs-5" id="modalCreateLabel">Registrar nueva categoría</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><br>
            <div class="modal-body">
                <form id="CategoriaForm" class="row g-3" method="POST" action="{{ route('categorias.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required>
                        <span id="nombreError" class="text-danger"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Descripción</label>
                        <textarea type="text" class="form-control" name="descripcion" id="descripcion" required></textarea>
                        <span id="descripcionError" class="text-danger"></span>
                    </div>
                    <div>
                        <input type="hidden" class="form-control" name="estado" id="estado"
                            value="{{ \App\Models\Categoria::Activo }}">
                    </div>

                    <div>
                        <input type="hidden" name="created_at" id="created_at" value="{{ now() }}">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="submit" onclick="categoria()" class="btn btn-primary">Crear</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
