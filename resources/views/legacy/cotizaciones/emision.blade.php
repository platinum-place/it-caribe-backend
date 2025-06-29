@extends('legacy.layouts.simple')

@section('content')

    <!-- encabezado -->
    <div class="row">
        <div class="col-4">
            @php
                $logoPath = public_path("img/aseguradoras/" . $plan->getFieldValue("Vendor_Name")->getLookupLabel() . ".png");
                $logoBase64 = '';
                if (file_exists($logoPath)) {
                    $logoData = base64_encode(file_get_contents($logoPath));
                    $logoMime = mime_content_type($logoPath);
                    $logoBase64 = 'data:' . $logoMime . ';base64,' . $logoData;
                }
            @endphp
            @if($logoBase64)
                <img src="{{ $logoBase64 }}" width="150" height="75">
            @endif
        </div>

        <div class="col-4">
            <h4 class="text-center text-uppercase">
                @if (in_array($cotizacion->getFieldValue('Plan'), [
                    'Full',
                    'Ley',
                    'Econo',
                    '0 KM',
                    'Eléctrico/Híbrido',
                    'Empleado',
                ]))
                    resumen
                @else
                    certificado
                @endif

                <br>

                @if (in_array($cotizacion->getFieldValue('Plan'), [
                    'Full',
                    'Ley',
                    'Econo',
                    '0 KM',
                    'Eléctrico/Híbrido',
                    'Empleado',
                ]))
                    seguro vehí­culo de motor <br>
                @endif


                plan {{ $cotizacion->getFieldValue('Plan') }}
            </h4>
        </div>

        <div class="col-8">
            <p style="text-align: right">
                <b>Póliza No.</b> {{ $plan->getFieldValue("P_liza") }} <br>
                <b>Fecha Inicio</b> {{ date('d/m/Y', strtotime($cotizacion->getFieldValue("Vigencia_desde"))) }} <br>
                <b>Fecha Fin</b> {{ date('d/m/Y', strtotime($cotizacion->getFieldValue('Valid_Till'))) }} <br>
            </p>
        </div>
    </div>

    <!-- cliente -->
    <h5 class="d-flex justify-content-center bg-primary text-white">DATOS DEL CLIENTE</h5>
    @include('legacy.layouts.datos_cliente')

    @if (in_array($cotizacion->getFieldValue('Plan'), [
        'Full',
        'Ley',
        'Econo',
        '0 KM',
        'Eléctrico/Híbrido',
        'Empleado',
    ]))
        <h5 class="d-flex justify-content-center bg-primary text-white">DATOS DEL VEHÍCULO</h5>
        @include('legacy.auto.datos_vehiculo')
    @endif

    @if (!empty($cotizacion->getFieldValue("Nombre_codeudor")))
        <h5 class="d-flex justify-content-center bg-primary text-white">DATOS DEL CODEUDOR</h5>
        @include('legacy.vida.datos_codeudor')
    @endif

    @if (in_array($cotizacion->getFieldValue('Plan'), [
        'Full',
        'Ley',
        'Econo',
        '0 KM',
        'Eléctrico/Híbrido',
        'Empleado',
    ]))
        @include('legacy.auto.detalles_emision')

    @elseif ($cotizacion->getFieldValue("Plan") == "Vida/Desempleo")
        @include('legacy.desempleo.detalles_emision')

    @elseif ($cotizacion->getFieldValue("Plan") == "Vida")
        @include('legacy.vida.detalles_emision')

    @elseif ($cotizacion->getFieldValue("Plan") == "Seguro Vida Hipotecario")
        @include('legacy.incendio.detalles_emision')

    @elseif ($cotizacion->getFieldValue("Plan") == "Seguro Incendio Leasing")
        @include('legacy.incendio.detalles_emision_leasing')
    @endif

    <table style="width: 100%; margin-top: 60px; font-size: 12px;">
        <tr>
            <td style="width: 45%; border-top: 1px solid black; text-align: center; padding-top: 5px;">
                Firma Autorizada
            </td>
            <td style="width: 10%;"></td>
            <td style="width: 45%; border-top: 1px solid black; text-align: center; padding-top: 5px;">
                Nombre o Firma del asegurado
            </td>
        </tr>
    </table>

    @if (in_array($cotizacion->getFieldValue('Plan'), [
    'Full',
    'Ley',
    'Econo',
    '0 KM',
    'Eléctrico/Híbrido',
    'Empleado',
]))
        @include('legacy.auto.detalles_emision2')
    @endif

@endsection


@section('css')
    <style>
        @page {
            size: A3;
            margin: 1cm;
        }

        /* Estilos específicos para DomPDF */
        img {
            max-width: 100%;
            height: auto;
        }

        .spacing {
            margin-bottom: 20px;
            height: 20px;
        }

        .large-spacing {
            margin-bottom: 150px;
            height: 150px;
        }

        /* Layout compatible con DomPDF usando flotación */
        .row {
            width: 100%;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .col-4 {
            float: left;
            width: 33.33%;
            padding: 5px;
            box-sizing: border-box;
        }

        .col-12 {
            width: 100%;
            clear: both;
            display: block;
        }

        /* Estilos para las cards */
        .card-group {
            width: 100%;
            overflow: hidden;
        }

        .card {
            float: left;
            margin-right: 10px;
            box-sizing: border-box;
        }

        .card-body {
            padding: 10px;
        }

        /* Centrado de texto */
        .text-center {
            text-align: center;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        /* Colores de fondo */
        .bg-primary {
            background-color: #007bff;
        }

        .text-white {
            color: white;
        }

        /* Centrado flex compatible */
        .d-flex.justify-content-center {
            text-align: center;
            padding: 8px;
        }

        .page-break {
            page-break-before: always;
        }

    </style>
@endsection


@section('js')
    <!-- Tiempo para que la pagina se imprima y luego se cierre -->
    <script>
        document.title = "Cotización No. " + {{ $cotizacion->getFieldValue('Quote_Number') }}; // Cambiamos el título
        // setTimeout(function() {
        //     window.print();
        //     window.close();
        // }, 3000);
    </script>
@endsection
