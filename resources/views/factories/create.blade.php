@extends('plantilla.plantilla')
@section('titulo', 'Crear fábrica')

@section('contenido')
<div class="container mt-5">
    <div class="col-10 col-lg-8 offset-1 offset-lg-2">
        <div class="card panel-prometeo shadow">
            <div class="card-header text-info">
                {{ __('Crear fabricante') }}
            </div>

            <div class="card-body">
                @include('plantilla.messages')

                <form action="{{ route('factories.store') }}" method="POST" class="form-prometeo">
                    @csrf

                    {{-- Nombre --}}
                    <div class="form-floating mb-3">
                        <input value="{{ old('name') }}" type="text" name="name" class="form-control" id="nameInput" placeholder="Nombre">
                        <label for="nameInput">Nombre</label>
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Dirección --}}
                    <div class="form-floating mb-3">
                        <input value="{{ old('address') }}" type="text" name="address" class="form-control" id="addressInput" placeholder="Dirección">
                        <label for="addressInput">Dirección</label>
                        @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Ciudad --}}
                    <div class="form-floating mb-3">
                        <input value="{{ old('city') }}" type="text" name="city" class="form-control" id="cityInput" placeholder="Ciudad">
                        <label for="cityInput">Ciudad</label>
                        @error('city') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Teléfono --}}
                    <div class="form-floating mb-3">
                        <input value="{{ old('phone') }}" type="text" name="phone" class="form-control" id="phoneInput" placeholder="Teléfono">
                        <label for="phoneInput">Teléfono</label>
                        @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-floating mb-3">
                        <input value="{{ old('email') }}" type="email" name="email" class="form-control" id="emailInput" placeholder="Email">
                        <label for="emailInput">Email</label>
                        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- CIF --}}
                    <div class="form-floating mb-4">
                        <input value="{{ old('cif') }}" type="text" name="cif" class="form-control" id="cifInput" placeholder="CIF/NIF">
                        <label for="cifInput">CIF/NIF</label>
                        @error('cif') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    {{-- Acciones --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('factories.index') }}" class="btn btn-outline-blue">
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
