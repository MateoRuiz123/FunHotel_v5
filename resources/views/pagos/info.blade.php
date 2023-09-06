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
            var requiredFields = document.querySelectorAll('.mpago-form-control[required]');

            requiredFields.forEach(function(field) {
                field.addEventListener('input', function() {
                    PagosV(this);
                });
            });
        });

        function PagosV(field) {
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
    <div class="modal fade" id="edit{{ $pago->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Método de pago</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div><br>
                <div class="modal-body">
                    <div class="row">
                        <form id="Updform" class="row g-3" action="{{ route('pagos.update', $pago->id) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label for="" class="form-label">Nombre Método de pago</label>
                                <input type="text" class="form-control mpago-form-control" name="nombre"
                                    id="nombre2" aria-describedby="helpId" required value="{{ $pago->nombre }}">
                                <small class="invalid-feedback"></small>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label"> Estado</label>
                                <select class="form-select" name="estado" id="estado">
                                    <option value="{{ \app\models\pago::Activo }}"
                                        @if ($pago->estado == \app\models\pago::Activo) selected @endif>Activo</option>
                                    <option value="{{ \app\models\pago::Inactivo }}"
                                        @if ($pago->estado == \app\models\pago::Inactivo) selected @endif>Inactivo</option>
                                </select>
                            </div>
                    </div>
                    </form><br>
                    <div class="modal-footer">
                        <button type="submit" form="Updform" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!-- Modal Delete -->
<div class="modal fade" id="delete{{ $pago->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Metodo de pago</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('pagos.destroy', $pago->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <!--Clave evita error -->
                @method('Delete')
                <div class="modal-body">
                    ¡¿Estás seguro de eliminar el pago por<strong> {{ $pago->nombre }} ?!</strong>
                </div><br>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
