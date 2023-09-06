@extends('layouts.app')
@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Datos habitaciones</h6>
            </div>

            <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                    @can('habitacion-create')
                        @include('habitaciones.create')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalCreate">Registrar <i class="bi bi-plus-circle"></i>
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
                            <th>Número</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($habitaciones as $habitacion)
                            @php
                                $estadoClase = '';
                                switch ($habitacion->estado_texto) {
                                    case 'Ocupado':
                                        $estadoClase = 'table-danger'; // Cambia el color a rojo para estado "ocupado"
                                        break;
                                    case 'Mantenimiento':
                                        $estadoClase = 'table-warning'; // Cambia el color a amarillo para estado "mantenimiento"
                                        break;
                                    case 'Disponible':
                                        $estadoClase = 'table-success'; // Cambia el color a verde para estado "disponible"
                                        break;
                                }
                            @endphp

                            <tr class="{{ $estadoClase }}">
                                <td>{{ $habitacion->numeroHabitacion }}</td>
                                <td>{{ $habitacion->descripcion }}</td>
                                <td>{{ $habitacion->categoria->nombre }}</td>
                                <td>{{ $habitacion->estado_texto }}</td>
                                <td>
                                    @can('habitacion-edit')
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalUpdate{{ $habitacion->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    @endcan
                                    @can('habitacion-delete')
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $habitacion->id }}">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                            @include('habitaciones.edit')
                            @include('habitaciones.delete')
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    @push('styles')
        <style>
            .table-success {
                background-color: #dff0d8;
            }

            .table-warning {
                background-color: #fcf8e3;
            }

            .table-danger {
                background-color: #f2dede;
            }
        </style>
    @endpush
@endsection
