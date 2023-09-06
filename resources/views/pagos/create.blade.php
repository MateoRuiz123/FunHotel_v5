<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function pagos() {
        var nombre1 = $('#nombre1').val().trim();

        if (nombre1 === '' ) {
            Swal.fire({
                title: 'Campo vacío',
                text: 'Por favor, completa el campo antes de continuar.',
                icon: 'error',
                confirmButtonColor: '#d33'
            });
        } else {
            Swal.fire({
                title: 'Confirmación',
                text: '¿Estás seguro de crear este método?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Estoy seguro',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#12B901',
                cancelButtonColor: '#E41919'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('Pagoform').submit();
                }
            });
        }
    }
</script>
 <script>
    $(document).ready(function() {
        function validarFormulario() {
            var nombre = $('#nombre1').val().trim();

            if (
                nombre === '' 
            ) {
                return false;
            }

            return true;
        }

        $('#nombre1').on('input', function() {
            var nombre = $(this).val();

            if (nombre.trim() === '') {
                $('#nombrePError').text('El método de pago es requerido');
            } else {
                $('#nombrePError').text('');
            }
        });
    
        $('#submitButton').on('click', function(event) {
            if (!validarFormulario()) {
                event.preventDefault();
            }
        });
    });
</script>
</head>
<body>
  <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Método de pago</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div><br>
        <div class="modal-body">
          <form id="Pagoform" class="row g-3" action="{{route('pagos.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-8">
              <label for="" class="form-label"> Nombre Método de pago</label>
              <input type="text" class="form-control" name="nombre" id="nombre1" aria-describedby="helpId">
              <span id="nombrePError" class="text-danger"></span>
            </div>
            <div>
              <input type="hidden" name="estado" id="estado" value="{{\app\models\pago::Activo}}">
            </div>
          </form>
        </div><br>
        <div class="modal-footer"><br><br>
          <button type="submit" onclick="pagos()" class="btn btn-primary">Agregar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
