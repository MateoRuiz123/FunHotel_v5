<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var requiredFields = document.querySelectorAll('.habitacion[required]');

            requiredFields.forEach(function(field) {
                field.addEventListener('input', function() {
                    validaCategoria(this);
                    validarLongitud(this);
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
        }

        function validarLongitud(field) {
            var value = field.value.replace(/\D/g, '');

            if (field.id === 'numeroHabitacion') {
                validarLongitudNumero(field, value);
            }
        }

        function validarLongitudNumero(field, value) {
            var errorMessage = field.parentNode.querySelector('.invalid-feedback');
            if (value.length < 3) {
                field.classList.add('is-invalid');
                errorMessage.textContent = 'El número de habitación debe tener al menos 3 dígitos';
            } else {
                field.classList.remove('is-invalid');
                errorMessage.textContent = '';
            }
        }
    </script>
</head>

<body>
    <div class="modal fade" id="modalUpdate{{ $habitacion->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalCreateLabel">Editar habitación</h1><br>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><br>
                <div class="modal-body">
                    <form id="Updateform" action="{{ route('habitaciones.update', $habitacion->id) }}" method="post"
                        class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="numeroHabitacion">Número de Habitación</label>
                                <input type="number" name="numeroHabitacion" id="numeroHabitacion" class="form-control"
                                    value="{{ $habitacion->numeroHabitacion }}" required>
                                <small class="invalid-feedback"></small>
                            </div>
                            <div class="col-md-6">
                                <label for="descripcion">Descripción</label>
                                <input class="form-control habitacion" type="text" name="descripcion"
                                    id="descripcion" required value="{{ $habitacion->descripcion }}">
                                <small class="invalid-feedback"></small>
                            </div>
                            <div class="col-md-6"><br>
                                <label for="idCategoria">Categoría</label>
                                <select class="form-select" name="idCategoria" id="idCategoria">
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}"
                                            @if ($categoria->id == $habitacion->idCategoria) selected @endif>
                                            {{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6"><br>
                                <label for="estado">Estado</label>
                                <select class="form-select" name="estado" id="estado">
                                    <option value="{{ \App\Models\Habitacion::Disponible }}"
                                        @if ($habitacion->estado == \App\Models\Habitacion::Disponible) selected @endif>Disponible</option>
                                    <option value="{{ \App\Models\Habitacion::Ocupado }}"
                                        @if ($habitacion->estado == \App\Models\Habitacion::Ocupado) selected @endif>Ocupado</option>
                                    <option value="{{ \App\Models\Habitacion::Mantenimiento }}"
                                        @if ($habitacion->estado == \App\Models\Habitacion::Mantenimiento) selected @endif>Mantenimiento</option>
                                </select>
                            </div>

                            <br>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <input type="submit" value="Editar" class="btn btn-primary">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
