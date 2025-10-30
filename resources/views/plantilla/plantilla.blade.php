<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- En <head> -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> {{-- Bootstrap global --}}
    <link rel="stylesheet" href="{{ asset('/resources/css/app.css') }}"> {{-- Tu CSS global --}}

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
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark flex-column sidebar d-none d-md-flex"
            style="width: 20%;">
            <div class="container-fluid d-flex flex-column align-items-start overflow-auto hideScroll">
                <div class="sidebar-logo">
                    <a href="/"><img src="{{ asset('img/sin fondo - copia.png') }}" alt="Logo"></a>
                </div>
                <ul class="navbar-nav flex-column w-100" id="sidebarMenu">

                    {{-- Asegúrate de tener $companies y $delegations definidos antes de renderizar este layout
                         (por ejemplo en un Composer View o pasándolos desde el controlador) --}}

                    @if (auth()->user()->hasAnyRole(['Super Admin']))
                        <li class="nav-item w-100">
                            <a class="nav-link" href="#companiasCollapse" data-bs-toggle="collapse"
                                aria-expanded="false" data-bs-target="#companiasCollapse">
                                <i class="bi bi-square-fill"></i> Compañías
                            </a>
                            <div class="collapse" id="companiasCollapse" data-bs-parent="#sidebarMenu">
                                <ul class="navbar-nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('companies.show', 2) }}">
                                            <i class="bi bi-circle-square"></i> Mi Compañía
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('companies.index') }}">
                                            <i class="bi bi-plus-circle"></i> Crear compañia
                                        </a>
                                    </li>
                                    @foreach ($companies as $company)
                                        @if ($company->id !== 2)
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ route('external-licences.show', $company->id) }}">
                                                    <i class="bi bi-circle-square"></i> Licencias {{ $company->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endif

                    <!-- ... resto de tu menú tal cual ... -->

                </ul>
            </div>
        </nav>

        <div class="w-100">
            <div class="container d-flex justify-content-between pb-0">
                <div class="pb-0 text-start">
                    @auth
                        <div>Bienvenido, {{ auth()->user()->name }}</div>
                    @endauth
                </div>
                <div class="pb-0 text-start d-none d-md-block">
                    <form action="{{ route('logout') }}" method="POST" style="d-inline-block">
                        @csrf
                        <button type="submit" class="border-0 text-primary text-decoration-underline">Salir</button>
                    </form>
                </div>
            </div>

            @if (Cache::has('confirmation_required') && Cache::get('confirmation_required'))
                <div class="alert alert-warning d-flex justify-content-between align-items-center">
                    <span>{{ Cache::get('confirmation_message') }}</span>
                    @php
                        $localId = Cache::get('localId');
                        $serialNumber = Cache::get('serialNumber');
                    @endphp
                    @if (!request()->is('confirm-serial-change/*'))
                        <a href="{{ url('/confirm-serial-change' . '/' . $localId . '/' . $serialNumber) }}"
                            class="btn btn-warning">Confirmar</a>
                    @endif
                </div>
            @endif

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
                <a href="{{ route('delegations.index') }}" class="footer-links"><i class="bi bi-house"></i></a>
            </div>
        </div>
    </footer>

    @yield('js')

    <!-- Antes de </body> -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
