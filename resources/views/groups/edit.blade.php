<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var requiredFields = document.querySelectorAll('.ficha-form[required]');

            requiredFields.forEach(function(field) {
                field.addEventListener('input', function() {
                    Fichavalidaciones(this);
                });
            });
        });

        function Fichavalidaciones(field) {
            var errorMessage = field.parentNode.querySelector('.invalid-feedback');

            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                errorMessage.textContent = 'Este campo es requerido';
            } else {
                field.classList.remove('is-invalid');
                errorMessage.textContent = '';
            }
        };
    </script>
</head>

<body>
    <div class="modal fade" id="modalEdit{{ $group->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalCreateLabel">Editar nombre de la ficha</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><br>
                <div class="modal-body">
                    <form id="FichaForm" action="{{ route('groups.update', $group->id) }}" method="POST" class="row g-3">
                        @csrf
                        @method('put')
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control ficha-form" name="name" id="name"
                                aria-describedby="helpId" value="{{ $group->name }}" required>
                            <small class="invalid-feedback"></small>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
