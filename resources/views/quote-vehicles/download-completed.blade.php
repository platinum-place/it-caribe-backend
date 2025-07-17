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
</table>

<div style="page-break-before: always;"></div>

<table style="width: 100%; border-collapse: collapse; font-size: 12px;">
    <tr>
        <td style="padding: 10px;">
            <p>
                A) Autorizo que la prima correspondiente a los seguros aceptados por mi persona sean adicionadas a la
                cuota del préstamo otorgado a mi favor por
                Banco Múltiple Caribe, S. A., hasta sus intereses, entidad que ha asumido la responsabilidad de entregar
                a la aseguradora dicha partida, de
                conformidad a acuerdo entre ambas partes.
            </p>

            <p>
                B) Por este medio, les autorizo endosar mi póliza de Vehículo No. Auto-1451118 por el monto de RD$
                820,000.00 a favor de Banco Múltiple Caribe, S.
                A., hasta sus intereses.
            </p>

            <p>
                C) La cobertura otorgada bajo esta póliza queda condicionada a las cláusulas y condiciones especificadas
                en los anexos, los cuales han sido
                incluidos en la póliza definitiva, cuyas condiciones completas están contenidas en la copia que reposa
                en la entidad financiera y aseguradora.
            </p>

            <ul>
                <li>Podrán consultarla a través de la página de internet
                    www.bancocaribe.com.do/seguroscaribe/vehiculos.
                </li>
                <li>Las condiciones generales de la póliza podrán ser solicitadas en Monumental de Seguros. Puede
                    dirigirse a su oficina principal en la Av. Max
                    Enrique Ureña No. 459, Santo Domingo, o contactarse al 809-487-0000.
                </li>
                <li>Puede contactarse con Sentinel corredores de seguros al 809-732-0202 o dirigirse a su oficina en la
                    calle Cesar A. Canó No. 354. Las praderas.
                    Santo Domingo.
                </li>
            </ul>

            <p>
                D) La cobertura de vida cubrirá el préstamo del deudor de Banco Caribe hasta el saldo insoluto y hasta
                sus intereses, sin exceder los RD$300,000.00,
                según las condiciones generales de la póliza.
            </p>

            <p>
                E) La cobertura de últimos gastos indicada en este certificado indemnizará al beneficiario (declarado en
                la solicitud de vida) en el momento del
                fallecimiento del asegurado y deudor de Banco Caribe, siempre que el valor adeudado y hasta sus
                intereses no excedan los RD$300,000.00, según
                las condiciones generales de la póliza.
            </p>

            <p>
                F) Los asegurados deberán comunicar al banco y a la aseguradora cualquier cambio de propietario del
                vehículo asegurado, así como también en
                caso de que el vehículo asegurado sea sustituido por otro, de acuerdo con la política del banco.
            </p>

            <p>
                G) En caso de ocurrir un accidente cubierto bajo las condiciones de esta póliza cuya reparación requiera
                la sustitución de partes, piezas y accesorios
                del vehículo asegurado, si dichas partes, piezas y accesorios no pueden ser suministradas por falta de
                existencias en los distribuidores del país, La
                Monumental de Seguros no será responsable del sobreprecio que se produzca para obtenerlas en mercados
                extranjeros ni de las demoras generadas
                en el proceso de importación de las mismas. Se entiende expresamente que en ningún caso dichas demoras
                obligarán a la aseguradora a la
                liquidación del vehículo asegurado si aplica.
            </p>

            <p>
                H) En los casos de salvamento, la aseguradora se reserva el derecho de cubrir únicamente la deuda del
                siniestro de acuerdo con el valor del vehículo en el mercado al momento del evento.
            </p>

            <p>
                I) El salvamento al 100% es propiedad de la compañía de seguros una vez se haya indemnizado el valor
                asegurado.
            </p>

            <p>
                J) En caso de accidente, el asegurado deberá proteger el vehículo asegurado contra toda pérdida o daño
                adicional. Cualquier daño que ocurra,
                directa o indirectamente, por falta de protección por parte del asegurado no será indemnizable bajo esta
                póliza.
            </p>

            <p>
                <b>K) Exclusión por mora:</b>
            </p>

            <p>
                El cliente que presente un atraso de más de 120 días será excluido de la póliza de vehículos. Efectuado
                el pago, el cliente deberá pasar por una
                sucursal de Banco Caribe, donde se realizará la reinspección del vehículo. Si no procede con la misma,
                continuará sin cobertura de póliza.
            </p>

            <p>
                L) Vigencia: La póliza estará válida hasta la cancelación del préstamo.
            </p>
        </td>
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

<div style="page-break-before: always;"></div>

<h3 style="text-align:center;">PRINCIPALES CONDICIONES POLIZA DE VEHICULOS DE MOTOR</h3>

<table style="width: 100%; border-collapse: collapse; font-size: 12px; margin-top: 20px;">
    <tr>
        <td style="width: 50%; padding: 10px; vertical-align: top; border: none;">
            <h4>II.-EXCLUSIONES</h4>
            <p>Además de las Exclusiones señaladas en las Condiciones Generales de la Póliza Maestra</p>

            <p>
                1. Accesorios, equipos y aditamentos que no sean de fábrica, a menos que hayan sido declarados
                previamente.
            </p>

            <p>
                2. Robo y hurto de herramientas y/o cualquier propiedad que se transporten en el vehículo asegurado.
            </p>
        </td>
        <td style="width: 50%; padding: 10px; vertical-align: top; border: none;">
            <h4>III.-OTRO TEXTO</h4>
            <p>3. Daños incurridos a consecuencia de la negligencia o descuido del asegurado en el mantenimiento del
                vehículo asegurado.</p>

            <p>4. Daños ocasionados, si el vehículo está siendo utilizado para fines que no sea el uso privado.</p>
        </td>
    </tr>
</table>

</body>
</html>
