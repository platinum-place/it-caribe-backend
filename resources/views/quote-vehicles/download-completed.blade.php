<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $name }}</title>
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
            border: 1px solid #000;
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
    $logoPath =  public_path("img/aseguradoras/" . $plan->getFieldValue("Vendor_Name")->getLookupLabel() . ".png");
    $logoBase64 = '';
    if (file_exists($logoPath)) {
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoMime = mime_content_type($logoPath);
        $logoBase64 = 'data:' . $logoMime . ';base64,' . $logoData;
    }
@endphp
@if($logoBase64)
    <img src="{{ $logoBase64 }}" width="150" height="50" alt="">
@endif

<h3 style="text-align:center;">EMISIÓN DE SEGUROS</h3>

<h4 style="text-align:right;">Póliza No.: {{ $plan->getFieldValue("P_liza") }}</h4>

<table>
    <tbody>
    <tr>
        <td style="text-align:left; font-weight: bold;">Ramo/Producto:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue('Plan') }}</td>
        <td style="text-align:left; font-weight: bold;">Correo:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue('Correo_electr_nico') }}</td>
        <td style="text-align:left; font-weight: bold;">Fecha:</td>
        <td style="text-align:left;">{{ date('d/m/Y', strtotime($cotizacion->getCreatedTime())) }}</td>
    </tr>
    <tr>
        <td style="text-align:left; font-weight: bold;">Cliente:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue("Nombre") . " " . $cotizacion->getFieldValue("Apellido") }}</td>
        <td style="text-align:left; font-weight: bold;">Equipamientos:</td>
        <td style="text-align:left;">{{ 'NINGUNO' }}</td>
        <td style="text-align:left; font-weight: bold;">Cédula/Pasaporte:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue('RNC_C_dula') }}</td>
    </tr>
    <tr>
        <td style="text-align:left; font-weight: bold;">Dirección:</td>
        <td style="text-align:left;"><p style="font-size: 8px">{{ $cotizacion->getFieldValue('Direcci_n') }}</p></td>
        <td style="text-align:left; font-weight: bold;">Uso:</td>
        <td style="text-align:left;">{{ $quoteVehicle->vehicleUse->name }}</td>
        <td style="text-align:left; font-weight: bold;">Teléfono:</td>
        <td style="text-align:left;">{{ $quoteVehicle->quote->customer->home_phone }}</td>
    </tr>
    <tr>
        <td style="text-align:left; font-weight: bold;">Tipo de vehículo:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue('Tipo_veh_culo') }}</td>
        <td style="text-align:left; font-weight: bold;">Marca:</td>
        <td style="text-align:left;">{{ $quoteVehicle->vehicleMake->name }}</td>
        <td style="text-align:left; font-weight: bold;">Modelo:</td>
        <td style="text-align:left;">{{ $quoteVehicle->vehicleModel->name }}</td>
    </tr>
    <tr>
        <td style="text-align:left; font-weight: bold;">Año:</td>
        <td style="text-align:left;">{{ $quoteVehicle->vehicle_year }}</td>
        <td style="text-align:left; font-weight: bold;">Chasis:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue('Chasis') }}</td>
        <td style="text-align:left; font-weight: bold;">Valor asegurado:</td>
        <td style="text-align:left;">{{ number_format($cotizacion->getFieldValue("Suma_asegurada"), 2) }}</td>
    </tr>
    <tr>
        <td style="text-align:left; font-weight: bold;">Prima Anual:</td>
        <td style="text-align:left;">{{ number_format($cotizacion->getFieldValue('Prima') * 12, 2) }}</td>
        <td style="text-align:left; font-weight: bold;">&nbsp;</td>
        <td style="text-align:left;">&nbsp;</td>
        <td style="text-align:left; font-weight: bold;">Prima Mensual:</td>
        <td style="text-align:left;">{{ number_format($cotizacion->getFieldValue('Prima'), 2) }}</td>
    </tr>
    </tbody>
</table>

@php
    $lineItemsData = [];
    $tipoVehiculo = $cotizacion->getFieldValue("Tipo_veh_culo");
    $isVehiculoPesado = preg_match('/\bpesado\b/i', $tipoVehiculo) || $tipoVehiculo === "Camión";

    foreach ($cotizacion->getLineItems() as $lineItem) {
        if ($lineItem->getProduct()->getEntityId() == $plan->getEntityId()) {
            $product = $libreria->getRecord("Products", $lineItem->getProduct()->getEntityId());
            $vendor = $libreria->getRecord("Vendors", $product->getFieldValue('Vendor_Name')->getEntityId());

            $lineItemsData[] = [
                'lineItem' => $lineItem,
                'product' => $product,
                'vendor' => $vendor,
                'vendorName' => $vendor->getFieldValue('Nombre'),
                'netTotal' => $lineItem->getNetTotal(),
                'monthlyTotal' => $lineItem->getNetTotal(),
            ];
        }
    }

    $coverageRows = [
        ['label' => 'Coberturas', 'field' => 'vendorName', 'type' => 'text','style'=>'font-weight: bold;"'],
        ['label' => 'Lesiones y/o muerte 1 persona', 'field' => 'Lesiones_muerte_1_pers', 'type' => 'number'],
        ['label' => 'Lesiones y/o muerte mas de 1 persona', 'field' => 'Lesiones_muerte_m_s_1_pers', 'type' => 'number'],
        ['label' => 'Daños a la propiedad ajena', 'field' => 'Da_os_propiedad_ajena', 'type' => 'number'],
        ['label' => 'Incendio y/o robo', 'field' => 'Incendio_y_robo', 'type' => 'percentage'],
        ['label' => 'Colisión y/o vuelco', 'field' => 'Colisi_n_y_vuelco', 'type' => 'percentage'],
        ['label' => 'Cobertura comprensiva', 'field' => 'Riesgos_comprensivos', 'type' => 'percentage'],
        ['label' => 'Rotura de cristales', 'field' => 'Rotura_de_cristales_deducible', 'type' => 'text'],
        ['label' => 'Fianza judicial', 'field' => 'Fianza_judicial', 'type' => 'number'],
        ['label' => 'Lesiones y/o muerte 1 pasajero', 'field' => 'Lesiones_muerte_1_pas', 'type' => 'number'],
        ['label' => 'Lesiones y/o muerte mas de 1 pasajero', 'field' => 'Lesiones_muerte_m_s_1_pas', 'type' => 'number'],
        ['label' => 'Riesgo conductor', 'field' => 'Riesgos_conductor', 'type' => 'number'],
        ['label' => 'Asistencia en viajes', 'field' => 'Asistencia_vial', 'type' => 'assistance'],
        ['label' => 'Centro del automovilista (CA)', 'field' => 'En_caso_de_accidente', 'type' => 'included'],
        ['label' => 'Plan renta', 'field' => 'Renta_veh_culo', 'type' => 'assistance'],
        ['label' => 'Vida (Cubre el saldo insoluto hasta)', 'field' => 'Vida', 'type' => 'number'],
        ['label' => 'Últimos gastos', 'field' => 'ltimos_gastos', 'type' => 'number'],
        ['label' => 'Deducible', 'field' => 'Deducible', 'type' => 'text', 'style'=>'font-weight: bold;"'],
        ['label' => 'Cruz Roja Dominicana (CRD)', 'field' => 'Cruz_roja', 'type' => 'included'],
        ['label' => 'Cobertura Extra', 'field' => 'Cobertura_extra', 'type' => 'optional_number'],
        ['label' => 'Cobertura Pink', 'field' => 'Cobertura_pink', 'type' => 'optional_number'],
        ['label' => 'Gastos Medicos', 'field' => 'Gastos_m_dicos', 'type' => 'optional_number'],
    ];
@endphp

<table style="width: 100%; border: 1px solid #000; border-collapse: collapse;">
    @foreach ($coverageRows as $row)
        <tr @isset($row['style'] ) style="{{ $row['style'] }}" @endisset>
            <td style="font-weight: bold;">{{ $row['label'] }}</td>
            @foreach ($lineItemsData as $data)
                <td>
                    @switch($row['type'])
                        @case('text')
                            @if ($row['field'] === 'vendorName')
                                {{ $data['vendorName'] }}
                            @else
                                {{ $data['product']->getFieldValue($row['field']) }}
                            @endif
                            @break

                        @case('number')
                            {{ number_format($data['product']->getFieldValue($row['field'])) }}
                            @break

                        @case('percentage')
                            {{ $data['product']->getFieldValue($row['field']) }}%
                            @break

                        @case('assistance')
                            @if ($data['product']->getFieldValue($row['field']) == 1)
                                {{ $isVehiculoPesado ? 'No incluida' : 'Incluida' }}
                            @else
                                No incluida
                            @endif
                            @break

                        @case('included')
                            {{ !empty($data['product']->getFieldValue($row['field'])) ? 'Incluida' : 'No incluida' }}
                            @break

                        @case('optional_number')
                            @if (!empty($data['product']->getFieldValue($row['field'])))
                                {{ number_format($data['product']->getFieldValue($row['field'])) }}
                            @else
                                No incluida
                            @endif
                            @break
                    @endswitch
                </td>
            @endforeach
        </tr>
    @endforeach
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
