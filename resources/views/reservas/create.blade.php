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
        function reserva() {
            var habitacion = $('#habitacion').val().trim();
            var servicio = $('#servicio').val().trim();
            var cliente = $('#cliente').val().trim();

            if (habitacion === '' || servicio === '' || cliente === '') {
                Swal.fire({
                    title: 'Campos vacíos',
                    text: 'Por favor, completa todos los campos antes de continuar.',
                    icon: 'error',
                    confirmButtonColor: '#d33'
                });
            } else {
                Swal.fire({
                    title: 'Confirmación',
                    text: '¿Estás seguro de crear la reserva?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Estoy seguro',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#12B901',
                    cancelButtonColor: '#E41919'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('ReservaForm').submit();
                    }
                });
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            function validarFormulario() {
                var habitacion = $('#habitacion').val().trim();
                var servicio = $('#servicio').val().trim();
                var cliente = $('#cliente').val().trim();

                if (
                    habitacion === '' ||
                    servicio === '' ||
                    cliente === ''
                ) {
                    return false;
                }

                return true;
            }

            $('#habitacion').on('change', function() {
                var habitacion = $(this).val();

                if (habitacion === '') {
                    $('#habitacionError').text('Seleccione la habitación');
                } else {
                    $('#habitacionError').text('');
                }
            });

            $('#servicio').on('change', function() {
                var servicio = $(this).val();
                var precio = $('option:selected', this).data(
                'precio'); // Obtiene el precio del servicio seleccionado

                if (servicio === '') {
                    $('#servicioError').text('Seleccione el servicio');
                } else {
                    $('#servicioError').text('');
                    $('#precioServicio').val(precio); // Almacena el precio del servicio en el campo oculto
                }
            });


            $('#cliente').on('change', function() {
                var cliente = $(this).val();

                if (cliente === '') {
                    $('#clienteError').text('Seleccione el cliente');
                } else {
                    $('#clienteError').text('');
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

    <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar reserva</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="ReservaForm" class="row g-3" action="{{ route('reservas.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="" class="form-label">Nro. Habitacion</label>
                            {{-- <input type="text" class="form-control" name="habitacion" id="" aria-describedby="helpId" placeholder=""> --}}
                            <select class="form-select" name="habitacion" id="habitacion" required>
                                <option value="">Seleccione</option>
                                @foreach ($habitaciones as $habitacion)
                                    @if ($habitacion->estado == 1)
                                        <option value="{{ $habitacion->id }}">{{ $habitacion->numeroHabitacion }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <span id="habitacionError" class="text-danger"></span>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Servicio:</label>
                            <select class="form-select" name="servicio" id="servicio" required>
                                <option value="">Seleccione</option>
                                @foreach ($servicios as $servicio)
                                    @if ($servicio->estado == 1)
                                        <option value="{{ $servicio->id }}" data-precio="{{ $servicio->precio }}">
                                            {{ $servicio->nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span id="servicioError" class="text-danger"></span>
                        </div>
                        <input type="hidden" id="precioServicio" name="precio_servicio" value="">


                        <div class="col-md-6">
                            <label for="" class="form-label">Cliente:</label>
                            {{-- <input type="text" class="form-control" name="cliente" id="" aria-describedby="helpId" placeholder=""> --}}
                            <select class="form-select" name="cliente" id="cliente" required>
                                <option value="">Seleccione</option>
                                @foreach ($clientes as $cliente)
                                    @if ($cliente->estado == 1)
                                        <option value="{{ $cliente->id }}">{{ $cliente->numeroDocumento }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <span id="clienteError" class="text-danger"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="entrada" class="form-label">De:</label>
                            <input type="datetime-local" class="form-control" name="entrada" id="entrada"
                                aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="col-md-6">
                            <label for="salida" class="form-label">Hasta:</label>
                            <input type="datetime-local" class="form-control" name="salida" id="salida"
                                aria-describedby="helpId" placeholder="">
                        </div>

                        <div>
                            <input type="hidden" name="estado" id="estado"
                                value="{{ \App\Models\Reserva::Activo }}">
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
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" onclick="reserva()" type="submit"
                        type="submitButton">Crear</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Obtener la fecha y hora actual en el formato adecuado para datetime-local
        const fechaActual = new Date().toISOString().slice(0, 16);

        // Establecer la fecha mínima como la fecha actual
        document.getElementById("entrada").min = fechaActual;
        document.getElementById("salida").min = fechaActual;
    </script>

</body>

</html>
