@extends('layouts.app')
@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Datos clientes</h6>
            </div>
            <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                    @can('cliente-create')
                        @include('clientes.create')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCre">
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
                            <th>ID</th>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Segundo Nombre</th>
                            <th>Apellido</th>
                            <th>Segundo Apellido</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->numeroDocumento }}</td>
                                <td>{{ $cliente->primerNombre }}</td>
                                <td>{{ $cliente->segundoNombre }}</td>
                                <td>{{ $cliente->primerApellido }}</td>
                                <td>{{ $cliente->segundoApellido }}</td>
                                <td>{{ $cliente->estado_texto }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-ver-mas" data-bs-toggle="modal"
                                        data-bs-target="#VER{{ $cliente->id }}">
                                        <i class="bi bi-search"></i>
                                    </button>
                                    @can('cliente-edit')
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#EDITAR{{ $cliente->id }}">
                                            <i class="bi bi-pencil-square" id="icons"></i>
                                        </button>
                                    @endcan
                                    @can('cliente-delete')
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $cliente->id }}">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    @endcan
                            </tr>
                            @include('clientes.Vermas')
                            @include('clientes.delete')
                            @include('clientes.update')
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
@endsection
