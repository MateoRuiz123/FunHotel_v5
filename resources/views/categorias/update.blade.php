<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var requiredFields = document.querySelectorAll('.categoria[required]');

            requiredFields.forEach(function(field) {
                field.addEventListener('input', function() {
                     validaCategoria(this);
                    });
                });
            });

            function validaCategoria(field) {
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
<body>
    <div class="modal fade" id="modalUpdate{{ $categoria->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalCreateLabel">Editar categoría</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <form id="CategoriaUpForm" class="row g-3" method="POST" action="{{ route('categorias.update', $categoria->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control categoria" name="nombre" id="nombre"
                                value="{{ $categoria->nombre }}" required>
                            <small class="invalid-feedback"></small>
                        </div>
                        <div class="col-md-6">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea type="text" class="form-control categoria" name="descripcion" id="descripcion" required>{{ $categoria->descripcion }}</textarea>
                            <small class="invalid-feedback"></small>
                        </div>
                        <div class="col-md-5">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" name="estado" id="estado">
                                <option value="{{\App\Models\Categoria::Activo}}" {{ $categoria->estado == \App\Models\Categoria::Activo ? 'selected' : '' }}>Activo</option>
                                <option value="{{\App\Models\Categoria::Inactivo}}" {{ $categoria->estado == \App\Models\Categoria::Inactivo ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </form>
                </div><br>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="CategoriaUpForm">Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div> 
    </div>
 </div>
</body>
</html>
