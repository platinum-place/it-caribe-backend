<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        @page {
            size: A3 portrait;
            margin: 20px;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 12px;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: none;
            padding: 6px;
            width: 16.66%;
        }

        th {
            background-color: #ddd;
            text-align: center;
        }

        td {
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

@php
    $logoPath =  public_path("img/aseguradoras/" . $productCRM['Vendor_Name']['name'] . ".png");
    $logoBase64 = '';
    if (file_exists($logoPath)) {
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoMime = mime_content_type($logoPath);
        $logoBase64 = 'data:' . $logoMime . ';base64,' . $logoData;
    }
@endphp
@if($logoBase64)
    <img src="{{ $logoBase64 }}" width="130" height="70" alt="">
@endif

<h3 style="text-align:center;">EMISIÓN DE SEGUROS</h3>

<h4 style="text-align:right;">Póliza No.: {{ $productCRM['P_liza'] }}</h4>

<table style="width: 100%; border: none;">
    <tbody>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Ramo/Producto:</td>
        <td style="border: none; text-align:left;">{{ $quoteCRM['Plan'] }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Fecha:</td>
        <td style="border: none; text-align:left;">{{ date('d/m/Y', strtotime($quote->start_date)) }}</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Cliente:</td>
        <td style="border: none; text-align:left;">{{ $customer->full_name }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Cédula/Pasaporte:</td>
        <td style="border: none; text-align:left;">{{ $customer->identity_number }}</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Dirección:</td>
        <td style="border: none; text-align:left;"><p style="font-size: 8px">{{ $customer->address }}</p></td>
        <td style="border: none; text-align:left; font-weight: bold;">Teléfono:</td>
        <td style="border: none; text-align:left;">{{ $customer->home_phone }}</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Edad:</td>
        <td style="border: none; text-align:left;">{{ $customer->age }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Codeudor:</td>
        <td style="border: none; text-align:left;">{{ $coDebtor?->full_name }}</td>
    </tr>
    </tbody>
</table>

<div style="height: 20px;"></div>

<table style="width: 100%; border: none; border-collapse: collapse;">
    <thead>
    <tr>
        <th style="border: none; text-align:left;">Aseguradora</th>
        <th style="border: none; text-align:left;">Monto Original</th>
        <th style="border: none; text-align:left;">Años</th>
        <th style="border: none; text-align:left;">Prima</th>
        <th style="border: none; text-align:left;">Edad a terminar</th>
        <th style="border: none; text-align:left;">Prima Anual</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border: none; font-weight: bold; text-align:left;">{{ ucwords(strtolower($vendorCRM['Nombre'])) }}</td>
            <td style="border: none; font-weight: bold; text-align:left;">{{ number_format($quoteLife->insured_amount, 2) }}</td>
            <td style="border: none; font-weight: bold; text-align:left;">{{ $quoteLife->deadline }}</td>
            <td style="border: none; font-weight: bold; text-align:left;">{{ number_format($selectedLine->quoteLine->total, 2) }}</td>
            <td style="border: none; font-weight: bold; text-align:left;">{{ $customer->age + $quoteLife->deadline }}</td>
            <td style="border: none; font-weight: bold; text-align:left;">{{ number_format($selectedLine->quoteLine->total * 12, 2) }}</td>
        </tr>
    </tbody>
</table>

<div style="height: 20px;"></div>

<table style="width: 100%; font-size: 12px;">
    <tr>
        <td style="padding: 10px;">
            <p>
                A. Las aseguradoras al efectuar su proceso de evaluación de riesgo, se reservan el derecho de aceptación de este.
                En caso de que la aseguradora seleccionada decline el riesgo, el cliente será notificado y en lo inmediato deberá
                escoger otra aseguradora que haya presentado cotización.
            </p>

            <p>
                B. Autorizo que la prima correspondiente a los seguros aceptados por mi persona, sean incluidos en el monto de
                la cuota del préstamo otorgado a mi favor por Banco Múltiple Caribe, S.A, entidad que ha asumido la
                responsabilidad de entregar a la aseguradora dicha partida, de conformidad a acuerdo entre ambas partes.
            </p>

            <p>
                C. Por este medio les autorizo endosar mi póliza, a favor de Banco Caribe, S.A. hasta sus intereses.
            </p>

            <p>
                D. Clientes con más de un préstamo y con seguro de vida, deben revisar el monto asegurado acumulado para
                evaluar si requiere otros requisitos médicos según la tabla de requisitos por aseguradoras.
            </p>

            <p>
                E. La aseguradora se reserva el derecho para realizar variación de prima y coberturas en la cotización de
                seguros suscrita con el cliente.
            </p>

            <p>
                F. La cobertura otorgada bajo esta póliza queda condicionada a las cláusulas y condiciones especificadas en
                los anexos, los cuales han sido incluidos en la póliza definitiva, cuyas condiciones completas están contenidas en
                la copia que reposa en la entidad Financiera y Aseguradora:
            </p>

            <ul>
                <li>Podrán consultarla a través de la página de internet <a href="https://www.bancocaribe.com.do/seguroscaribe/seguro-de-vida" target="_blank">www.bancocaribe.com.do/seguroscaribe/seguro-de-vida</a>.</li>
                <li>Las condiciones de la póliza pueden ser solicitadas en {{ $vendorCRM['Nombre'] }}. Puede dirigirse a su oficina principal en la {{ $vendorCRM['Street'] }} o contactarse al {{ $vendorCRM['Phone'] }}.</li>
                <li>Pueden contactarse con Sentinel Corredores de Seguros al 809-732-0202 o dirigirse a su oficina en la calle César A. Canó No. 354, Las Praderas, Santo Domingo.</li>
            </ul>

            <p>
                G. <b>Vigencia:</b> La póliza estará válida hasta la cancelación del préstamo.
            </p>

            <p><b>Exclusiones</b></p>

            <p>
                A. Asegurado que practique cualquier tipo de deporte de alto riesgo o que preste servicios de vehículos públicos
                o aéreos. (De acuerdo a formulario).
            </p>

            <p>
                B. La aseguradora se reserva el derecho de no pagar ninguna reclamación que surja como consecuencia de
                suicidio o tentativa de suicidio, siempre y cuando ocurra dentro del plazo de 2 años.
            </p>

            <p>
                C. La compañía no pagará la indemnización por fallecimiento de un asegurado que sufra cualquier lesión por
                accidente o cualquier enfermedad provocada por participar activamente en guerra, rebelión, motín o cualquier
                otra relacionada a estas. Tampoco indemnizará por fallecimiento por estar cometiendo algún delito como robo,
                asalto, asesinato o por causa de intervenciones quirúrgicas ilícitas o estéticas.
            </p>

            <p>
                D. Hospitalización o incapacidad total y permanente causada por enfermedad, lesión o condición preexistente,
                originada antes del inicio de vigencia de la cobertura.
            </p>

            <p>
                E. Epidemias declaradas por las autoridades competentes.
            </p>

            <p>
                F. Fallecimiento ocasionado por cualquier enfermedad del Síndrome de Inmunodeficiencia Adquirida – SIDA,
                virus VIH o cualquier otro desorden inmunológico.
            </p>

            <p>
                G. Exclusiones por mora: Si la prima presenta un atraso de más de 120 días, será excluido de la póliza.
            </p>
        </td>
    </tr>
</table>

<div style="height: 70px;"></div>

<table style="width: 100%; border: none;">
    <tr>
        <td style="width: 50%; border: none; padding: 10px; vertical-align: top;">
            ________________________________ <br>
            NOMBRE O FIRMA DEL CLIENTE CEDULA
        </td>
    </tr>
</table>

</body>
</html>
