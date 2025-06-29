@extends('legacy.layouts.simple')

@section('content')

    <!-- encabezado -->
    <div class="row">
        <div class="col-4">
            @php
                $logoPath = public_path('img/logo.png');
                $logoBase64 = '';
                if (file_exists($logoPath)) {
                    $logoData = base64_encode(file_get_contents($logoPath));
                    $logoMime = mime_content_type($logoPath);
                    $logoBase64 = 'data:' . $logoMime . ';base64,' . $logoData;
                }
            @endphp
            @if($logoBase64)
                <img src="{{ $logoBase64 }}" width="100" height="100">
            @endif
        </div>

        <div class="col-4">
            <h4 class="text-center text-uppercase">
                cotización <br>

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

        <div class="col-4">
            <p style="text-align: right">
                <b>Fecha</b> {{ date('d/m/Y', strtotime($cotizacion->getCreatedTime())) }} <br>
                <b>Válido hasta</b> {{ date('d/m/Y', strtotime($cotizacion->getFieldValue('Valid_Till'))) }} <br>
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
        @include('legacy.auto.detalles_cotizacion')
    @elseif ($cotizacion->getFieldValue("Plan") == "Vida/Desempleo")
        @include('legacy.desempleo.detalles_cotizacion')
    @elseif ($cotizacion->getFieldValue("Plan") == "Vida")
        @include('legacy.vida.detalles_cotizacion')
    @elseif ($cotizacion->getFieldValue("Plan") == "Seguro Vida Hipotecario")
        @include('legacy.incendio.detalles_cotizacion')
    @elseif ($cotizacion->getFieldValue("Plan") == "Seguro Incendio Leasing")
        @include('legacy.incendio.detalles_cotizacion_leasing')
    @endif

    <div class="col-12" style="height: 20px;">
    </div>

    <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
        <tr>
            <td style="padding: 10px;">

                <p>
                    a) Las aseguradoras, al efectuar su proceso de evaluación de riesgo, se reservan el derecho de
                    aceptación del mismo. En caso de que la aseguradora seleccionada decline el riesgo, el cliente
                    será notificado y deberá escoger otra aseguradora que haya presentado cotización.
                </p>

                <p>
                    b) <b>Exclusión por mora:</b><br>
                    El cliente que presente un atraso de más de 120 días será excluido de la póliza de vehículos.
                    Tras el pago, deberá pasar por una sucursal de Banco Caribe para realizar la re-inspección del
                    vehículo. De no hacerlo, continuará sin cobertura de póliza.
                </p>

                <p>
                    <b>Vigencia:</b> Por el período del préstamo.
                </p>

                <p>
                    He leído y estoy de acuerdo en seleccionar la aseguradora: ________________________________
                </p>

                <p>
                    Al firmar acepta todas las condiciones detalladas en esta cotización de la aseguradora
                    seleccionada.
                </p>

            </td>
        </tr>
    </table>

    <div class="col-12" style="height: 20px;">
    </div>

    <div class="col-12" style="height: 20px;">
    </div>

    <div class="row">
        <div class="col-4">
            <p class="text-center">
                _______________________________ <br> Firma Cliente
            </p>
        </div>

        <div class="col-4">
            <p class="text-center">
                _______________________________ <br> Aseguradora Elegida
            </p>
        </div>

        <div class="col-4">
            <p class="text-center">
                _______________________________ <br> Fecha
            </p>
        </div>
    </div>

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
