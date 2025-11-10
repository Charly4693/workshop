<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- En <head> -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> {{-- Bootstrap global --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>@yield('titulo')</title>

    @yield('css') <!-- CSS específico de la vista -->

    <!-- Tu CSS propio debe ir DESPUÉS para poder sobreescribir Bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="icon" href="{{ asset('img/prometeo.png') }}" type="image/x-icon">

    <style>
        .sidebar {
            height: 100vh;
            position: sticky;
            top: 0;
        }

        .sidebar-logo {
            text-align: center;
            padding: 1rem 0;
        }

        .sidebar-logo img {
            max-width: 80%;
            height: auto;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark flex-column sidebar d-none d-md-flex">
            <div class="container-fluid d-flex flex-column align-items-start overflow-auto hideScroll">
                <div class="sidebar-logo">
                    <a href="/"><img src="{{ asset('img/prometeo.png') }}" alt="Logo"></a>
                </div>
                <ul class="navbar-nav flex-column w-100" id="sidebarMenu">

                    {{-- Asegúrate de tener $companies y $delegations definidos antes de renderizar este layout
                         (por ejemplo en un Composer View o pasándolos desde el controlador) --}}

                    <li class="nav-item w-100">
                        <a class="nav-link" href="#fabricasCollapse" data-bs-toggle="collapse" aria-expanded="false"
                            data-bs-target="#fabricasCollapse">
                            <i class="bi bi-building"></i> Fabricantes
                        </a>
                        <div class="collapse" id="fabricasCollapse" data-bs-parent="#sidebarMenu">
                            <ul class="navbar-nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('factories.index') }}">
                                        <i class="bi bi-list"></i> Ver Fabricantes
                                    </a>
                                </li>
                                <!--<li class="nav-item">
                                    <a class="nav-link" href="{{ route('factories.create') }}">
                                        <i class="bi bi-plus-circle"></i> Crear Fabricantes
                                    </a>
                                </li>-->
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item w-100">
                        <a class="nav-link" href="#repuestoCollapse" data-bs-toggle="collapse" aria-expanded="false"
                            data-bs-target="#repuestoCollapse">
                            <i class="bi bi-box"></i> Repuestos
                        </a>
                        <div class="collapse" id="repuestoCollapse" data-bs-parent="#sidebarMenu">
                            <ul class="navbar-nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('spareparts.index') }}">
                                        <i class="bi bi-list"></i> Ver repuestos
                                    </a>
                                </li>
                                <!--<li class="nav-item">
                                    <a class="nav-link" href="{{ route('spareparts.create') }}">
                                        <i class="bi bi-plus-circle"></i> Añadir repuesto
                                    </a>
                                </li>-->
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item w-100">
                        <a class="nav-link" href="#pedidosCollapse" data-bs-toggle="collapse" aria-expanded="false"
                            data-bs-target="#pedidosCollapse">
                            <i class="bi bi-basket"></i> Pedidos
                        </a>
                        <div class="collapse" id="pedidosCollapse" data-bs-parent="#sidebarMenu">
                            <ul class="navbar-nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('deliverynotes.index') }}">
                                        <i class="bi bi-list"></i> Ver pedidos
                                    </a>
                                </li>
                                <!--<li class="nav-item">
                                    <a class="nav-link" href="{{ route('deliverynotes.create') }}">
                                        <i class="bi bi-plus-circle"></i> Crear pedido
                                    </a>
                                </li>-->
                            </ul>
                        </div>
                    </li>


                    <!-- ... resto de tu menú tal cual ... -->

                </ul>
            </div>
        </nav>

        <div class="topbar d-flex justify-content-between align-items-center px-4">
            @auth
                <span class="welcome-text">Bienvenido, {{ auth()->user()->name }}</span>
            @endauth
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="logout-btn">Salir</button>
            </form>
        </div>


        @yield('contenido')
    </div>
    </div>

    <footer class="d-md-none fixed-bottom">
        <div class="container-fluid py-3">
            <div class="d-flex justify-content-between">
                <form action="{{ route('logout') }}" method="POST" style="d-inline-block">
                    @csrf
                    <button type="submit" class="border-0 text-primary text-decoration-underline"
                        style="background-color:transparent">
                        <i class="bi bi-box-arrow-left" style="font-size:20pt; color:black"></i>
                    </button>
                </form>
                <a href="" onclick="window.location.reload();" class="footer-links"><i
                        class="bi bi-arrow-clockwise"></i></a>
                <a href="" class="footer-links"><i class="bi bi-house"></i></a>
            </div>
        </div>
    </footer>



    <!-- JS al final -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Scripts específicos de cada vista --}}
    @yield('js')

    {{-- Pila de scripts (si usas @push('scripts')) --}}
    @stack('scripts')

</body>

</html>
