@extends('layouts.app')
@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Datos fichas</h6>
            </div>

            @can('group-create')
                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        {{-- <a href="{{ route('groups.create') }}" class="btn btn-primary mb-3">Registrar <i
                                class="bi bi-plus-circle"></i></a> --}}
                        @can('group-create')
                            @include('groups.create')
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                                Registrar <i class="bi bi-plus-circle"></i>
                            </button>
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
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($groups as $group)
                        <div class="card h-100">
                            <div class="card bg-light mb-3" style="max-width: 22rem;">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $group->name }}</h5>
                                </div>
                                <div class="card-body">
                                    <p>Cantidad de usuarios: {{ $group->users()->count() }}</p>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="{{ route('groups.show', $group->id) }}" class="btn btn-primary">Editar ficha</a>
                                        @can('group-edit')
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $group->id }}">
                                                Editar nombre
                                            </button>
                                        @endcan
                                        @can('group-delete')
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalDelete">
                                                Eliminar
                                            </button>

                                            <!-- Modal -->
                                            <!-- Ventana modal de confirmación -->
                                            <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog"
                                                aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteModalLabel" style="color: black">Confirmar
                                                                Eliminación</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p style="color: black">¿Estás seguro de que deseas eliminar este registro?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <!-- Botón de cancelar -->
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancelar</button>
                                                            <!-- Formulario de eliminación -->
                                                            <form method="POST"
                                                                action="{{ route('groups.destroy', $group->id) }}"
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('groups.edit')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
