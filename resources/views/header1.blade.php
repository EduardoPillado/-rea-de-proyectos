<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/estilo.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a href="{{route('welcome')}}"><img src="img/sitehasa_isotipo.jpeg" width="70px"></a>
          <a class="navbar-brand" href="{{route('welcome')}}">&nbsp Inicio</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

              <li class="navbar-brand dropdown">
                <a class="navbar-brand dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Proyectos
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                  <li><a class="dropdown-item" href="{{route('agregarProyectos')}}">Agregar proyecto</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{route('proyectos')}}">Proyectos</a></li>
                  {{-- <li><a class="dropdown-item" href="{{route('proyectosActivados')}}">Proyectos activos</a></li>
                  <li><a class="dropdown-item" href="{{route('proyectosBloqueados')}}">Proyectos bloqueados</a></li> --}}
                </ul>
              </li>

              <li class="navbar-brand dropdown">
                <a class="navbar-brand dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Clientes
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                  <li><a class="dropdown-item" href="{{route('agregarClientes')}}">Agregar cliente</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{route('clientesRegistrados')}}">Clientes registrados</a></li>
                </ul>
              </li>

              <li class="navbar-brand dropdown">
                <a class="navbar-brand dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Productos
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                  <li><a class="dropdown-item" href="{{route('agregarProductos')}}">Agregar producto</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{route('productosExistentes')}}">Productos existentes</a></li>
                </ul>
              </li>

              <li class="navbar-brand dropdown">
                <a class="navbar-brand dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Metodos de pago
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                  <li><a class="dropdown-item" href="{{route('agregarMetodoDePago')}}">Agregar metodo de pago</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{route('metodosDePagoExistentes')}}">Metodos de pago existentes</a></li>
                </ul>
              </li>

            </ul>
          </div>
        </div>
      </nav>
</body>
</html>