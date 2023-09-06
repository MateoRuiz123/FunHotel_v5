<!-- Modal Edit -->
<div class="modal fade" id="edit{{ $checkout->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar check-out</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="row g-3" action="{{ route('checkouts.update', $checkout->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="" class="form-label">Fecha de salida</label>
                            <input type="date" value="{{$checkout->fecSalida}}" class="form-control" name="salida" id="salida">
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Id Check-in</label>
                            <select name="checkin" id="checkin" class="form-select">
                                <option value="" selected disabled>Seleccione un check in</option>
                                @foreach ($checkins as $checkin)
                                    @if ($checkin->estado == 1)
                                        <!-- Verificar si el estado es activo (1) -->
                                        <option value="{{ $checkin->id }}"
                                            {{ $checkout->idCheckin == $checkin->id ? 'selected' : '' }}>
                                            {{ $checkin->id }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-6">
                            <label for="" class="form-label">Id Reserva</label>
                            <select name="reserva" id="reserva" class="form-select">
                                <option value="" selected disabled>Seleccione una reserva</option>
                                @foreach ($reservas as $reserva)
                                    <option value="{{ $reserva->id }}"
                                        {{ $checkout->idReserva == $reserva->id ? 'selected' : '' }}>
                                        {{ $reserva->id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Nro. doc</label>
                            <select name="cliente" id="cliente"class="form-select">
                                <option value="" selected disabled>Seleccione un cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}"
                                        {{ $checkout->cliente->numeroDocumento == $cliente->numeroDocumento ? 'selected' : '' }}>
                                        {{ $cliente->numeroDocumento }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Metodo de pago</label>
                            <select name="metpago" id="metpago"class="form-select">
                                <option value="" selected disabled>Seleccione un metodo de pago</option>
                                @foreach ($metodos as $metpago)
                                    <option value="{{ $metpago->id }}"
                                        {{ $checkout->metpago->nombre == $metpago->nombre ? 'selected' : '' }}>
                                        {{ $metpago->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Id Venta</label>
                            <select name="venta" id="venta" class="form-select">
                                <option value="" selected disabled>Seleccione una venta</option>
                                @foreach ($ventas as $venta)
                                    <option value="{{ $venta->id }}"
                                        {{ $checkout->idVenta == $venta->id ? 'selected' : '' }}>
                                        {{ $venta->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Estado</label>
                            <select class="form-select" name="estado" id="estado">
                                <option value="{{ \App\Models\Checkout::Activo }}"
                                    {{ $checkout->estado == \App\Models\Checkout::Activo ? 'selected' : '' }}>Activo
                                </option>
                                <option value="{{ \App\Models\Checkout::Inactivo }}"
                                    {{ $checkout->estado == \App\Models\Checkout::Inactivo ? 'selected' : '' }}>
                                    Inactivo</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</div>


<!-- Modal Delete -->
<div class="modal fade" id="delete{{ $checkout->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar check-out</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('checkouts.destroy', $checkout->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <!--Clave evita error -->
                @method('Delete')
                <div class="modal-body">
                    ¡¿Estas seguro de eliminar el check-out #<strong> {{ $checkout->id }} </strong> de la fecha
                    {{ $checkout->fecSalida }}?!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
