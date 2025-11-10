@extends('plantilla.plantilla')
@section('titulo', 'Albaranes')

@section('css')
<link rel="stylesheet" href="{{ asset('css/factoriesCreate.css') }}">
@endsection

@section('contenido')
<div class="container mt-5">
    <div class="col-10 col-lg-8 offset-1 offset-lg-2">
        <div class="card panel-prometeo shadow">
            <div class="card-header text-info">
                {{ __('Crear pedido') }}
            </div>

            <div class="card-body">
                @include('plantilla.messages')

                <form id="create-deliverynote-form" action="{{ route('deliverynotes.store') }}" method="POST" class="form-prometeo">
                    @csrf

                    {{-- Repuesto --}}
                    <div class="form-floating mb-3">
                        <select name="spare_part_id" id="sparepartSelect" class="form-select">
                            <option value="" selected disabled>Selecciona un repuesto</option>
                            @foreach($spareparts as $part)
                                <option value="{{ $part->id }}" {{ old('spare_part_id') == $part->id ? 'selected' : '' }}>
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
                            <option value="" selected disabled>Selecciona un estado</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>
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
                            <option value="" selected disabled>Selecciona un local</option>
                            @foreach($locals as $local)
                                <option value="{{ $local->id }}" {{ old('local_id') == $local->id ? 'selected' : '' }}>
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
                            <option value="" selected disabled>Selecciona un bar</option>
                            @foreach($bars as $bar)
                                <option value="{{ $bar->id }}" {{ old('bar_id') == $bar->id ? 'selected' : '' }}>
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
                            <option value="" selected disabled>Selecciona una máquina</option>
                            @foreach($machines as $machine)
                                <option value="{{ $machine->id }}" {{ old('machine_id') == $machine->id ? 'selected' : '' }}>
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
                            <option value="" selected disabled>Selecciona un usuario</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="userSelect">Usuario</label>
                        @error('user_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Comentario --}}
                    <div class="form-floating mb-4">
                        <textarea name="comment" class="form-control" id="commentInput" style="height: 100px" placeholder="Comentario">{{ old('comment') }}</textarea>
                        <label for="commentInput">Comentario</label>
                        @error('comment') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Acciones --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('deliverynotes.index') }}" class="btn btn-outline-blue">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                        <button type="submit" class="btn btn-blue">
                            <i class="bi bi-check2-circle"></i> Crear
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
