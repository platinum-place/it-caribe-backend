@extends('layouts.simple')

@section('content')

<div class="row">
    <div class="col-4">
        <img src="{{ asset("img/tua.png") }}" width="150" height="150">
    </div>

    <div class="col-4">
        <h5 class="text-center text-uppercase">
            REGISTRO <br> TU ASISTENCIA
        </h5>
    </div>

    <div class="col-4">
        <p style="text-align: right">
            <b>Fecha </b> {{ date('d/m/Y') }}
        </p>

        <p style="text-align: right" class="text-danger">
            <b>Estado </b> Inactivo
        </p>
    </div>

    <div class="col-12">
        &nbsp;
    </div>

    @include('plantillas.detalles')

    <div class="col-12">
        &nbsp;
    </div>

    <h6>VEHÍCULOS</h6>
    <div class="col-12" style="font-size: small;">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Tipo</th>
                    <th>Año</th>
                    <th>Color</th>
                    <th>Placa</th>
                    <th>Chasis</th>
                </tr>
            </thead>

            <tbody>
                {{ $cont = 1 }}
                @foreach ((array)$vehiculos as $vehiculo)
                    <tr>
                        <td>{{ $cont }}</td>
                        <td>{{ $vehiculo->getFieldValue('Marca') }}</td>
                        <td>{{ $vehiculo->getFieldValue('Modelo') }}</td>
                        <td>{{ $vehiculo->getFieldValue('Tipo') }}</td>
                        <td>{{ $vehiculo->getFieldValue('A_o') }}</td>
                        <td>{{ $vehiculo->getFieldValue('Color') }}</td>
                        <td>{{ $vehiculo->getFieldValue('Placa') }}</td>
                        <td>{{ $vehiculo->getFieldValue('Name') }}</td>
                    </tr>
                    {{ $cont++ }}
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="col-12">
    &nbsp;
</div>

<h6>NOTA</h6>
<div class="card">
    <div class="card-body">
        <p class="card-text"></p>
    </div>
</div>


<div class="row">
    <div {{ ($cont < 20) ? 'class="fixed-bottom"' : ""; }}>
        <p class="text-center">
            Ave. Gustavo Mejía Ricart esq. Abrahm Lincoln, Torre Piantini, Suite 14-A, <br>
            Ens. Piantini, Santo Domingo, República Dominicana <br>
            www.gruponobe.com | RNC: 131057251
        </p>
    </div>
</div>


@endsection

@section('css')
<!-- Tamaño ideal para la plantilla -->
<style>
    @page {
        size: A3;
    }

    @media all {
        div.saltopagina {
            display: none;
        }
    }

    @media print {
        div.saltopagina {
            display: block;
            page-break-before: always;
        }
    }
</style>
@endsection


@section('js')
<!-- Tiempo para que la pagina se imprima y luego se cierre -->
<script>
    document.title = "REGISTRO TUA" + {{ $tua->getFieldValue('Deal_Name') }}; // Cambiamos el título
    setTimeout(function() {
        window.print();
        window.close();
    }, 3000);
</script>
@endsection