<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

 <!-- ✅ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">    <title>
        @yield('titulo')
    </title>
    @yield('css') <!-- Aquí se inyectará CSS específico de cada vista -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 <!-- ✅ Bootstrap JS (con Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="{{ asset('img/sin fondo - copia_favicon.png') }}" type="image/x-icon">
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




    @php

        //dd(auth()->check());

        use App\Models\Delegation;
        //$delegations = Delegation::where('id', '<>', 0)->get();
        $delegations = auth()->user()->delegation;

        if ($delegations->isEmpty()) {
            $delegations = Delegation::where('id', '<>', 1)->get();
            //dd($delegations);
        }

        use App\Models\Company;
        //$companies = Company::all();
        $companies = Company::where('id', '>', 2)->get();
    @endphp

    <div class="d-flex">

        <!-- Sidebar -->
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark flex-column sidebar d-none d-md-flex"
            style="width: 20%;">
            <div class="container-fluid d-flex flex-column align-items-start overflow-auto hideScroll">
                <div class="sidebar-logo">
                    <a href="/"><img src="{{ asset('img/sin fondo - copia.png') }}" alt="Logo"></a>
                </div>
                <ul class="navbar-nav flex-column w-100" id="sidebarMenu">



                    @if (auth()->user()->hasAnyRole(['Super Admin']))
                        <!-- Menú para Compañías -->
                        <li class="nav-item w-100">
                            <a class="nav-link" href="#companiasCollapse" data-bs-toggle="collapse"
                                aria-expanded="false" data-bs-target="#companiasCollapse">
                                <i class="bi bi-square-fill"></i> Compañías
                            </a>
                            <div class="collapse" id="companiasCollapse" data-bs-parent="#sidebarMenu">
                                <ul class="navbar-nav flex-column ms-3">
                                    <!-- Apartado para mi compañía -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('companies.show', 2) }}">
                                            <i class="bi bi-circle-square"></i> Mi Compañía
                                        </a>
                                    </li>

                                    <!-- Apartado para compañías externas -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="#externalCompaniesCollapse" data-bs-toggle="collapse"
                                            aria-expanded="false" data-bs-target="#externalCompaniesCollapse">
                                            <i class="bi bi-circle-square"></i> Compañías Externas
                                        </a>
                                        <div class="collapse" id="externalCompaniesCollapse">
                                            <ul class="navbar-nav flex-column ms-3">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('companies.index') }}">
                                                        <i class="bi bi-plus-circle"></i>
                                                        Crear compañia
                                                    </a>
                                                </li>
                                                @foreach ($companies as $company)
                                                    @if ($company->id !== 2)
                                                        <!-- Filtra mi compañía -->
                                                        <li class="nav-item">
                                                            <a class="nav-link"
                                                                href="{{ route('external-licences.show', $company->id) }}">
                                                                <i class="bi bi-circle-square"></i> Licencias
                                                                {{ $company->name }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif




                    <li class="nav-item w-100">
                        <a class="nav-link" href="#valoresMinimosCillapse" data-bs-toggle="collapse"
                            aria-expanded="false" data-bs-target="#valoresMinimosCillapse">
                            <i class="bi bi-square-fill"></i> Resumen de movimientos
                        </a>
                        <div class="collapse" id="valoresMinimosCillapse" data-bs-parent="#sidebarMenu">
                            <ul class="navbar-nav flex-column ms-3">
                                @foreach ($delegations as $delegation)
                                    <a class="nav-link" href="/verMoneys/{{ $delegation->id }}">
                                        <i class="bi bi-circle-square"></i> {{ $delegation->name }}
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    @if (auth()->user()->hasAnyRole(['Super Admin', 'Jefe Delegacion']))
                        <li class="nav-item w-100">
                            <a class="nav-link" href="#advancedSearchCollapse" data-bs-toggle="collapse"
                                aria-expanded="false" data-bs-target="#advancedSearchCollapse">
                                <i class="bi bi-square-fill"></i> Búsqueda avanzada
                            </a>
                            <div class="collapse" id="advancedSearchCollapse" data-bs-parent="#sidebarMenu">
                                <ul class="navbar-nav flex-column ms-3">
                                    @foreach ($delegations as $delegation)
                                        <a class="nav-link" href="/advanced-search/{{ $delegation->id }}">
                                            <i class="bi bi-circle-square"></i> {{ $delegation->name }}
                                        </a>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endif


                    <li class="nav-item w-100">
                        <a class="nav-link" href="#estadoSalonesCollapse" data-bs-toggle="collapse"
                            aria-expanded="false" data-bs-target="#estadoSalonesCollapse">
                            <i class="bi bi-square-fill"></i> Estado de salones 5pm
                        </a>
                        <div class="collapse" id="estadoSalonesCollapse" data-bs-parent="#sidebarMenu">
                            <ul class="navbar-nav flex-column ms-3">
                                @foreach ($delegations as $delegation)
                                    <a class="nav-link" href="/verMoneys5pm/{{ $delegation->id }}">
                                        <i class="bi bi-circle-square"></i> {{ $delegation->name }}
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    @if (!auth()->user()->hasRole('Tecnico'))
                        @if (auth()->user()->hasAnyRole(['Jefe Salones', 'Super Admin', 'Jefe Delegacion']))
                            <li class="nav-item w-100">
                                <a class="nav-link" href="#userTicketServerCollapse" data-bs-toggle="collapse"
                                    aria-expanded="false" data-bs-target="#userTicketServerCollapse">
                                    <i class="bi bi-square-fill"></i> Usuarios y saldos
                                </a>
                                <div class="collapse" id="userTicketServerCollapse" data-bs-parent="#sidebarMenu">
                                    <ul class="navbar-nav flex-column ms-3">
                                        @foreach ($delegations as $delegation)
                                            <a class="nav-link" href="/usersmcdelegation/{{ $delegation->id }}">
                                                <i class="bi bi-circle-square"></i> {{ $delegation->name }}
                                            </a>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if (auth()->user()->hasAnyRole(['Super Admin', 'Jefe Delegacion']))
                            <li class="nav-item w-100">
                                <a class="nav-link" href="#typesTicketServerCollapse" data-bs-toggle="collapse"
                                    aria-expanded="false" data-bs-target="#typesTicketServerCollapse">
                                    <i class="bi bi-square-fill"></i> Tipos de tickets
                                </a>
                                <div class="collapse" id="typesTicketServerCollapse" data-bs-parent="#sidebarMenu">
                                    <ul class="navbar-nav flex-column ms-3">
                                        @foreach ($delegations as $delegation)
                                            <a class="nav-link" href="/showTypesMachines/{{ $delegation->id }}">
                                                <i class="bi bi-circle-square"></i> {{ $delegation->name }}
                                            </a>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>

                           <!-- <li class="nav-item w-100">
                                <a class="nav-link">
                                    <i class="bi bi-square-fill"></i> Usuarios perdidos
                                </a>
                            </li>-->
                        @endif
                        @if (auth()->user()->hasAnyRole(['Oficina', 'Super Admin', 'Jefe Delegacion']))
                            <li class="nav-item w-100">
                                <a class="nav-link" href="#machinesServerCollapse" data-bs-toggle="collapse"
                                    aria-expanded="false" data-bs-target="#machinesServerCollapse">
                                    <i class="bi bi-square-fill"></i> Máquinas
                                </a>
                                <div class="collapse" id="machinesServerCollapse" data-bs-parent="#sidebarMenu">
                                    <ul class="navbar-nav flex-column ms-3">
                                        @foreach ($delegations as $delegation)
                                            <a class="nav-link" href="/machines/index/{{ $delegation->id }}">
                                                <i class="bi bi-circle-square"></i> {{ $delegation->name }}
                                            </a>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth()->user()->hasAnyRole(['Super Admin', 'Jefe Delegacion']))
                            <li class="nav-item w-100">
                                <a class="nav-link" href="#collectionsServerCollapse" data-bs-toggle="collapse"
                                    aria-expanded="false" data-bs-target="#collectionsServerCollapse">
                                    <i class="bi bi-square-fill"></i> Recaudaciones
                                </a>
                                <div class="collapse" id="collectionsServerCollapse" data-bs-parent="#sidebarMenu">
                                    <ul class="navbar-nav flex-column ms-3">
                                        @foreach ($delegations as $delegation)
                                            <a class="nav-link"
                                                href="{{ route('collections.show', $delegation->id) }}">
                                                <i class="bi bi-circle-square"></i> {{ $delegation->name }}
                                            </a>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth()->user()->hasAnyRole([/*'Oficina',*/ 'Super Admin', 'Jefe Delegacion']))
                            <li class="nav-item w-100">
                                <a class="nav-link" href="#clientsServerCollapse" data-bs-toggle="collapse"
                                    aria-expanded="false" data-bs-target="#clientsServerCollapse">
                                    <i class="bi bi-square-fill"></i> Clientes
                                </a>
                                <div class="collapse" id="clientsServerCollapse" data-bs-parent="#sidebarMenu">
                                    <ul class="navbar-nav flex-column ms-3">
                                        @foreach ($delegations as $delegation)
                                            <a class="nav-link" href="/clients/{{ $delegation->id }}">
                                                <i class="bi bi-circle-square"></i> {{ $delegation->name }}
                                            </a>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endif

                    @endif
                </ul>
            </div>
        </nav>
        <div class="w-100">
            <div class="container d-flex justify-content-between pb-0">
                <div class="pb-0 text-start">
                    @auth
                        <div>
                            Bienvenido, {{ auth()->user()->name }}
                        </div>
                    @endauth
                </div>
                <div class="pb-0 text-start d-none d-md-block">
                    <form action="{{ route('logout') }}" method="POST" style="d-inline-block">
                        @csrf
                        <button type="submit" class="border-0 text-primary text-decoration-underline">
                            Salir
                        </button>
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
                        <!-- Verifica que no estés en la vista de confirmación -->
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
                <a href="{{ route('delegations.index') }}" class="footer-links">
                    <i class="bi bi-house"></i>
                </a>
            </div>
        </div>
    </footer>

    @yield('js') <!-- Aquí se inyectará JavaScript específico de cada vista -->

</body>

</html>
