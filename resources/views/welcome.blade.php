<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FunHotel</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/Pequeño.ico') }}">
    <link rel="stylesheet" href="{{asset('css/land.css')}}">
    <script src="{{asset('js/land.js')}}"></script>
</head>
<header>
  <nav>
      <ul class="nav nav-tabs">
        <li>FunHotel</li>
      </ul>
    </nav>
  </header>
    <section id="inicio">
      <div class="hero">     
        <h1 class="animate-letters">Bienvenidos a <br>FunHotel</h1>
        <a href="/home" class="btn">Iniciar sesión</a>
      </div>
    </section>
    <div class="titulo">
      <h2 class="">Como surgió <br> Funhotel </h2>
    </div>
      <div class="texto">
          <p>Funhotel surge de la necesidad que se presentaba con los estudiantes de Hoteleria Y Turismo, de contar con una herramienta
            eficiente y accesible, ante la falta de recursos que pudieran completar su formación, un grupo de entusiastas estudiantes, decidieron
            emprender un emocionante proyecto.
            Asi nacio FunHotel, un innovador aplicativo, creado con la misión de optimizar y facilitar el proceso de aprendizaje para 
            los estudiantes de Hoteleria Y Turismo.
          </p>
        </div></div>
        <div class="container-card">
          <div class="card">
            <figure>
              <center><img src="{{ asset('img/mision.png') }}" class="mision" alt="" /></center>
            </figure>
            <div class="contenido-card">
              <h3>Misión</h3>
              <p>Nos esforzamos por ser un referente en la industria hotelera, ofreciendo un 
                      servicio excepcionales y experiencias inigualables.</p>
            </div>
          </div>
          <div class="card">
            <figure>
              <center><img src="{{ asset('img/Vision.png') }}" class="" alt="" /></center>
            </figure>
            <div class="contenido-card">
              <h3>Visión</h3>
              <p>Trabajamos para ser un referente en la industria hotelera, destacándonos por nuestra excelencia 
                      en la calidad y la innovación.</p>
            </div>
          </div>
          <div class="card">
            <figure>
              <center><img src="{{ asset('img/Movil3.png') }}" class="" alt="" /></center>
            </figure>
            <div class="contenido-card">
              <h3>Móvil</h3>
              <p>FunHotel cuenta con un apartado móvil, diseñado para la comodidad y facilidad a la mano
                de nuestros clientes.
              </p>
            </div>
           </div>
         </div> 
      <div class="logoland">
        <img src="{{ asset('img/Hotel.png') }}" class="animate-letters" alt="" />
    </div>
    <footer>
      <p>&copy; 2023 FunHotel. Elevando el arte de la hospitalidad con innovación y pasión. Todos los derechos reservados.</p>
    </footer>
</body>
</html>