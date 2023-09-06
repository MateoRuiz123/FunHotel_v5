<!-- resources/views/groups/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Ficha: {{ $group->name }}</h1>
                <!-- Mostrar información del grupo -->
                <p>Descripción: {{ $group->description ?? 'No hay descripción' }}</p>
                <!--  de acción -->
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                    <button type="button" class="btn btn-success" data-bs-toggle="modal">
                        <a href="/groups" style="text-decoration: none; color:white">Atras</a>
                    </button>
                </div>
            </div>
            <div class="col">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <!-- PRIMERRA COLUMNA -->
            <div class="col">
                <!-- Usuarios del grupo -->
                <br>
                <p>Usuarios:</p>
                @foreach ($group->users as $user)
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item list-group-item-dark">{{ $user->name }} {{ $user->surname }}</li>
                        <li class="list-group-item list-group-item-info">{{ $user->email }}</li>
                    </ul>
                @endforeach
            </div>

            <!-- SEGUNDA COLUMNA -->
            <div class="col">
                <!-- Formulario para asignar rol al grupo -->
                <form class="row g-3" action="{{ route('groups.assignGroupRole', ['group' => $group->id]) }}"
                    method="POST">
                    @csrf
                    <div class="col-md-12">
                        <label for="role_id">Asignar rol a los usuarios:</label>
                        <br>
                        @foreach ($roles as $role)
                            <label>
                                <input type="checkbox" name="role_id[]" value="{{ $role->id }}"
                                    class="form-check-input">
                                {{ $role->name }}
                            </label>
                            <br>
                        @endforeach

                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Asignar roles seleccionados</button>
                    </div>
                </form>

                <br>
                <!-- Formulario para quitar rol del grupo -->
                <form class="row g-3" action="{{ route('groups.revokeGroupRole', ['group' => $group->id]) }}"
                    method="POST">
                    @csrf
                    <div class="col-md-12">
                        <label for="role_id">Eliminar rol a los usuarios:</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="" selected disabled>Seleccionar</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-danger">Eliminar rol seleccionado</button>
                    </div>
                </form>
            </div>

            <!-- TERCERA COLUMNA -->
            <div class="col">
                <form class="row g-3" action="{{ route('groups.addUser', $group->id) }}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <label for="user_id">Seleccionar Usuario</label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="" selected disabled>Seleccionar</option>
                            @foreach ($usersWithoutGroup as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Agregar a la ficha</button>
                    </div>
                </form>

                <br>
                <form class="row g-3"
                    action="{{ route('groups.users.remove', ['group' => $group->id, 'user' => 'USER_ID']) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="col-md-12">
                        <label for="user_id">Seleccionar usuario</label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="" selected disabled>Seleccionar</option>
                            @foreach ($group->users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Esta seguro?')">Eliminar
                            de la ficha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
