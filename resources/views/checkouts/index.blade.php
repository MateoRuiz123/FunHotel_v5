@extends('layouts.app')
@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Datos check-out</h6>
            </div>

            <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                    @can('checkout-create')
                        @include('checkouts.create')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">Registrar <i
                                class="bi bi-plus-circle"></i>
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>


    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>

                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Fecha de salida</th>
                            <th>Id Check-in</th>
                            <th>Id Reserva</th>
                            <th>Nro. doc</th>
                            <th>Nombre del cliente</th>
                            <th>Metodo de pago</th>
                            <th>Id Venta</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($checkouts as $checkout)
                            <tr>
                                <td>{{ $checkout->fecSalida }}</td>
                                <td>{{ $checkout->idCheckin }}</td>
                                <td>{{ $checkout->idReserva }}</td>
                                <td>{{ $checkout->cliente->numeroDocumento }}</td>
                                <td>{{ $checkout->cliente->primerNombre }}</td>
                                <td>{{ $checkout->metpago->nombre }}</td>
                                <td>{{ $checkout->idVenta }}</td>
                                <td>{{ $checkout->estado_texto }}</td>
                                <td>
                                    @can('checkout-edit')
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $checkout->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    @endcan
                                    @can('checkout-delete')
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $checkout->id }}">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                            @include('checkouts.info')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
