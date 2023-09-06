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
        function checkConfirmacion() {
            var ingreso = $('#ingreso').val().trim();
            var reserva = $('#reserva').val().trim();

            if (ingreso === '' || reserva === '') {
                Swal.fire({
                    title: 'Campos vacíos',
                    text: 'Por favor, completa todos los campos antes de continuar.',
                    icon: 'error',
                    confirmButtonColor: '#d33'
                });
            } else {
                Swal.fire({
                    title: 'Confirmación',
                    text: '¿Estás seguro de crear el checkin?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Estoy seguro',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#12B901',
                    cancelButtonColor: '#E41919'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('Cheform').submit();
                    }
                });
            }
        }
    </script>
</head>
<body>
    <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Check-in</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="Cheform" class="row g-3" action="{{ route('checkins.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="" class="form-label"> Fecha de ingreso</label>
                            <input type="datetime-local" class="form-control" name="ingreso" id="ingreso"
                                aria-describedby="helpId" placeholder="" required>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Id Reserva</label>
                            <select class="form-select" name="reserva" id="reserva" required>
                                <option value="">Seleccione</option>
                                @foreach ($reservas as $reserva)
                                @if ($reserva->estado == 1) <!-- Verificar si el estado es activo (1) -->
                                    <option value="{{ $reserva->id }}">{{ $reserva->id }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="hidden" name="estado" id="estado"
                                value="{{ app\models\Checkin::Activo }}">
                        </div>
                </div>
                </form>
                <div class="modal-footer">
                    <button type="submit" onclick="checkConfirmacion()" class="btn btn-primary">Crear</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
