@extends('home')
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Datos reservas</h6>
            </div>
            <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                    @can('reserva-create')
                        @include('reservas.create')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                            Registrar <i class="bi bi-plus-circle"></i>
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
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
                            <th>Id</th>
                            <th>Nro Habitacion</th>
                            <th>Nro. doc cliente</th>
                            <th>Nombre cliente</th>
                            <th>Servicio</th>
                            <th>Precio del servicio</th>
                            <Th>De:</Th>
                            <Th>Hasta:</Th>
                            <th>Creacion de reserva</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservas as $reserva)
                            <tr>
                                <td>{{ $reserva->id }}</td>
                                <td>{{ $reserva->habitacion->numeroHabitacion }}</td>
                                <td>{{ $reserva->cliente->numeroDocumento }}</td>
                                <td>{{ $reserva->cliente->primerNombre }} {{ $reserva->cliente->primerApellido }} </td>
                                <td>{{ $reserva->servicio->nombre }}</td>
                                <td>$ {{ $reserva->servicio->precio }}</td>
                                <td>{{ $reserva->fecIngreso }}</td>
                                <td>{{ $reserva->fecSalida }}</td>
                                <td>{{ $reserva->created_at }}</td>
                                <td>{{ $reserva->estado_texto }}</td>
                                <td>
                                    @can('reserva-edit')
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $reserva->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    @endcan
                                    @can('reserva-delete')
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $reserva->id }}">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                            @include('reservas.info')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection
