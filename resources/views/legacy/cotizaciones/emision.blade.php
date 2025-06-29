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

    <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
        <tr>
            <td style="padding: 10px; text-align: justify;">
                <p>A) Autorizo que la prima correspondiente a los seguros aceptados por mi persona sean adicionadas a la
                    cuota del préstamo otorgado a mi favor por Banco Múltiple Caribe, S. A., hasta sus intereses,
                    entidad que ha asumido la responsabilidad de entregar a la aseguradora dicha partida, de conformidad
                    a acuerdo entre ambas partes.</p>

                <p>B) Por este medio, les autorizo endosar mi póliza de Vehículo No. 30-35-1953 por el monto de RD$
                    1,100,000.00 a favor de Banco Múltiple Caribe, S. A., hasta sus intereses.</p>

                <p>C) La cobertura otorgada bajo esta póliza queda condicionada a las cláusulas y condiciones
                    especificadas en los anexos, los cuales han sido incluidos en la póliza definitiva, cuyas
                    condiciones completas están contenidas en la copia que reposa en la entidad financiera y
                    aseguradora.</p>

                <ul style="margin-top: 0; margin-bottom: 10px; padding-left: 20px;">
                    <li>Podrán consultarla a través de la página de internet <a
                            href="http://www.bancocaribe.com.do/seguroscaribe/vehiculos"
                            style="color: black; text-decoration: underline;">www.bancocaribe.com.do/seguroscaribe/vehiculos</a>.
                    </li>
                    <li>Las condiciones generales de la póliza podrán ser solicitadas en Humano Seguros. Puede dirigirse
                        a su oficina principal en la Av. Lope de Vega No. 36, Santo Domingo, o contactarse al
                        809-476-3570.
                    </li>
                    <li>Puede contactarse con Segurnet Corredores de Seguros al 809-620-2524 o dirigirse a su oficina en
                        la calle Viriato Fiallo No. 24, D.N., Santo Domingo.
                    </li>
                </ul>

                <p>D) La cobertura de vida cubrirá el préstamo del deudor de Banco Caribe hasta el saldo insoluto y
                    hasta sus intereses, sin exceder los RD$300,000.00, según las condiciones generales de la
                    póliza.</p>

                <p>E) La cobertura de últimos gastos indicada en este certificado indemnizará al beneficiario (declarado
                    en la solicitud de vida) en el momento del fallecimiento del asegurado y deudor de Banco Caribe,
                    siempre que el valor adeudado y hasta sus intereses no excedan los RD$300,000.00, según las
                    condiciones generales de la póliza.</p>

                <p>F) Los asegurados deberán comunicar al banco y a la aseguradora cualquier cambio de propietario del
                    vehículo asegurado, así como también en caso de que el vehículo asegurado sea sustituido por otro,
                    de acuerdo con la política del banco.</p>

                <p>G) En caso de ocurrir un accidente cubierto bajo las condiciones de esta póliza cuya reparación
                    requiera la sustitución de partes, piezas y accesorios del vehículo asegurado, si dichas partes,
                    piezas y accesorios no pueden ser suministradas por falta de existencias en los distribuidores del
                    país, Humano no será responsable del sobreprecio que se produzca para obtenerlas en mercados
                    extranjeros ni de las demoras generadas en el proceso de importación de las mismas. Se entiende
                    expresamente que en ningún caso dichas demoras obligarán a la aseguradora a la liquidación del
                    vehículo asegurado si aplica.</p>

                <p>H) En los casos de salvamento, la aseguradora se reserva el derecho de cubrir únicamente la deuda del
                    siniestro de acuerdo con el valor del vehículo en el mercado al momento del evento.</p>

                <p>I) El salvamento al 100% es propiedad de la compañía de seguros una vez se haya indemnizado el valor
                    asegurado.</p>

                <p>J) En caso de accidente, el asegurado deberá proteger el vehículo asegurado contra toda pérdida o
                    daño adicional. Cualquier daño que ocurra, directa o indirectamente, por falta de protección por
                    parte del asegurado no será indemnizable bajo esta póliza.</p>

                <p>K) <b>Exclusión por mora:</b><br>
                    El cliente que presente un atraso de más de 120 días será excluido de la póliza de vehículos.
                    Efectuado el pago, el cliente deberá pasar por una sucursal de Banco Caribe, donde se realizará la
                    reinspección del vehículo. Si no procede con la misma, continuará sin cobertura de póliza.
                </p>

                <p>L) Vigencia: La póliza estará válida hasta la cancelación del préstamo.</p>

                <p>M) 5% del V/A Mín. RD$20,000 – Pérdidas Parciales; 10% del V/A Mín. RD$30,000 – Pérdidas Totales.</p>

                <p>N) Aplicaremos 30% anual de depreciación para vehículos pesados y 24% anual para livianos y medianos
                    al momento de declarar el vehículo como pérdida total.</p>

                <p>1) Deducible de Humano en su plan cero deducible y para vehículos 0km: en el caso de automóviles,
                    jeepetas, camionetas y vehículos pesados tendrán 0 % de deducible y a partir del 5to año cambia al
                    deducible del 1 % mínimo RD$ 5,000.00</p>

                <p>Al firmar acepta todas las condiciones detalladas en esta cotización de la aseguradora
                    seleccionada.</p>
            </td>
        </tr>
    </table>

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
