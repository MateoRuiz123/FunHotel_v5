<!-- Modal Edit -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function Check() {
        Swal.fire({
            title: 'Confirmación',
            text: '¿Estás seguro de editar el checkins?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Estoy seguro',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#12B901',
            cancelButtonColor: '#E41919'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('CheUpform').submit();
            }
        });
    }
</script>
<div class="modal fade" id="edit{{ $checkin->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar check-in</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <form id="CheUpform" class="row g-3" action="{{ route('checkins.update', $checkin->id) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="" class="form-label">Id Reserva</label>
                            <select name="reserva" id="reserva" class="form-select">
                                <option value="" disabled selected>Seleccione una reserva</option>
                                @foreach ($reservas as $reserva)
                                    <option value="{{ $reserva->id }}"
                                        {{ $checkin->idReserva == $reserva->id ? 'selected' : '' }}>
                                        {{ $reserva->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Estado</label>
                            <select class="form-select" name="estado" id="estado">
                                <option value="{{ \App\Models\Checkin::Activo }}"
                                    {{ $checkin->estado == \App\Models\Checkin::Activo ? 'selected' : '' }}>Activo
                                </option>
                                <option value="{{ \App\Models\Checkin::Inactivo }}"
                                    {{ $checkin->estado == \App\Models\Checkin::Inactivo ? 'selected' : '' }}>Inactivo
                                </option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Editar" onclick="Check()" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </form>
            </div><br>
            {{-- <div class="modal-footer">
                <button type="submit" onclick="Check()" class="btn btn-primary">Editar</button>
            </div> --}}
        </div>
    </div>
</div>


<!-- Modal Delete -->
<div class="modal fade" id="delete{{ $checkin->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar check-in</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('checkins.destroy', $checkin->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <!--Clave evita error -->
                @method('Delete')
                <div class="modal-body">
                    ¡¿Estas seguro de eliminar a <strong> {{ $checkin->id }} ?!</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
