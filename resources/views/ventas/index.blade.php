@extends('layouts.app')

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h6 class="page-title">Datos Ventas</h6>
        </div>
        <div class="col-md-4">
            <div class="float-end d-none d-md-block">
                <a href="/venta-create" class="btn btn-primary">Registrar <i class="bi bi-plus-circle"></i></a>
            </div>
        </div>
    </div>
</div>
@if (session('mensaje'))
<div class="alert alert-success">
    {{ session('mensaje') }}
</div>
@endif

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha de Venta</th>
                        <th>Cliente</th>
                        <th>Servicio</th>
                        <th>Precio</th>
                        <th>Estado</th> <!-- Nueva columna -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->fecha_venta }}</td>
                        <td>{{ $venta->reserva->cliente->primerNombre}} {{ $venta->reserva->cliente->primerApellido }}</td>
                        <td>{{ $venta->reserva->servicio->nombre }}</td>
                        <td>${{$venta->reserva->servicio->precio}}</td>
                        {{-- <td>{{ $venta->estado_texto }}</td> --}}
                        <td>
                            <!-- Estilo personalizado para el botón de switch -->
                            <label class="switch">
                                <input type="checkbox" id="estado-{{ $venta->id }}"
                                    onchange="cambiarEstado({{ $venta->id }})"
                                    {{ $venta->estado == \App\Models\Venta::Activo ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </td>
                        <td>
                            {{-- <a href="{{ route('ventas.edit', ['venta' => $venta->id]) }}"
                                class="btn btn-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a> --}}

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#delete{{ $venta->id }}">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </td>
                    </tr>
                    @include('ventas.delete')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Estilos personalizados para el botón de switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ff00008e;
        transition: .4s;
        border-radius: 20px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        transform: translateX(20px);
    }

    /* Ajusta los estilos según tus preferencias */
</style>

<script>
    function cambiarEstado(ventaId) {
        const checkbox = document.getElementById(`estado-${ventaId}`);
        const nuevoEstado = checkbox.checked ? 1 : 0;

        // Realizar una petición AJAX para actualizar el estado en el servidor
        fetch(`/ventas/${ventaId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                estado: nuevoEstado
            }),
        })
        .then(response => {
            if (response.ok) {
                // El estado se ha actualizado correctamente
                console.log('Estado actualizado correctamente');
            } else {
                // Hubo un error al actualizar el estado
                console.error('Error al actualizar el estado');
            }
        })
        .catch(error => {
            console.error('Error al procesar la solicitud:', error);
        });
    }
</script>
@endsection
