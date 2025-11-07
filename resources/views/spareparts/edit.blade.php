@extends('plantilla.plantilla')

@section('contenido')   {{-- <— antes ponías "content" --}}
<div class="container text-center">
    <h1 class="titlePrometeo">Panel de control del taller</h1>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card bg-dark text-light border-secondary shadow">
                <div class="card-header text-info">
                    {{ __('Repuestos EDIT') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Bienvenido al sistema del taller Prometeo!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
