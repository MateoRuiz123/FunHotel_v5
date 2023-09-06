<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <div id="loader" class="loader">
        <i class="fas fa-spinner"></i>
    </div>
    <style>
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.627);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ffffff;
            font-size: 32px;
            opacity: 3;
            transition: opacity 0.5s ease;
        }

        .loader i {
            /* Espacio entre el texto y el icono */
            margin-left: 20px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <script>
        // Script para ocultar el loader con transición al finalizar la carga
        window.addEventListener('load', function() {
            var loader = document.getElementById('loader');
            loader.style.opacity = '5'; // Cambia la opacidad gradualmente a 0
            setTimeout(function() {
                loader.style.display = 'none';
            }, 600); // Espera 0.5 segundos (corresponde a la duración de la transición)
        });
    </script>
</body>

</html>
