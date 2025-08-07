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
            font-size: 10px;
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
    $logoPath = public_path('img/logo.png');
    $logoBase64 = '';
    if (file_exists($logoPath)) {
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoMime = mime_content_type($logoPath);
        $logoBase64 = 'data:' . $logoMime . ';base64,' . $logoData;
    }
@endphp
@if($logoBase64)
    <img src="{{ $logoBase64 }}" width="70" height="70" alt="">
@endif

<h3 style="text-align:center;">COTIZACIÓN DE SEGUROS</h3>

<table style="width: 100%; border: none;">
    <tbody>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Ramo/Producto:</td>
        <td style="border: none; text-align:left;">Desempleo</td>
        <td style="border: none; text-align:left; font-weight: bold;">Fecha:</td>
        <td style="border: none; text-align:left;">{{ date('d/m/Y', strtotime($quote->start_date)) }}</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Cliente:</td>
        <td style="border: none; text-align:left;">{{ $debtor->full_name }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Cédula/Pasaporte:</td>
        <td style="border: none; text-align:left;">{{ $debtor->identity_number }}</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Dirección:</td>
        <td style="border: none; text-align:left;">{{ $debtor->address }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Teléfono:</td>
        <td style="border: none; text-align:left;">{{ $debtor->home_phone }}</td>
    </tr>
    </tbody>
</table>

<div style="height: 10px;"></div>

<table style="width: 100%; border: none; border-collapse: collapse;">
    <thead>
    <tr>
        <th style="border: none; text-align:left;">Aseguradora</th>
        <th style="border: none; text-align:right;">Cuota Prestamo</th>
        <th style="border: none; text-align:right;">Plazo en Meses</th>
        <th style="border: none; text-align:right;">Total Seguro</th>
    </tr>
    </thead>
    <tbody>
    @foreach($lines as $line)
        @php
            $productCRM = app(\App\Services\Api\Zoho\ZohoCRMService::class)->getRecords('Products',['Vendor_Name'],$line->quoteLine->id_crm)['data'][0];
            $vendorCRM = app(\App\Services\Api\Zoho\ZohoCRMService::class)->getRecords('Vendors',['Nombre'],$productCRM['Vendor_Name']['id'])['data'][0];
        @endphp
        <tr>
            <td style="border: none; text-align:left;">{{ ucwords(strtolower($vendorCRM['Nombre'])) }}</td>
            <td style="border: none; text-align:right;">{{ number_format($quoteDebtUnemployment->loan_installment, 2) }}</td>
            <td style="border: none; text-align:right;">{{ $quoteDebtUnemployment->deadline }}</td>
            <td style="border: none; text-align:right;">{{ number_format($line->quoteLine->total, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div style="height: 20px;"></div>

<table style="width: 100%; font-size: 12px;">
    <tr>
        <td style="padding: 10px;">

            <p>
                a) Las aseguradoras al efectuar su proceso de evaluación de riesgo, se reservan el derecho de aceptación del
                mismo. En caso de que la aseguradora seleccionada decline el riesgo, el cliente será notificado.
            </p>

            <p>
                b) La aseguradora se reserva el derecho para realizar variación de prima y coberturas en esta cotización de seguros
                suscrita con el cliente.
            </p>

            <p>
                <b>Vigencia:</b> Por el período del préstamo.
            </p>

            <p>
                He leído y estoy de acuerdo en seleccionar la aseguradora: ________________________________
            </p>
        </td>
    </tr>
</table>

<div style="height: 70px;"></div>

<table style="width: 100%; border: none;">
    <tr>
        <td style="width: 50%; border: none; padding: 10px; vertical-align: top;">
            ________________________________ <br>
            Fecha
        </td>
        <td style="width: 50%; border: none; padding: 10px; vertical-align: top;">
            ________________________________ <br>
            Nombre o Firma del Cliente
        </td>
        <td style="width: 50%; border: none; padding: 10px; vertical-align: top;">
            ________________________________ <br>
            Firma Oficial
        </td>
    </tr>
</table>

</body>
</html>
