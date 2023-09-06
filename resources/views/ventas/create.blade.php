@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Venta</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function Ventaconfir() {
    var idReserva = $('#idReserva').val();

    if (!idReserva) {
        Swal.fire({
            title: 'Campos vacíos',
            text: 'Por favor, selecciona una reserva antes de continuar.',
            icon: 'error',
            confirmButtonColor: '#d33'
        });
    } else {
        Swal.fire({
            title: 'Confirmación',
            text: '¿Estás seguro de crear la venta?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Estoy seguro',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#12B901',
            cancelButtonColor: '#E41919'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('Ventaform').submit();
            }
        });
    }
}
</script>

    <script>
        $(document).ready(function() {
            // Cuando se seleccione una reserva
            $('select[name="idReserva"]').on('change', function() {
                var idReserva = $(this).val();

                // Realizar la solicitud AJAX
                $.ajax({
                    url: '/ventas-obtener-informacion-reserva/' + idReserva,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Actualizar el campo de cliente con el ID del cliente
                        $('#cliente').val(response.cliente.primerNombre);

                        // Actualizar el campo de servicio con el nombre del servicio
                        $('#servicio').val(response.servicio.nombre);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title fs-5">Crear Venta</h1>
            <form id="Ventaform" class="needs-validation" method="POST" action="{{ route('ventas.store') }}"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="idReserva">Reserva<span class="required-field" style="color: red; font-size: 16px;">*</span></label>
                        <select name="idReserva" id="idReserva" class="form-control">
                            <option selected disabled>Seleccione</option>
                            @foreach ($reservas as $reserva)
                                <option value="{{ $reserva->id }}">{{ $reserva->id }}</option>
                            @endforeach
                        </select>
                        <span id="reservaError" class="text-danger"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="cliente" class="form-label">Cliente</label>
                        <input type="text" class="form-control" name="cliente" id="cliente" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="servicio" class="form-label">Servicio</label>
                        <input type="text" class="form-control" name="servicio" id="servicio" readonly>
                    </div>
                    <div class="col-md-6">
                        <!-- input hidden donde el valor es un datatime de la fecha y hora actual -->
                        <input type="hidden" name="fecha_venta" id="fecha_venta" value="">
                    </div>
                </div>
            </form>
            <br>
            <div class="col-md-12" style="text-align: right;">
                <button type="submit" class="btn btn-primary" onclick="Ventaconfir()">Crear <i
                        class="bi bi-plus-circle"></i></button>
                <a class="btn btn-light" href="{{ route('ventas.index') }}">Volver</a>
            </div>
        </div>
    </div>
</div>
<script>
    // Obtener el elemento del campo de fecha y hora actual
    var createdAtField = document.getElementById('fecha_venta');
    // Obtener la fecha y hora actual
    var currentDate = new Date();
    // Formatear la fecha y hora actual en el formato deseado (YYYY-MM-DD HH:MM:SS)
    var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');
    // Asignar el valor de la fecha y hora actual al campo oculto
    createdAtField.value = formattedDate;
</script>
</body>
</html>

@endsection
