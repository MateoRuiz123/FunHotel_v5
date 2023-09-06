<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function Reve() {
        Swal.fire({
            title: 'Confirmación',
            text: '¿Estás seguro de editar la reserva?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Estoy seguro',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#12B901',
            cancelButtonColor: '#E41919'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('ReservaUpForm').submit();
            }
        });
    }
</script>

<script>
    // Obtener una lista de clientes con sus números de documento y nombres
    const clientes = [
        @foreach ($clientes as $cliente)
            {
                numeroDocumento: "{{ $cliente->numeroDocumento }}",
                nombreCompleto: "{{ $cliente->primerNombre }} {{ $cliente->primerApellido }}"
            },
        @endforeach
    ];

    // Obtener referencias a los elementos del DOM
    const numeroDocumentoSelect = document.getElementById("numeroDocumento");
    const nombreClienteInput = document.getElementById("nombreCliente");

    // Escuchar el evento "input" en el campo de número de documento
    numeroDocumentoSelect.addEventListener("input", function() {
        const numeroDocumentoSeleccionado = this.value;

        // Buscar el nombre del cliente correspondiente en la lista
        const clienteEncontrado = clientes.find(cliente => cliente.numeroDocumento ===
            numeroDocumentoSeleccionado);

        // Actualizar el campo de nombre si se encuentra el cliente
        if (clienteEncontrado) {
            nombreClienteInput.value = clienteEncontrado.nombreCompleto;
        } else {
            nombreClienteInput.value = ''; // Borrar el campo si no se encuentra un cliente
        }
    });

    // Obtener la fecha y hora actual en el formato adecuado para datetime-local
    const fechaActual = new Date().toISOString().slice(0, 16);

    // Establecer la fecha mínima como la fecha actual
    document.getElementById("entrada").min = fechaActual;
    document.getElementById("salida").min = fechaActual;
</script>

<div class="modal fade" id="edit{{ $reserva->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar reserva</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="ReservaUpForm" class="row g-3" action="{{ route('reservas.update', $reserva->id) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="idHabitacion" class="form-label">Nro. Habitación</label>
                            <select name="idHabitacion" id="idHabitacion" class="form-select">
                                <option value="" selected disabled>Seleccione</option>
                                @foreach ($habitaciones as $habitacion)
                                    <option value="{{ $habitacion->id }}"
                                        @if ($reserva->idHabitacion == $habitacion->id) selected @endif>
                                        {{ $habitacion->numeroHabitacion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="idServicio" class="form-label">Servicio</label>
                            <select name="idServicio" id="idServicio" class="form-select">
                                <option value="" selected disabled>Seleccione</option>
                                @foreach ($servicios as $servicio)
                                    <option value="{{ $servicio->id }}"
                                        @if ($reserva->idServicio == $servicio->id) selected @endif>{{ $servicio->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6"><br>
                            <label for="numeroDocumento" class="form-label">Nro. doc cliente</label>
                            <select name="numeroDocumento" id="numeroDocumento" class="form-select">
                                <option value="" selected disabled>Seleccione</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}"
                                        @if ($reserva->cliente->numeroDocumento == $cliente->numeroDocumento) selected @endif>
                                        {{ $cliente->numeroDocumento }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6"><br>
                            <label for="nombreCliente" class="form-label">Nombre cliente</label>
                            <input type="text" class="form-control" id="nombreCliente"
                                value="{{ $reserva->cliente->primerNombre }} {{ $reserva->cliente->primerApellido }}"
                                disabled>
                        </div>


                        <div class="col-md-6"><br>
                            <label for="" class="form-label">De:</label>
                            <input type="datetime-local" class="form-control" name="entrada" id="entrada"
                                aria-describedby="helpId" placeholder="" value="{{ $reserva->fecIngreso }}">
                        </div>
                        <div class="col-md-6"><br>
                            <label for="" class="form-label">Hasta:</label>
                            <input type="datetime-local" class="form-control" name="salida" id="salida"
                                aria-describedby="helpId" placeholder="" value="{{ $reserva->fecSalida }}">
                        </div>
                        <div class="col-md-6"><br>
                            <label for="" class="form-label">Estado</label>
                            <select class="form-select" name="estado" id="estado">
                                <option value="{{ \app\models\Reserva::Activo }}"
                                    @if ($reserva->estado == \app\models\Reserva::Activo) selected @endif>Activo</option>
                                <option value="{{ \app\models\Reserva::Inactivo }}"
                                    @if ($reserva->estado == \app\models\Reserva::Inactivo) selected @endif>Inactivo</option>
                            </select>
                        </div>
                    </form>
                </div><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" onclick="Reve()" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="delete{{ $reserva->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar reserva</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('reservas.destroy', $reserva->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <!--Clave evita error -->
                @method('Delete')
                <div class="modal-body">
                    ¡¿Estas seguro de eliminar la reserva número <strong> {{ $reserva->id }} ?!</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
