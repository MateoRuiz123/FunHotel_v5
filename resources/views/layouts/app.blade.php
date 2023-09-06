<!--Con bs5 crea toda la estructura con bootstrap, descargando la extensión -->
<!doctype html>
<html lang="en">

<head>
    <title>FunHotel</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/Pequeño.ico') }}">

    <link href="{{ asset('assets/libs/chartist/chartist.min.css') }}" rel="stylesheet">

    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!--     LOADER       -->
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
</head>

<body data-sidebar="dark">
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="/home" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/logo2.png') }}" alt="" height="95"
                                style="margin-left: -37px;">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/LogoF.png') }}" alt="" height="80"
                                style="margin-left: -5px;">
                        </span>
                    </a>
                </div>
                @auth
                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="mdi mdi-menu"></i>
                    </button>
                @endauth
            </div>
            <div class="d-flex">
                <div class="dropdown d-none d-lg-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>
                @guest
                    @if (Route::has('login'))
                        <div class="dropdown d-none d-md-block ms-2">
                            <button type="button" class="btn header-item waves-effect">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </button>
                        </div>
                    @endif
                    @if (Route::has('register'))
                        <div class="dropdown d-none d-md-block ms-2">
                            <button type="button" class="btn header-item waves-effect">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Register') }}</a>
                                {{-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
                            </button>
                        </div>
                    @endif
                @else
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="{{ asset('assets/images/users/user-4.jpg') }}" alt="Header Avatar">
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-account-circle font-size-17 align-middle me-1"></i>
                                {{ Auth::user()->name }}</a>
                            <div class="dropdown-divider"></div>
                            {{-- <a class="dropdown-item text-danger" href="#"
                                onclick="event.preventDefault(); confirmLogout();">
                                <i class="bi bi-power text-danger me-2"></i> {{ __('Logout') }}
                            </a> --}}

                            <button class="dropdown-item text-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmLogoutModal">
                                <i class="bi bi-power text-danger me-2"></i> {{ __('Logout') }}
                            </button>

                            <script>
                                function confirmLogout() {
                                    if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
                                        document.getElementById('logout-form').submit();
                                    }
                                }
                                // Redirigir a /home después de cerrar sesión
                                document.getElementById('logout-form').addEventListener('submit', function(event) {
                                    event.preventDefault();
                                    fetch(this.action, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': this._token.value,
                                        },
                                    }).then(() => {
                                        window.location.href = '/'; // Redirige a la página /home
                                    });
                                });
                            </script>

                        </div>
                    </div>
                @endguest

            </div>
        </div>
    </header>

    @auth
        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">

                        <li>
                            <a href="/home" class="waves-effect">
                                <i class="fa-solid fa-house"></i>
                                <span>Inicio</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span>Ventas</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                @can('venta-list')
                                    <li>
                                        <a href="/ventas" class=" waves-effect">
                                            <span>Ventas</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('cliente-list')
                                    <li>
                                        <a href="/clientes" class=" waves-effect">
                                            <span>Clientes</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('pago-list')
                                    <li>
                                        <a href="/pagos" class=" waves-effect">
                                            <span>Método de pago</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa-solid fa-calendar"></i>
                                <span>Reservas</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                @can('servicio-list')
                                    <li>
                                        <a href="/servicios" class=" waves-effect">
                                            <span>Servicios</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('reserva-list')
                                    <li><a href="/reservas">Reservas</a></li>
                                @endcan
                                @can('categoria-list')
                                    <li>
                                        <a href="/categorias" class=" waves-effect">
                                            <span>Categorías</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('habitacion-list')
                                    <li>
                                        <a href="/habitaciones" class=" waves-effect">
                                            <span>Habitaciones</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('checkin-list')
                                    <li>
                                        <a href="/checkins" class=" waves-effect">
                                            <span>Check-in</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('checkout-list')
                                    <li>
                                        <a href="/checkouts" class=" waves-effect">
                                            <span>Check-Out</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa-solid fa-user-tie"></i>
                                <span>Usuarios</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                @can('user-list')
                                    <li><a href="/users">Usuarios</a></li>
                                @endcan
                                @can('group-list')
                                    <li><a href="/groups">Fichas</a></li>
                                @endcan
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="fa-solid fa-bars"></i>
                                <span>Configuración</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                @can('role-list')
                                    <li><a href="/roles">Roles</a></li>
                                @endcan
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
    @endauth

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <main class="py-4">
                        @include('loader')
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </div>

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Bootstrap JavaScript Libraries -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>


    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>


    <script src="https://kit.fontawesome.com/d7b674392a.js" crossorigin="anonymous"></script>


    <!-- App js loader -->
    <script src="{{ asset('js/loader.js') }}"></script>





    <div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="confirmLogoutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmLogoutModalLabel">Confirmar Cierre de
                        Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas cerrar sesión?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
