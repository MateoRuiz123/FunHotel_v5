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
        function CheckValidacion() {
            var checkin = $('#checkin').val().trim();
            var salida = $('#salida').val().trim();
            var reserva = $('#reserva').val();
            var cliente = $('#cliente').val().trim();
            var metpago = $('#metpago').val().trim();
            var venta = $('#venta').val().trim();

            if (checkin === '' || salida === '' || reserva === '' || cliente === '' || metpago === '' || venta === '') {
                Swal.fire({
                    title: 'Campos vacíos',
                    text: 'Por favor, completa todos los campos antes de continuar.',
                    icon: 'error',
                    confirmButtonColor: '#d33'
                });
            } else {
                Swal.fire({
                    title: 'Confirmación',
                    text: '¿Estás seguro de crear el checkout?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Estoy seguro',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#12B901',
                    cancelButtonColor: '#E41919'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('CheckOu').submit();
                    }
                });
            }
        }
    </script>
</head>

<body>

        <!-- Modal -->
        <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalCreateLabel" aria-hidden="true">

            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar check-out</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">

                        <form id="CheckOu" class="row g-3" action="{{ route('checkouts.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <label for="" class="form-label"> Fecha de salida</label>
                                <input type="date" class="form-control" name="salida" id="salida"
                                    aria-describedby="helpId" placeholder="">

                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Id Check-in</label>
                                <select name="checkin" id="checkin" class="form-select">
                                    <option selected disabled value="">Seleccione</option>
                                    @foreach ($checkins as $checkin)
                                        @if ($checkin->estado == 1)
                                            <!-- Verificar si el estado es activo (1) -->
                                            <option value="{{ $checkin->id }}">{{ $checkin->id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Id Reserva</label>
                                <select name="reserva" id="reserva" class="form-select">
                                    <option selected disabled value="">Seleccione</option>
                                    @foreach ($reservas as $reserva)
                                        @if ($reserva->estado == 1)
                                            <!-- Verificar si el estado es activo (1) -->
                                            <option value="{{ $reserva->id }}">{{ $reserva->id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Cliente:</label>
                                {{-- <input type="text" class="form-control" name="cliente" id="" aria-describedby="helpId" placeholder=""> --}}
                                <select class="form-select" name="cliente" id="cliente" required>
                                    <option selected disabled value="">Seleccione</option>
                                    @foreach ($clientes as $cliente)
                                        @if ($cliente->estado == 1)
                                            <!-- Verificar si el estado es activo (1) -->
                                            <option value="{{ $cliente->id }}">{{ $cliente->numeroDocumento }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <span id="clienteError" class="text-danger"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Metodo de pago</label>
                                <select name="metpago" id="metpago" class="form-select">
                                    <option selected disabled value="">Seleccione</option>
                                    @foreach ($metodos as $metodo)
                                        @if ($metodo->estado == 1)
                                            <!-- Verificar si el estado es activo (1) -->
                                            <option value="{{ $metodo->id }}">{{ $metodo->nombre }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Id Venta</label>
                                <select name="venta" id="venta" class="form-select">
                                    <option selected disabled value="">Seleccione</option>
                                    @foreach ($ventas as $venta)
                                        @if ($venta->estado == 1)
                                            <!-- Verificar si el estado es activo (1) -->
                                            <option value="{{ $venta->id }}">{{ $venta->id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <input type="hidden" name="estado" id="estado"
                                    value="{{ app\models\Checkout::Activo }}">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" onclick="CheckValidacion()" class="btn btn-primary">Crear</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </div>
        </div>
</body>

</html>
