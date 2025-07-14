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

<table>
    <tbody>
    <tr>
        <td style="text-align:left; font-weight: bold;">Ramo/Producto:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue('Plan') }}</td>
        <td style="text-align:center; font-weight: bold;">Correo:</td>
        <td style="text-align:center;">{{ $cotizacion->getFieldValue('Correo_electr_nico') }}</td>
        <td style="text-align:right; font-weight: bold;">Fecha:</td>
        <td style="text-align:right;">{{ date('d/m/Y', strtotime($cotizacion->getCreatedTime())) }}</td>
    </tr>
    <tr>
        <td style="text-align:left; font-weight: bold;">Cliente:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue("Nombre") . " " . $cotizacion->getFieldValue("Apellido") }}</td>
        <td style="text-align:center; font-weight: bold;">Equipamientos:</td>
        <td style="text-align:center;">{{ 'NINGUNO' }}</td>
        <td style="text-align:right; font-weight: bold;">Cédula/Pasaporte:</td>
        <td style="text-align:right;">{{ $cotizacion->getFieldValue('RNC_C_dula') }}</td>
    </tr>
    <tr>
        <td style="text-align:left; font-weight: bold;">Dirección:</td>
        <td style="text-align:left;"><p style="font-size: 8px">{{ $cotizacion->getFieldValue('Direcci_n') }}</p></td>
        <td style="text-align:center; font-weight: bold;">Uso:</td>
        <td style="text-align:center;">{{ $cotizacion->getFieldValue('Uso') }}</td>
        <td style="text-align:right; font-weight: bold;">Teléfono:</td>
        <td style="text-align:right;">{{ $cotizacion->getFieldValue('Tel_Residencia') }}</td>
    </tr>
    <tr>
        <td style="text-align:left; font-weight: bold;">Tipo de vehículo:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue('Tipo_veh_culo') }}</td>
        <td style="text-align:center; font-weight: bold;">Marca:</td>
        <td style="text-align:center;">{{ $cotizacion->getFieldValue('Marca')->getLookupLabel() }}</td>
        <td style="text-align:right; font-weight: bold;">Modelo:</td>
        <td style="text-align:right;">{{ $cotizacion->getFieldValue('Modelo')->getLookupLabel() }}</td>
    </tr>
    <tr>
        <td style="text-align:left; font-weight: bold;">Año:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue('A_o') }}</td>
        <td style="text-align:center; font-weight: bold;">Chasis:</td>
        <td style="text-align:center;">{{ $cotizacion->getFieldValue('Chasis') }}</td>
        <td style="text-align:right; font-weight: bold;">Valor asegurado:</td>
        <td style="text-align:right;">{{ number_format($cotizacion->getFieldValue("Suma_asegurada"), 2) }}</td>
    </tr>
    </tbody>
</table>

@php
    $lineItemsData = [];
    $tipoVehiculo = $cotizacion->getFieldValue("Tipo_veh_culo");
    $isVehiculoPesado = preg_match('/\bpesado\b/i', $tipoVehiculo) || $tipoVehiculo === "Camión";

    foreach ($cotizacion->getLineItems() as $lineItem) {
        if ($lineItem->getNetTotal() > 0) {
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
        ['label' => 'Coberturas', 'field' => 'vendorName', 'type' => 'text'],
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
        ['label' => 'Deducible', 'field' => 'Deducible', 'type' => 'text'],
        ['label' => 'Cruz Roja Dominicana (CRD)', 'field' => 'Cruz_roja', 'type' => 'included'],
        ['label' => 'Cobertura Extra', 'field' => 'Cobertura_extra', 'type' => 'optional_number'],
        ['label' => 'Cobertura Pink', 'field' => 'Cobertura_pink', 'type' => 'optional_number'],
        ['label' => 'Gastos Medicos', 'field' => 'Gastos_m_dicos', 'type' => 'optional_number'],
    ];
@endphp

<table style="width: 100%; border: 1px solid #000; border-collapse: collapse;">
    @foreach ($coverageRows as $row)
        <tr>
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

    <tr>
        <td style="font-weight: bold;">PRIMAS PROPUESTAS</td>
        @foreach ($lineItemsData as $data)
            <td>&nbsp;</td>
        @endforeach
    </tr>

    <tr>
        <td style="font-weight: bold;">&nbsp;</td>
        @foreach ($lineItemsData as $data)
            <td style="font-weight: bold;">{{ $data['vendorName'] }}</td>
        @endforeach
    </tr>

    <tr>
        <td style="font-weight: bold;">Prima {{ $cotizacion->getFieldValue('Tipo_de_pago') }}</td>
        @foreach ($lineItemsData as $data)
            <td>{{ number_format($data['monthlyTotal'], 2) }}</td>
        @endforeach
    </tr>
</table>

<table style="width: 100%; border-collapse: collapse; font-size: 12px;">
    <tr>
        <td style="padding: 10px;">

            <p>
                a) Las aseguradoras, al efectuar su proceso de evaluación de riesgo, se reservan el derecho de
                aceptación del mismo. En caso de que la aseguradora seleccionada decline el riesgo, el cliente
                será notificado y deberá escoger otra aseguradora que haya presentado cotización.
            </p>

            <p>
                b) Las aseguradoras se reservan el derecho para realizar variación de prima y coberturas en esta cotización de seguros
                suscrita con el cliente.
            </p>

            <p>
                c) <b>Exclusión por mora:</b><br>
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

</body>
</html>
