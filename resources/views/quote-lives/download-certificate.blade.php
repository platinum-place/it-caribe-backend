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
        <td style="border: none; text-align:left; font-weight: bold;">Correo:</td>
        <td style="border: none; text-align:left;">{{ $customer->email }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Fecha:</td>
        <td style="border: none; text-align:left;">{{ date('d/m/Y', strtotime($quote->start_date)) }}</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Cliente:</td>
        <td style="border: none; text-align:left;">{{ $customer->full_name }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Equipamientos:</td>
        <td style="border: none; text-align:left;">{{ 'NINGUNO' }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Cédula/Pasaporte:</td>
        <td style="border: none; text-align:left;">{{ $customer->identity_number }}</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Dirección:</td>
        <td style="border: none; text-align:left;"><p style="font-size: 8px">{{ $customer->address }}</p></td>
        <td style="border: none; text-align:left; font-weight: bold;">Uso:</td>
        <td style="border: none; text-align:left;">{{ $quoteVehicle->vehicleUse->name }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Teléfono:</td>
        <td style="border: none; text-align:left;">{{ $customer->home_phone }}</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Tipo de vehículo:</td>
        <td style="border: none; text-align:left;">{{ $quoteVehicle->vehicleUse->name }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Marca:</td>
        <td style="border: none; text-align:left;">{{ $quoteVehicle->vehicleMake->name }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Modelo:</td>
        <td style="border: none; text-align:left;">{{ $quoteVehicle->vehicleModel->name }}</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Año:</td>
        <td style="border: none; text-align:left;">{{ $quoteVehicle->vehicle_year }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Chasis:</td>
        <td style="border: none; text-align:left;">{{ $vehicle->chassis }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Valor asegurado:</td>
        <td style="border: none; text-align:left;">{{ number_format($quoteVehicle->vehicle_amount, 2) }}</td>
    </tr>
    </tbody>
</table>

@php
    $lineItemsData = [];
    $vehicleType = $quoteVehicle->vehicleType->name;
    $isVehicleType = preg_match('/\bpesado\b/i', $vehicleType) || $vehicleType === "Camión";
    $productFields = [
        'Lesiones_muerte_1_pers',
        'Lesiones_muerte_m_s_1_pers',
        'Da_os_propiedad_ajena',
        'Incendio_y_robo',
        'Colisi_n_y_vuelco',
        'Riesgos_comprensivos',
        'Rotura_de_cristales_deducible',
        'Fianza_judicial',
        'Lesiones_muerte_1_pas',
        'Lesiones_muerte_m_s_1_pas',
        'Riesgos_conductor',
        'Asistencia_vial',
        'En_caso_de_accidente',
        'Renta_veh_culo',
        'Vida',
        'ltimos_gastos',
        'Deducible',
        'Cruz_roja',
        'Cobertura_extra',
        'Cobertura_pink',
        'Gastos_m_dicos',
        'Vendor_Name',
    ];

    $vendorFields = [
        'Nombre',
    ];

    $lineItemsData[] = [
         'product' => $productCRM,
          'vendorName' => $vendorCRM['Nombre'],
          'netTotal' => $selectedLine->total,
          'monthlyTotal' => $selectedLine->total / 12,
    ];

    $coverageRows = [
        ['label' => 'Coberturas', 'field' => 'vendorName', 'type' => 'text','style'=>'border: none; font-weight: bold'],
        ['label' => 'Lesiones y/o muerte 1 persona', 'field' => 'Lesiones_muerte_1_pers', 'type' => 'number','style'=>'border: none;'],
        ['label' => 'Lesiones y/o muerte mas de 1 persona', 'field' => 'Lesiones_muerte_m_s_1_pers', 'type' => 'number','style'=>'border: none;'],
        ['label' => 'Daños a la propiedad ajena', 'field' => 'Da_os_propiedad_ajena', 'type' => 'number','style'=>'border: none;'],
        ['label' => 'Incendio y/o robo', 'field' => 'Incendio_y_robo', 'type' => 'percentage','style'=>'border: none;'],
        ['label' => 'Colisión y/o vuelco', 'field' => 'Colisi_n_y_vuelco', 'type' => 'percentage','style'=>'border: none;'],
        ['label' => 'Cobertura comprensiva', 'field' => 'Riesgos_comprensivos', 'type' => 'percentage','style'=>'border: none;'],
        ['label' => 'Rotura de cristales', 'field' => 'Rotura_de_cristales_deducible', 'type' => 'text','style'=>'border: none;'],
        ['label' => 'Fianza judicial', 'field' => 'Fianza_judicial', 'type' => 'number','style'=>'border: none;'],
        ['label' => 'Lesiones y/o muerte 1 pasajero', 'field' => 'Lesiones_muerte_1_pas', 'type' => 'number','style'=>'border: none;'],
        ['label' => 'Lesiones y/o muerte mas de 1 pasajero', 'field' => 'Lesiones_muerte_m_s_1_pas', 'type' => 'number','style'=>'border: none;'],
        ['label' => 'Riesgo conductor', 'field' => 'Riesgos_conductor', 'type' => 'number','style'=>'border: none;'],
        ['label' => 'Asistencia en viajes', 'field' => 'Asistencia_vial', 'type' => 'assistance','style'=>'border: none;'],
        ['label' => 'Centro del automovilista (CA)', 'field' => 'En_caso_de_accidente', 'type' => 'included','style'=>'border: none;'],
        ['label' => 'Plan renta', 'field' => 'Renta_veh_culo', 'type' => 'assistance','style'=>'border: none;'],
        ['label' => 'Vida (Cubre el saldo insoluto hasta)', 'field' => 'Vida', 'type' => 'number','style'=>'border: none;'],
        ['label' => 'Últimos gastos', 'field' => 'ltimos_gastos', 'type' => 'number','style'=>'border: none;'],
        ['label' => 'Deducible', 'field' => 'Deducible', 'type' => 'text', 'style'=>'border: none; font-weight: bold;'],
        ['label' => 'Cruz Roja Dominicana (CRD)', 'field' => 'Cruz_roja', 'type' => 'included','style'=>'border: none;'],
        ['label' => 'Cobertura Extra', 'field' => 'Cobertura_extra', 'type' => 'optional_number','style'=>'border: none;'],
        ['label' => 'Cobertura Pink', 'field' => 'Cobertura_pink', 'type' => 'optional_number','style'=>'border: none;'],
        ['label' => 'Gastos Medicos', 'field' => 'Gastos_m_dicos', 'type' => 'optional_number','style'=>'border: none;'],
    ];
@endphp

<table style="width: 100%; border: none; border-collapse: collapse;">
    @foreach ($coverageRows as $row)
        <tr @isset($row['style'] ) style="{{ $row['style'] }}" @endisset>
            <td style="border: none; font-weight: bold;">{{ $row['label'] }}</td>
            @foreach ($lineItemsData as $data)
                <td style="border: none;">
                    @switch($row['type'])
                        @case('text')
                            @if ($row['field'] === 'vendorName')
                                {{ ucwords(strtolower($data['vendorName'])) }}
                            @else
                                {{ $data['product'][$row['field']] }}
                            @endif
                            @break

                        @case('number')
                            {{ number_format($data['product'][$row['field']]) }}
                            @break

                        @case('percentage')
                            {{ $data['product'][$row['field']] }}%
                            @break

                        @case('assistance')
                            @if ($data['product'][$row['field']] == 1)
                                {{ $isVehicleType ? 'No incluida' : 'Incluida' }}
                            @else
                                No incluida
                            @endif
                            @break

                        @case('included')
                            {{ !empty($data['product'][$row['field']]) ? 'Incluida' : 'No incluida' }}
                            @break

                        @case('optional_number')
                            @if (!empty($data['product'][$row['field']]))
                                {{ number_format($data['product'][$row['field']]) }}
                            @else
                                No incluida
                            @endif
                            @break
                    @endswitch
                </td>
            @endforeach
        </tr>
    @endforeach

    <tr>
        <td style="border: none; font-weight: bold;">PRIMAS PROPUESTAS</td>
        @foreach ($lineItemsData as $data)
            <td>&nbsp;</td>
        @endforeach
    </tr>

    <tr>
        <td style="border: none; font-weight: bold;">&nbsp;</td>
        @foreach ($lineItemsData as $data)
            <td style="font-weight: bold;">{{ ucwords(strtolower($data['vendorName'])) }}</td>
        @endforeach
    </tr>

    <tr>
        <td style="border: none; font-weight: bold;">Prima Anual</td>
        @foreach ($lineItemsData as $data)
            <td>{{ number_format($data['monthlyTotal'], 2) }}</td>
        @endforeach
    </tr>

    <tr>
        <td style="border: none; font-weight: bold;">Prima Mensual</td>
        @foreach ($lineItemsData as $data)
            <td>{{ number_format($data['monthlyTotal'], 2) }}</td>
        @endforeach
    </tr>
</table>

<div style="height: 100px;"></div>

<table style="width: 100%; border: none; border-collapse: collapse;">
    <tr>
        <td style="width: 50%; border: none; padding: 10px; vertical-align: top;">
            ________________________________ <br>
            Firma Autorizada
        </td>
        <td style="width: 50%; border: none; padding: 10px; vertical-align: top;">
            ________________________________ <br>
            Nombre o Firma del asegurado
        </td>
    </tr>
</table>

</body>
</html>
