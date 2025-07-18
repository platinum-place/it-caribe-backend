@extends('layouts.app')

@section('content')

<div class="card mb-4">
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Fecha Cotización</th>
                    <th>Codigo</th>
                    <th>Cliente</th>
                    <th>RNC/Cédula</th>
                    <th>Plan</th>
                    <th>Referidor</th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>Fecha Cotización</th>
                    <th>Codigo</th>
                    <th>Cliente</th>
                    <th>RNC/Cédula</th>
                    <th>Plan</th>
                    <th>Referidor</th>
                    <th>Opciones</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ((array)$cotizaciones as $cotizacion)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($cotizacion->getCreatedTime())) }}</td>
                        <td>{{ $cotizacion->getFieldValue('Quote_Number') }}</td>
                        <td>
                            {{ $cotizacion->getFieldValue('Nombre') . ' ' . $cotizacion->getFieldValue('Apellido') }}
                        </td>
                        <td>{{ $cotizacion->getFieldValue('RNC_C_dula') }}</td>
                        <td>{{ $cotizacion->getFieldValue('Plan') }} </td>
                        <td>{{ ($cotizacion->getFieldValue('Contact_Name')) ? $cotizacion->getFieldValue('Contact_Name')->getLookupLabel() : "" }}</td>
                        <td>
                            <a href="{{ url("cotizaciones/emitir/" . $cotizacion->getEntityId()) }}" title="Emitir">
                                <i class="far fa-user"></i>
                            </a>
                            |
                            <a href="{{ url("cotizaciones/editar/" . $cotizacion->getEntityId()) }}" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            |
                            <a href="{{ url("cotizaciones/descargar/" . $cotizacion->getEntityId()) }}" title="Descargar" target="__blank">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection