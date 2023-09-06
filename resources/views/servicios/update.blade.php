<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var requiredFields = document.querySelectorAll('.servicio-form-control[required]');

            requiredFields.forEach(function (field) {
                field.addEventListener('input', function () {
                    serviciosC(this);
                });
            });
        });
        function serviciosC(field) {
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
    <div class="modal fade" id="modalUpdate{{ $servicio->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalCreateLabel">Editar servicio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                 <div class="row">
                    <form id="Nev" class="row g-3" method="POST" action="{{ route('servicios.update', $servicio->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control servicio-form-control" name="nombre"  id="nombre1" value="{{ $servicio->nombre }}" required>
                            <small class="invalid-feedback"></small>
                        </div>
                        <div class="col-md-6">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control servicio-form-control" name="precio" id="precio2"  
                                value="{{ $servicio->precio }}" required>
                            <small class="invalid-feedback"></small>
                        </div>
                        <div class="col-md-6"><br>
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea type="text" class="form-control servicio-form-control" name="descripcion"  id="descripcion3" required>{{ $servicio->descripcion }}</textarea>
                            <small class="invalid-feedback"></small>
                        </div>
                        <div class="col-md-6"><br>
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" name="estado" id="estado">
                                <option value="{{\App\Models\Servicio::Activo}}" {{ $servicio->estado == \App\Models\Servicio::Activo ? 'selected' : '' }}>Activo</option>
                                <option value="{{\App\Models\Servicio::Inactivo}}" {{ $servicio->estado == \App\Models\Servicio::Inactivo ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </form>
                </div></div><br>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="Nev" >Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div> 
            </div>
        </div>
        </div>
    </div>
</body>
</html>
