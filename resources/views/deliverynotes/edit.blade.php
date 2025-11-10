@extends('plantilla.plantilla')
@section('titulo', 'Editar pedido')

@section('css')
<link rel="stylesheet" href="{{ asset('css/factoriesCreate.css') }}">
@endsection

@section('contenido')
<div class="container mt-5">
    <div class="col-10 col-lg-8 offset-1 offset-lg-2">
        <div class="card panel-prometeo shadow">
            <div class="card-header text-info">
                {{ __('Editar pedido') }}
            </div>

            <div class="card-body">
                @include('plantilla.messages')

                <form id="edit-deliverynote-form" action="{{ route('deliverynotes.update', $deliverynote) }}" method="POST" class="form-prometeo">
                    @csrf
                    @method('PUT')

                    {{-- Repuesto --}}
                    <div class="form-floating mb-3">
                        <select name="spare_part_id" id="sparepartSelect" class="form-select">
                            <option value="">Selecciona un repuesto</option>
                            @foreach($spareparts as $part)
                                <option value="{{ $part->id }}" @selected(old('spare_part_id', $deliverynote->spare_part_id) == $part->id)>
                                    {{ $part->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="sparepartSelect">Repuesto</label>
                        @error('spare_part_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Estado --}}
                    <div class="form-floating mb-3">
                        <select name="state_id" id="stateSelect" class="form-select">
                            <option value="">Selecciona un estado</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}" @selected(old('state_id', $deliverynote->state_id) == $state->id)>
                                    {{ $state->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="stateSelect">Estado</label>
                        @error('state_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Local --}}
                    <div class="form-floating mb-3">
                        <select name="local_id" id="localSelect" class="form-select">
                            <option value="">Selecciona un local</option>
                            @foreach($locals as $local)
                                <option value="{{ $local->id }}" @selected(old('local_id', $deliverynote->local_id) == $local->id)>
                                    {{ $local->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="localSelect">Local</label>
                        @error('local_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Bar --}}
                    <div class="form-floating mb-3">
                        <select name="bar_id" id="barSelect" class="form-select">
                            <option value="">Selecciona un bar</option>
                            @foreach($bars as $bar)
                                <option value="{{ $bar->id }}" @selected(old('bar_id', $deliverynote->bar_id) == $bar->id)>
                                    {{ $bar->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="barSelect">Bar</label>
                        @error('bar_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Máquina --}}
                    <div class="form-floating mb-3">
                        <select name="machine_id" id="machineSelect" class="form-select">
                            <option value="">Selecciona una máquina</option>
                            @foreach($machines as $machine)
                                <option value="{{ $machine->id }}" @selected(old('machine_id', $deliverynote->machine_id) == $machine->id)>
                                    {{ $machine->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="machineSelect">Máquina</label>
                        @error('machine_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Usuario --}}
                    <div class="form-floating mb-3">
                        <select name="user_id" id="userSelect" class="form-select">
                            <option value="">Selecciona un usuario</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @selected(old('user_id', $deliverynote->user_id) == $user->id)>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="userSelect">Usuario</label>
                        @error('user_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Comentario --}}
                    <div class="form-floating mb-4">
                        <textarea name="comment" class="form-control" id="commentInput" style="height: 100px" placeholder="Comentario">{{ old('comment', $deliverynote->comment) }}</textarea>
                        <label for="commentInput">Comentario</label>
                        @error('comment') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('deliverynotes.index') }}" class="btn btn-outline-blue">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save2"></i> Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
