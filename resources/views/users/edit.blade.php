@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function Usve() {
            Swal.fire({
                title: 'Confirmación',
                text: '¿Estás seguro de editar el usuario?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Estoy seguro',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#12B901',
                cancelButtonColor: '#E41919'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('usuarioForm').submit();
                }
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar usuario {{ $user->name }}</h2>
=======
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function Usve() {
                Swal.fire({
                    title: 'Confirmación',
                    text: '¿Estás seguro de editar el usuario?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Estoy seguro',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#12B901',
                    cancelButtonColor: '#E41919'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('usuarioForm').submit();
                    }
                });
            }
        </script>
    </head>

    <body>
        <div class="container">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Editar usuario {{ $user->name }}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('users.index') }}">Volver</a>
                </div>
            </div>
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>¡Ups!</strong> Hubo algunos problemas con tus datos de entrada.
                <br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <br>
        <div class="container">
            <form id="usuarioForm" method="POST" action="{{ route('users.update', $user->id) }}" class="row g-3">
                @method('PATCH')
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        <input type="text" name="name" placeholder="Nombre" class="form-control"
                            value="{{ $user->name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Segundo Nombre:</strong>
                        <input type="text" name="second_name" placeholder="Segundo Nombre"
                            class="form-control"value="{{ $user->second_name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Apellido:</strong>
                        <input type="text" name="surname" placeholder="Apellido" class="form-control"
                            value="{{ $user->surname }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Segundo Apellido:</strong>
                        <input type="text" name="second_surname" placeholder="Segundo Apellido"
                            class="form-control"value="{{ $user->second_surname }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Fecha de nacimiento:</strong>
                        <input type="date" name="birthday" placeholder="Fecha de nacimiento" class="form-control"
                            value="{{ $user->birthday }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Email:</strong>
                        <input type="text" name="email" placeholder="Email"
                            class="form-control"value="{{ $user->email }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Tipo de documento</strong>
                        <select id="tipoDocumento" name="tipoDocumento" class="form-control" required>
                            <option selected value="{{ $user->tipoDocumento }}">
                                {{ $user->tipoDocumento }}</option>
                            <option value="Cedula">Cedula</option>
                            <option value="Pasaporte">Pasaporte</option>
                            <option value="Cedula de extranjeria">Cedula de extranjeria</option>
                            <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                            <option value="Registro civil">Registro civil</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Número de documento:</strong>
                        <input type="text" name="numeroDocumento" placeholder="Número de documento"
                            class="form-control"value="{{ $user->numeroDocumento }}">

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Contraseña:</strong>
                        <input type="password" name="password" placeholder="Contraseña" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Confirmar Contraseña:</strong>
                        <input type="password" name="confirm-password" placeholder="Confirmar Contraseña"
                            class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Rol:</strong>
                        {{-- {!! Form::select('roles[]', $roles, $userRoles, ['class' => 'form-control']) !!} --}}
                        <select name="roles[]" class="form-control" multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ in_array($role->id, $userRoles) ? 'selected' : '' }}>
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-md-6">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" name="estado" id="estado">
                        <option value="{{ \App\Models\User::Activo }}"
                            {{ $user->estado == \App\Models\User::Activo ? 'selected' : '' }}>Activo</option>
                        <option value="{{ \App\Models\User::Inactivo }}"
                            {{ $user->estado == \App\Models\User::Inactivo ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </form>
            <div class="col-md-12">
                <button type="submit" onclick="Usve()" class="btn btn-primary">Actualizar</button>
            </div>

          </form><br>
            <div class="col-md-12">
                <button type="submit" onclick="Usve()" class="btn btn-primary">Actualizar</button>
                <a class="btn btn-light" href="{{ route('users.index') }}">Volver</a>
            </div>
    </div>
@endsection
        </div>
    @endsection

</body>

</html>
