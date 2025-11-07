@extends('plantilla.plantilla')

@section('contenido')
    <div class="container text-center">
        <h1 class="titlePrometeo">Panel de control del taller</h1>

        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <div class="card bg-white text-light border-secondary shadow">
                    <div class="card-header text-info">
                        {{ __('Repuestos INDEX') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="mb-4 text-black">{{ __('Bienvenido al sistema del taller Prometeo!') }}</p>

                        <!-- Tabla de Repuestos -->
                        <table class="table table-white table-hover table-bordered align-middle table-prometeo">
                            <thead class="table-secondary text-dark">
                                <tr>
                                    <th scope="col">Repuesto</th>
                                    <th scope="col">Fábrica</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Ejemplo de fila temporal --}}
                                <tr>
                                    <td>Motor auxiliar 220V</td>
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
                                {{-- Aquí irán tus Repuestos reales con @foreach --}}
                            </tbody>
                        </table>

                        <a href="{{ route('spareparts.create') }}" class="btn btn-blue mt-3">
                            <i class="bi bi-plus-circle"></i> Añadir repuesto
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
