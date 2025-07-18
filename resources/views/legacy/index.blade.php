@extends('layouts.app')

@section('content')

<div class="alert alert-success" role="alert">
    <h3 class="alert-heading">¡Bienvenido al Insurance Tech de Grupo Nobe!</h3>
    <p>
        Desde su panel de control podrás ver la información necesaria para manejar sus pólizas y cotizaciones.
    </p>
</div>

<div class="row">
    <div class="col-xl-3 col-md-4">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                Pólizas emitidas este mes<br>
                {{ $polizas }}
            </div>

            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#" data-bs-toggle="modal" data-bs-target="#emisiones_mensuales">Ver más</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Aseguradora</th>
                    <th>Cantidad</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($lista as $aseguradora => $cantidad)
                    <tr>
                        <td>{{ $aseguradora }}</td>
                        <td>{{ $cantidad }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection


@section('modal')
@include('modals.emisiones_mensuales')
@endsection