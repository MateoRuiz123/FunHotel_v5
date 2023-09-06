<!-- Modal -->
<div class="modal fade" id="delete{{ $venta->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('ventas.destroy',$venta->id)}}" method="post" enctype="multipart/form-data">  
                <!--Clave evita error -->
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    ¡¿Estas seguro de eliminar?!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
                    {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>