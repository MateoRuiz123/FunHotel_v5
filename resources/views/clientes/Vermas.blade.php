<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="modal fade" id="VER{{ $cliente->id }}" tabindex="-1" role="dialog"
        aria-labelledby="VermasLabel{{ $cliente->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="bi bi-search"></i>
                    <h5 class="modal-title" id="VermasLabel{{ $cliente->id }}"
                        style="font-family: Arial, Helvetica, sans-serif;">Datos de {{ $cliente->primerNombre }}
                        {{ $cliente->primerApellido }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item"> Id: {{ $cliente->id }}</li>
                    <li class="list-group-item"> Nombre: {{ $cliente->primerNombre }}</li>
                    <li class="list-group-item"> Segundo nombre: {{ $cliente->segundoNombre }}</li>
                    <li class="list-group-item"> Apellido: {{ $cliente->primerApellido }}</li>
                    <li class="list-group-item"> Segundo apellido: {{ $cliente->segundoApellido }}</li>
                    <li class="list-group-item"> Tipo documento: {{ $cliente->documento }}</li>
                    <li class="list-group-item"> Documento: {{ $cliente->numeroDocumento }}</li>
                    <li class="list-group-item"> Celular: {{ $cliente->celular }}</li>
                    <li class="list-group-item"> Correo: {{ $cliente->correo }}</li>
                </ol>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
