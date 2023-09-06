@extends('layouts.app')

@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Datos roles</h6>
            </div>
            @can('role-create')
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        @can('role-create')
                            <a class="btn btn-primary" href="{{ route('roles.create') }}">Registrar <i
                                    class="bi bi-plus-circle"></i></a>
                        @endcan
                    </div>
                </div>
            @endcan
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
                            <th>No. ID</th>
                            <th>Nombre</th>
                            <th>Fecha de creación</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->created_at }}</td>
                                <td>{{ $role->estado_texto }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('roles.show', $role->id) }}"><i
                                            class="bi bi-info-circle"></i></a>
                                    @if ($role->name !== 'Administrador')
                                        @can('role-edit')
                                            <a class="btn btn-warning" href="{{ route('roles.edit', $role->id) }}"><i
                                                    class="bi bi-pencil-square"></i></a>
                                        @endcan
                                    @endif
                                    @if ($role->name !== 'Administrador')
                                        @can('role-delete')
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal{{ $role->id }}">
                                                <i class="bi bi-trash3"></i>
                                            </button>

                                            <!-- Ventana modal de confirmación -->
                                            <div class="modal fade" id="confirmDeleteModal{{ $role->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="confirmDeleteModalLabel{{ $role->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="confirmDeleteModalLabel{{ $role->id }}">Confirmar
                                                                Eliminación</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>¿Estás seguro de que deseas eliminar este registro?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancelar</button>
                                                            <form method="POST"
                                                                action="{{ route('roles.destroy', $role->id) }}"
                                                                style="display:inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
