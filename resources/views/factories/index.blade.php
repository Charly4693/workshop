@extends('plantilla.plantilla')

@section('contenido')
    <div class="container text-center">
        <h1 class="titlePrometeo">Panel de control del taller</h1>

        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <div class="card bg-white text-light border-secondary shadow">
                    <div class="card-header text-info">
                        {{ __('Fabricante INDEX') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="mb-4 text-black">{{ __('Bienvenido al sistema del taller Prometeo!') }}</p>

                        <!-- Tabla de Fabricante -->
                        <table class="table table-white table-hover table-bordered align-middle table-prometeo">
                            <thead class="table-secondary text-dark">
                                <tr>
                                    <th scope="col">Fábrica</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Ejemplo temporal --}}
                                <tr>
                                    <td>Fábrica Central</td>
                                    <td>
                                        <a href="#" class="btn btn-blue btn-sm me-1">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-success btn-sm me-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="#" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Aquí podrás recorrer tus Fabricante reales --}}
                                {{--
                            @foreach ($factories as $factory)
                                <tr>
                                    <td>{{ $factory->name }}</td>
                                    <td>
                                        <a href="{{ route('factories.show', $factory->id) }}" class="btn btn-info btn-sm me-1">
                                            <i class="bi bi-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('factories.edit', $factory->id) }}" class="btn btn-warning btn-sm me-1">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                        <form action="{{ route('factories.destroy', $factory->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Borrar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            --}}
                            </tbody>
                        </table>

                        <!-- Botón de añadir -->
                        <a href="{{ route('factories.create') }}" class="btn btn-blue mt-3">
                            <i class="bi bi-plus-circle"></i> Añadir fábrica
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
