<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - FunHotel</title>
    <link rel="stylesheet" href="{{ asset('estilo.css') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/images/Pequeño.ico') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4a2c91;
            color: #ffffff;
            border: none;
            border-radius: 50px;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            border: 3.10px solid #d8d8d8c5;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            /* Para ocultar el desbordamiento del icono */
        }

        .back-button::before {
            content: '\2190';
            /* Código Unicode para la flecha izquierda */
            display: inline-block;
            margin-right: 2px;
            font-size: 27px;
            vertical-align: middle;
        }

        .back-button:hover {
            background-color: #614bf1;
            transform: scale(1.05);
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
    <script>
        function goBack() {
            window.history.back();
        }

        function showHide(elementId, verId) {
            var password = document.getElementById(elementId);
            var verPassword = document.getElementById(verId);

            if (password.type === "password") {
                password.type = "text";
                verPassword.classList.add("hide");
            } else {
                password.type = "password";
                verPassword.classList.remove("hide");
            }
        }
    </script>
</head>
<body>
    
    <main>
        @if (session('success'))
            alert('{{ session('success') }}');
        @endif
        <div class="box">
            <button onclick="goBack()" class="back-button"></button>
            <div class="inner-box-ingresar">
                <div class="forms-wrap">
                    <form action="{{ route('login') }}" autocomplete="off" class="sign-in-form" method="POST">
                        @csrf
                        <div class="heading"><br><br>
                            <h2>{{ __('Bienvenidos') }}</h2><br>
                        </div><br>
                        <div class="actual-form">
                            <div class="input-wrap">
                                <input name="email" type="email" minlength="4"
                                    class="@error('email') is-invalid @enderror input-field" autocomplete="email"
                                    autofocus required />
                                <label>{{ __('Correo Electronico') }}</label>
                                @error('email')
                                <div class="invalid-feedback" style="font-size: 12px;  color: rgb(230, 0, 0); padding-top: 27px;">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            <div class="input-wrap">
                                <div id="ver" onclick="showHide('password', 'ver');"></div>
                                <input id="password" name="password" autocomplete="current-password" type="password"
                                    minlength="4" class="@error('password') is-invalid @enderror input-field"
                                    autocomplete="off" required onpaste="return false" />
                                <label>{{ __('Contraseña') }}</label>
                                @error('password')
                                <div class="invalid-feedback" style="font-size: 12px;  color: rgb(230, 0, 0); padding-top: 31px;">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            <input type="submit" value="{{ __('Login') }}" class="sign-btn" />
                            <p class="text">
                                {{ __('¿Olvidaste tus datos de inicio de sesión?') }}
                                <a href="{{ route('password.request') }}">{{ __('Recuperar contraseña') }}</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="carousel">
                <div class="images-wrapper">
                    <img src="{{ asset('img/Hotel.png') }}" class="image img-1 show" alt="" />
                    <img src="{{ asset('img/tercero.png') }}" class="image img-2" alt="" />
                    <img src="{{ asset('img/logoHotl.png') }}" class="image img-3" alt="" />
                </div>
                <div class="text-slider">
                    <div class="text-wrap">
                        <div class="text-group">
                            <h2>{{ __('Bienvenidos a FunHotel') }}</h2>
                            <h2>{{ __('¡Te ofrecemos diversión y calidad!') }}</h2>
                            <h2>{{ __('Reserva con nosotros') }}</h2>
                        </div>
                    </div>
                    <div class="bullets">
                        <span class="active" data-value="1"></span>
                        <span data-value="2"></span>
                        <span data-value="3"></span>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('estilo.js') }}"></script>
</body>
</html>

{{-- En el código proporcionado, he agregado el atributo `onpaste="return false"` a los campos de contraseña en ambos formularios (inicio de sesión y registro). Esto evitará que los usuarios puedan pegar contenido en esos campos. Sin embargo, es importante tener en cuenta que esto no proporciona una seguridad completa, ya que los usuarios aún pueden ingresar manualmente los datos. Es recomendable implementar medidas adicionales, como validación en el lado del servidor y el uso de técnicas como cifrado de contraseñas para garantizar una mayor seguridad en el manejo de contraseñas. --}}
