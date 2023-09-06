<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrarse | FunHotel</title>
    <link rel="stylesheet" href="{{ asset('css/style-register.css') }}" />
</head>
<body>
    <div class="container">
        <div class="drop">
            <div class="content">
                <h2>{{ __("Registrarse") }}</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="inputBox">
                        <input id="name" type="text" placeholder="nombre" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="inputBox">
                        <input id="second_name" type="text" placeholder="segundo nombre"
                            class="form-control" name="second_name"
                            value="{{ old('name') }}" autocomplete="name" autofocus />
                        {{-- @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror --}}
                    </div>
                    <div class="inputBox">
                        <input id="surname" type="text" placeholder="apellido"
                            class="form-control @error('surname') is-invalid @enderror" name="surname"
                            value="{{ old('surname') }}" required autocomplete="surname" autofocus />
                        @error('surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="inputBox">
                        <input id="second_surname" type="text" placeholder="segundo apellido"
                            class="form-control" name="second_surname"
                            value="{{ old('second_surname') }}" autocomplete="second_surname" autofocus />
                        {{-- @error('second_surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror --}}
                    </div>
                    <div class="inputBox">
                        <input id="birthday" type="date" placeholder="fecha de nacimiento"
                            class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                            value="{{ old('birthday') }}" required autocomplete="birthday" autofocus />
                        @error('birthday')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="inputBox">
                        <input id="email" type="email" placeholder="correo"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="inputBox">
                        <input id="password" type="password" placeholder="contraseña"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password" />
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="inputBox">
                        <input id="password_confirmation" type="password" placeholder="confirmar contraseña"
                            class="form-control"
                            name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="inputBox">
                        <div class="submit">
                            <input type="submit" value="{{ __('Registrar') }}" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="btns">{{
                __("¿Olvidaste tu contraseña?")
            }}</a>
        @endif
        <a href="{{ route('login') }}" class="btns signup">{{
                __("Ingresar")
            }}</a>
    </div>
</body>

</html>
