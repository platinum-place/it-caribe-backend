@extends('legacy.layouts.simple')

@section('content')

<!-- encabezado -->
<div class="row">
    <div class="col-4">
        <img src="{{ asset("img/aseguradoras/" . $plan->getFieldValue("Vendor_Name")->getLookupLabel() . ".png") }}" width="200" height="100">
    </div>

    <div class="col-4">
        <h4 class="text-center text-uppercase">
            @if ($cotizacion->getFieldValue("Plan") == "Anual Full" or $cotizacion->getFieldValue("Plan") == "Mensual Full")
                resumen
            @else
                certificado
            @endif



            @if ($cotizacion->getFieldValue("Plan") == "Anual Full" or $cotizacion->getFieldValue("Plan") == "Mensual Full")
                seguro vehí­culo de motor <br>
            @endif



            plan {{ $cotizacion->getFieldValue('Plan') }}
        </h4>
    </div>

    <div class="col-4">
        <p style="text-align: right">
            <b>Póliza No.</b> {{ $plan->getFieldValue("P_liza") }} <br>
            <b>Fecha Inicio</b> {{ date('d/m/Y', strtotime($cotizacion->getFieldValue("Vigencia_desde"))) }} <br>
            <b>Fecha Fin</b> {{ date('d/m/Y', strtotime($cotizacion->getFieldValue('Valid_Till'))) }} <br>
        </p>
    </div>
</div>



<div class="col-12">
    &nbsp;
</div>



<!-- cliente -->
<h5 class="d-flex justify-content-center bg-primary text-white">DATOS DEL CLIENTE</h5>
@include('legacy.layouts.datos_cliente')



@if ($cotizacion->getFieldValue("Plan") == "Anual Full" or $cotizacion->getFieldValue("Plan") == "Mensual Full")
    <div class="col-12">
        &nbsp;
    </div>

    <h5 class="d-flex justify-content-center bg-primary text-white">DATOS DEL VEHÍCULO</h5>
    @include('legacy.auto.datos_vehiculo')
@endif



<div class="col-12">
    &nbsp;
</div>



@if ($cotizacion->getFieldValue("Plan") == "Anual Full" || $cotizacion->getFieldValue("Plan") == "Mensual Full")
    @include('legacy.auto.detalles_emision')

@elseif ($cotizacion->getFieldValue("Plan") == "Vida/Desempleo")
    @include('legacy.desempleo.detalles_emision')

@elseif ($cotizacion->getFieldValue("Plan") == "Vida")
    @include('legacy.vida.detalles_emision')

@elseif ($cotizacion->getFieldValue("Plan") == "Seguro Incendio Hipotecario")
    @include('legacy.incendio.detalles_emision')

@elseif ($cotizacion->getFieldValue("Plan") == "Seguro Incendio Leasing")
    @include('legacy.incendio.detalles_emision_leasing')
@endif


@endsection


@section('css')
<!-- Tamaño ideal para la plantilla -->
<style>
    @page {
        size: A3;
    }
</style>
@endsection


@section('js')
<!-- Tiempo para que la pagina se imprima y luego se cierre -->
<script>
    document.title = "Emisión No. " + {{ $cotizacion->getFieldValue('Quote_Number') }}; // Cambiamos el título
    setTimeout(function() {
        window.print();
        window.close();
    }, 3000);
</script>
@endsection
