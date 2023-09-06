@extends('layouts.app')
@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Datos usuarios</h6>
            </div>

            <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                    @can('user-create')
                        <a class="btn btn-primary" href="{{ route('users.create') }}">Registrar <i
                                class="bi bi-plus-circle"></i></a>
                        {{-- <a class="btn btn-primary" href="{{ route('users.assign-roles') }}">Asignar Roles <i
                                class="bi bi-plus-circle"></i></a> --}}
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
                            <th>No</th>
                            <th>Número de documento</th>
                            <th>Nombre</th>
                            <th>Segundo nombre</th>
                            <th>Apellido</th>
                            <th>Segundo apellido</th>
                            <th>Fecha de nacimiento</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{$user->tipoDocumento}} - {{$user->numeroDocumento}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->second_name }}</td>
                                <td>{{ $user->surname }}</td>
                                <td>{{ $user->second_surname }}</td>
                                <td>{{ $user->birthday }}</td>
                                <td>{{ $user->email }}</td>
                                <th>{{ $user->estado_texto }}</th>
                                <td>
                                    @if ($user->roles->count() > 0)
                                        @foreach ($user->roles as $role)
                                            <span class="badge rounded-pill bg-dark">{{ $role->name }}</span>
                                            {{-- <span class="badge rounded-pill bg-primary">{{ $role->id }}</span> --}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @can('user-edit')
                                        <a class="btn btn-warning" href="{{ route('users.edit', $user->id) }}"><i
                                                class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('user-delete')
                                        <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                            style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
