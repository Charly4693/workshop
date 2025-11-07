@extends('plantilla.plantilla')

@section('contenido')
    <div class="container text-center">
        <h1 class="titlePrometeo">Panel de control del taller</h1>

        <div class="row justify-content-center mt-4">
            <div class="col-md-11">
                <div class="card bg-white text-light border-secondary shadow">
                    <div class="card-header text-info">
                        {{ __('Pedidos INDEX') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="mb-4 text-black">{{ __('Bienvenido al sistema del taller Prometeo!') }}</p>

                        <!-- Tabla de Pedidos -->
                        <table class="table table-white table-hover table-bordered align-middle table-prometeo">
                            <thead class="table-secondary text-dark">
                                <tr>
                                    <th scope="col">Repuesto</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Local</th>
                                    <th scope="col">Máquina</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Ejemplo de fila temporal --}}
                                <tr>
                                    <td>Fuente de alimentación 12V</td>
                                    <td><span class="badge bg-success">Entregado</span></td>
                                    <td>Juan Pérez</td>
                                    <td>Local 3</td>
                                    <td>Ruleta Imperial</td>
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

                                {{-- Aquí irán tus registros reales --}}
                                {{--
                            @foreach ($deliverynotes as $note)
                                <tr>
                                    <td>{{ $note->sparepart->name ?? '-' }}</td>
                                    <td>
                                        @if ($note->status === 'entregado')
                                            <span class="badge bg-success">Entregado</span>
                                        @elseif($note->status === 'pendiente')
                                            <span class="badge bg-warning text-dark">Pendiente</span>
                                        @else
                                            <span class="badge bg-secondary">Desconocido</span>
                                        @endif
                                    </td>
                                    <td>{{ $note->user->name ?? '-' }}</td>
                                    <td>{{ $note->local->name ?? '-' }}</td>
                                    <td>{{ $note->machine->alias ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('deliverynotes.show', $note->id) }}" class="btn btn-info btn-sm me-1">
                                            <i class="bi bi-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('deliverynotes.edit', $note->id) }}" class="btn btn-warning btn-sm me-1">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                        <form action="{{ route('deliverynotes.destroy', $note->id) }}" method="POST" class="d-inline">
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

                        <a href="{{ route('deliverynotes.create') }}" class="btn btn-blue mt-3">
                            <i class="bi bi-plus-circle"></i> Añadir pedido
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
