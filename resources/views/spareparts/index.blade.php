@extends('plantilla.plantilla')
@section('titulo', 'Repuestos')

@section('contenido')
    <div class="container text-center">
        <h1 class="titlePrometeo">Panel de control del taller</h1>

        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <div class="card bg-white text-light border-secondary shadow panel-prometeo">
                    <div class="card-header text-info">
                        {{ __('Repuestos INDEX') }}
                    </div>

                    <div class="card-body">
                        @include('plantilla.messages')

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('spareparts.create') }}" class="btn btn-blue">
                                <i class="bi bi-plus-circle"></i> Añadir repuesto
                            </a>
                        </div>

                        <table class="table table-white table-hover table-bordered align-middle table-prometeo">
                            <thead class="table-secondary text-dark">
                                <tr>
                                    <th class="text-start">Repuesto</th>
                                    <th>Fábrica</th>
                                    <th>Estado</th>
                                    <th style="width: 170px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($spareparts as $spare)
                                    <tr>
                                        <td class="text-start">
                                            <div class="fw-semibold">{{ $spare->name }}</div>
                                        </td>
                                        <td>{{ $spare->factory?->name ?? '-' }}</td>
                                        <td>{{ $spare->state?->name ?? '-' }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                {{-- Editar --}}
                                                <a href="{{ route('spareparts.edit', $spare) }}"
                                                    class="btn btn-outline-success" title="Editar">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                {{-- Eliminar (modal global) --}}
                                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                    data-bs-target="#confirmDelete"
                                                    data-action="{{ route('spareparts.destroy', $spare) }}"
                                                    data-name="{{ $spare->name }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No hay repuestos registrados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end">
                            {{ $spareparts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal global de confirmación --}}
    <div class="modal fade" id="confirmDelete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-prometeo">
                <div class="modal-header">
                    <h1 class="modal-title fs-6">Eliminar <span id="modal-item-name"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-start">
                    ¿Estás seguro de que quieres eliminar <strong id="modal-item-name-strong"></strong>?
                    <br><small class="text-danger">Esta acción no se puede deshacer.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="delete-form" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('[data-bs-target="#confirmDelete"]');
            if (!btn) return;

            const name = btn.getAttribute('data-name') || '';
            const action = btn.getAttribute('data-action') || '';

            const modal = document.getElementById('confirmDelete');
            modal.querySelector('#modal-item-name').textContent = name;
            modal.querySelector('#modal-item-name-strong').textContent = name;
            modal.querySelector('#delete-form').setAttribute('action', action);
        });
    </script>
@endsection
