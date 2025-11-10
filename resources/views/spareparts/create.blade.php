@extends('plantilla.plantilla')
@section('titulo', 'Crear repuesto')

@section('contenido')
    <div class="container mt-5">
        <div class="col-10 col-lg-8 offset-1 offset-lg-2">
            <div class="card panel-prometeo shadow">
                <div class="card-header text-info">
                    {{ __('Crear repuesto') }}
                </div>

                <div class="card-body">
                    @include('plantilla.messages')

                    <form action="{{ route('spareparts.store') }}" method="POST" class="form-prometeo">
                        @csrf

                        {{-- Nombre --}}
                        <div class="form-floating mb-3">
                            <input value="{{ old('name') }}" type="text" name="name" class="form-control"
                                id="nameInput" placeholder="Nombre del repuesto">
                            <label for="nameInput">Nombre</label>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Fábrica --}}
                        <div class="form-floating mb-3">
                            <select name="factory_id" id="factorySelect" class="form-select">
                                <option value="">-- Selecciona una fábrica --</option>
                                @foreach ($factories as $f)
                                    <option value="{{ $f->id }}" @selected(old('factory_id') == $f->id)>{{ $f->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="factorySelect">Fábrica</label>
                            @error('factory_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Estado --}}
                        <div class="form-floating mb-4">
                            <select name="state_id" id="stateSelect" class="form-select">
                                <option value="">-- Sin estado --</option>
                                @foreach ($states as $s)
                                    <option value="{{ $s->id }}" @selected(old('state_id') == $s->id)>{{ $s->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="stateSelect">Estado</label>
                            @error('state_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('spareparts.index') }}" class="btn btn-outline-blue">
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
