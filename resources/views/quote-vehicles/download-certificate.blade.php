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
        <td style="border: none; text-align:left;">Automóvil</td>
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
        <td style="border: none; text-align:left;">{{ $customer->address }}</td>
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
        ['label' => 'RESP. CIVIL', 'field' => 'Resp_civil', 'type' => 'text2','style'=>'border: none;'],
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

                        @case('text2')
                            @if (empty($data['product'][$row['field']]))
                                No aplica
                            @else
                                @if ($quoteVehicle->leasing === false)
                                    No aplica
                                @else
                                    {{ $data['product'][$row['field']] }}
                                @endif
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
        <td style="border: none; font-weight: bold;">Prima Anual I/ISC</td>
        @foreach ($lineItemsData as $data)
            <td>{{ number_format($data['netTotal'], 2) }}</td>
        @endforeach
    </tr>

    <tr>
        <td style="border: none; font-weight: bold;">Prima Mensual I/ISC</td>
        @foreach ($lineItemsData as $data)
            <td>{{ number_format($data['monthlyTotal'], 2) }}</td>
        @endforeach
    </tr>
</table>

<div style="page-break-after: always;"></div>

<table style="width: 100%; font-size: 12px;">
    <tr>
        <td style="padding: 10px;">
            <p>
                A. Autorizo que la prima correspondiente a los seguros aceptados por mi persona sean adicionadas a la
                cuota del préstamo otorgado a mi favor por Banco Múltiple Caribe, S. A., hasta sus intereses, entidad
                que ha asumido la responsabilidad de entregar a la aseguradora dicha partida, de conformidad a acuerdo
                entre ambas partes.
            </p>

            <p>
                B. Por este medio, les autorizo endosar mi póliza de Vehículo No. {{ $productCRM['P_liza'] }}, por el
                monto de RD${{ number_format($quoteVehicle->vehicle_amount, 2) }} a favor de Banco Múltiple Caribe, S.
                A., hasta sus intereses.
            </p>

            <p>
                C. La cobertura otorgada bajo esta póliza queda condicionada a las cláusulas y condiciones especificadas
                en los anexos, los cuales han sido incluidos en la póliza definitiva, cuyas condiciones completas están
                contenidas en la copia que reposa en la entidad Financiera y Aseguradora.
            </p>

            <ul>
                <li>Podrán consultarla a través de la página de internet
                    www.bancocaribe.com.do/seguroscaribe/vehiculos.
                </li>
                <li>Las condiciones de la póliza pueden ser solicitadas en {{ $vendorCRM['Nombre'] }}. Puede dirigirse a
                    su oficina principal en la {{ $vendorCRM['Street'] }} o contactarse al {{ $vendorCRM['Phone'] }}.
                </li>
                <li>Pueden contactarse con Sentinel Corredores de Seguros al 809-732-0202 o dirigirse a su oficina en la
                    calle César A. Canó No. 354, Las Praderas, Santo Domingo.
                </li>
            </ul>

            <p>
                D. La cobertura de vida cubrirá el préstamo del deudor de Banco Caribe hasta el saldo insoluto y hasta
                sus intereses sin exceder los RD$300,000.00 y según condiciones generales de la póliza.
            </p>

            <p>
                E. La cobertura últimos gastos indicada en este certificado indemnizará al beneficiario (declarado en la
                solicitud de vida) al momento del fallecimiento del asegurado y deudor de Banco Caribe, siempre y cuando
                el valor adeudado y hasta sus intereses, no excedan los RD$300,000.00 según condiciones generales de la
                póliza.
            </p>

            <p>
                F. Los asegurados deberán comunicar al banco y a la aseguradora, para que sea de su conocimiento
                cualquier cambio de propietario del vehículo asegurado, así como tambien en caso de que el vehículo
                asegurado sea sustituido por otro, de acuerdo con la política del banco.
            </p>

            <p>
                G. En los casos Salvamento, la aseguradora se reserva el derecho de cubrir únicamente la deuda del
                siniestro de acuerdo con el valor del vehículo en el mercado al momento del evento.
            </p>

            <p>
                H. El salvamento al 100% es propiedad de la compañía de seguros una vez se haya indemnizado el valor
                aseguro.
            </p>

            <p>
                I. En caso de ocurrir un accidente cubierto bajo las condiciones de esta póliza cuya reparación origine
                la sustitución de partes, piezas y accesorios del vehículo asegurado, si dichas partes, piezas y
                accesorios no pueden ser suministradas por no disponer de existencia los distribuidores del
                país, {{ $vendorCRM['Nombre'] }} no será responsable del sobreprecio que se produzca para obtenerlas en
                mercados extranjeros, ni de las demoras generadas en el proceso de importación de las mismas, quedando
                expresamente entendido que en ningún caso dichas demoras obligaran a la aseguradora a la liquidación del
                vehículo asegurado en caso que aplique.
            </p>

            <p>
                J. En caso de accidente, el asegurado deberá proteger el vehículo asegurado contra toda ulterior pérdida
                o daño. Cualquier daño que ocurra directa o indirectamente por falta de protección por parte del
                asegurado, no será indemnizable bajo esta póliza.
            </p>

            <p>
                K. <b>Exclusión por mora</b>
            </p>

            <p>
                El cliente que presente un atraso de más de 120 días será excluido de la póliza de vehículos. Efectuado
                el pago el cliente deberá pasar por una sucursal de Banco Caribe, donde se le realizará la re-inspección
                del vehículo, de no proceder con la misma continuará sin cobertura de póliza.
            </p>

            <p>
                L. <b>Vigencia:</b> La póliza estará valida hasta la cancelación del préstamo.
            </p>

            <p>
                <b>Al firmar acepta todas las condiciones detalladas en esta cotización de la aseguradora
                    seleccionada</b>
            </p>
        </td>
    </tr>
</table>

<div style="height: 20px;"></div>

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

<div style="page-break-after: always;"></div>

<h3 style="text-align:center;">PRINCIPALES CONDICIONES POLIZA DE VEHICULOS DE MOTOR</h3>

<table style="width: 100%; font-size: 12px;">
    <tr>
        <td style="width: 50%; padding: 10px; vertical-align: top;">
            <p>
                <b>II.-EXCLUSIONES</b> <br>
                Además de las Exclusiones señaladas en las Condiciones Generales de
                la Póliza Maestra
            </p>

            <p>
                • 1. Accesorios, equipos y aditamentos que no sean de fábrica, a menos
                que hayan sido declarados previamente.
                <br>
                • 2. Robo y hurto de herramientas y/o cualquier propiedad que se
                transporten en el vehículo asegurado.
                <br>
                • 3. Daños incurridos a consecuencia de la negligencia o descuido del
                asegurado en el mantenimiento del vehículo asegurado.
                <br>
                • 4. Daños ocasionados, si el vehículo está siendo utilizado para fines que
                no sea el uso privado.
                <br>
                • 5. Daños ocasionados, si el vehículo está siendo utilizado para proactivas
                de aprendizaje o de entrenamiento o fuese utilizado para transporte de
                explosivos o materiales inflamables.
                <br>
                • 6. Daños ocurridos mientras el vehículo de motor fuese conducido por
                personas sin licencia de conducir o que no estén capacitadas y
                autorizadas legalmente para dirigir este tipo de vehículos; o que se
                encuentre bajo influencia de bebidas embriagantes o drogas toxicas o
                heroicas.
                <br>
                • 7. Asegurados extranjeros. En caso de adquirir su residencia en la Rep.
                Dom. estos deben estar sometidos a las leyes de la Rep. Dom.
                <br>
                • 8. Daños causados por sistemas de gas o combustibles alternos,
                instalados en el vehículo asegurado, a menos que haya sido señalado
                por escrito por el asegurado y se haga constar en la póliza mediante
                endoso.
            </p>

            <p>
                <b>III. PUNTOS IMPORTANTE DE SU POLIZA:</b>
            </p>

            <p>
                • La prima es revisable y está sujeta a cambios sin previo aviso por la
                compañía.
                <br>
                • Valor Asegurado: El valor asegurado del vehículo debe ser igual a su
                valor real. Si el valor asegurado es inferior al valor real en el mercado, el
                asegurado se convierte en su propio asegurador de la parte no cubierta.
                La compañía aseguradora solo será responsable por aquella parte de la
                perdida en la proporción en la que tenga el valor real con la suma
                asegurada.
                <br>
                • Pago de una reclamación: La compañía puede optar libremente a
                efectuar el pago de una reclamación por uno de los siguientes modos:
            </p>
        </td>
        <td style="width: 50%; padding: 10px; vertical-align: top;">
            <p>
                • Pagando en efectivo el valor de la pérdida.
                <br>
                • Realizando por su cuenta las reparaciones necesarias.
                <br>
                • Cancelación de la póliza: Este contrato puede ser cancelado en cualquier
                momento por la compañía aseguradora sujeto a que se le avise al
                asegurado 10 días antes de la fecha en que será efectiva.
                <br>
                • <b>Deducible: Para los daños propios, la compañía aseguradora
                    indemnizara al asegurado descontando el deducible aplicable a
                    cada cobertura.</b>
                <br>
                • Gastos incurridos por el asegurado: Excepto gastos médicos de primeros
                auxilios o de protección a un vehículo afectado por un accidente cubierto,
                el asegurado no puede incurrir en gastos de reparación u otros con
                previa autorización del asegurador.
                <br>
                • Valor Máximo del vehículo asegurado: Es el valor convenido entre el
                asegurador y la compañía aseguradora y que figura en las declaraciones
                de esta póliza. Como consecuencia de la depreciación del vehículo, este
                valor se reducirá en un 1.75% mensual para todos los tipos de vehículos.
                <br>
                • Nulidad de Cobertura: El presente seguro quedara nulo en sí mismo por
                cualquier declaración falsa e inexacta, o, por ocultación de hechos o
                circunstancias, o por fraude al hacerse una reclamación.
            </p>

            <p>
                El solicitante autoriza expresa e irrevocablemente a Humano a
                suministrar a centros de información crediticia la información patrimonial
                y extramatrimonial necesarios a los fines de evaluación de crédito, por
                parte de otras instituciones suscriptores de dicho centros de información,
                reconociendo y garantizando que la revelación de dichas informaciones
                por parte de Humano y por sus respectivos empleados, funcionarios y
                accionistas, no conllevará violación de secreto profesional a los efectos
                del Articulo 377 de Código Penal, ni bajo ningún otro texto legal, al tiempo
                de renuncia expresa y formalmente al ejercicio de cualesquiera acciones
                o demandas a los fines de la reclamación de daños y perjuicios por dicha
                causa, o por el suministro de información inexacta y prometiendo la
                sumisión de sus representantes, accionistas y demás causas habitantes
                a lo pactado en este Articulo en virtud de las disposiciones del Articulo
                1120 del código civil.
            </p>

            <p>
                Para conocer las condiciones generales de su póliza, contacte con una
                de nuestras oficinas-Contrato registrado en Pro consumidor bajo
                resolución No. 275.
            </p>
        </td>
    </tr>
</table>

<div style="height: 20px;"></div>

<table style="width: 100%; border: none; border-collapse: collapse;">
    <tr>
        <td style="width: 50%; border: none; padding: 10px; vertical-align: top;">
            ________________________________ <br>
            Firma y sello autorizado
        </td>
        <td style="width: 50%; border: none; padding: 10px; vertical-align: top;">
            ________________________________ <br>
            Fecha
        </td>
        <td style="width: 50%; border: none; padding: 10px; vertical-align: top;">
            ________________________________ <br>
            Nombre o Firma del asegurado
        </td>
    </tr>
</table>

<div style="page-break-after: always;"></div>

@for($i = 0; $i < 2; $i++)
    <table style="width: 100%; border: none; border-collapse: collapse;">
        <tr>
            <td style="width: 50%;  border: 2px solid black; padding: 10px; vertical-align: top;">
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

                <h4 style="text-align:right;">Póliza No.: {{ $productCRM['P_liza'] }}</h4>

                <table style="width: 100%; border: none;">
                    <tbody>
                    <tr>
                        <td style="border: none; text-align:left; font-weight: bold;">Asegurado:</td>
                        <td style="border: none; text-align:left;">{{ $customer->full_name }}</td>
                        <td style="border: none; text-align:left; font-weight: bold;">&nbsp;</td>
                        <td style="border: none; text-align:left;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border: none; text-align:left; font-weight: bold;">Desde:</td>
                        <td style="border: none; text-align:left;">{{ date('d/m/Y', strtotime($quote->start_date)) }}</td>
                        <td style="border: none; text-align:left; font-weight: bold;">Hasta:</td>
                        <td style="border: none; text-align:left;">{{ date('d/m/Y', strtotime($quote->end_date)) }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; text-align:left; font-weight: bold;">Marca:</td>
                        <td style="border: none; text-align:left;">{{ $quoteVehicle->vehicleMake->name }}</td>
                        <td style="border: none; text-align:left; font-weight: bold;">Modelo:</td>
                        <td style="border: none; text-align:left;">{{ $quoteVehicle->vehicleModel->name }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; text-align:left; font-weight: bold;">Año:</td>
                        <td style="border: none; text-align:left;">{{ $quoteVehicle->vehicle_year }}</td>
                        <td style="border: none; text-align:left; font-weight: bold;">Tipo:</td>
                        <td style="border: none; text-align:left;">{{ $quoteVehicle->vehicleType->name }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; text-align:left; font-weight: bold;">Chasis:</td>
                        <td style="border: none; text-align:left;">{{ $vehicle->chassis }}</td>
                        <td style="border: none; text-align:left; font-weight: bold;">Registro:</td>
                        <td style="border: none; text-align:left;"></td>
                    </tr>
                    </tbody>
                </table>

                <p style="font-weight: bold;">
                    La cobertura estará vigente hasta la cancelación del préstamo sujeto a términos de la póliza.
                </p>
            </td>

            <td style="width: 50%;  border: 2px solid black; padding: 10px; vertical-align: top;">
                <h4>
                    &nbsp;
                </h4>

                <h4 style="text-align:center; font-weight: normal;">
                    Servicio al Cliente: {{ $vendorCRM['Phone'] }}
                </h4>

                <h4>
                    &nbsp;
                </h4>

                <h4 style="text-align:center; font-weight: normal;">
                    {{ $vendorCRM['Street'] }}
                </h4>

                <h4>
                    &nbsp;
                </h4>

                <h4 style="text-align:center; font-weight: normal;">
                    Centro Automovilista
                </h4>

                <h4>
                    &nbsp;
                </h4>

                <h4 style="text-align:center; font-weight: normal;">
                    809-565-8222
                </h4>

                <h4>
                    &nbsp;
                </h4>

                <h4 style="text-align:center; font-weight: normal;">
                    El marbete definitivo podrá ser retirado en la aseguradora en un plazo de 30 días.
                </h4>
            </td>
        </tr>
    </table>
@endfor

<div style="page-break-after: always;"></div>

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

<h1 style="text-align:right;"><i> Formulario de vida Deudor y Ultimos Gastos</i></h1>

<table style="width: 100%; border: none;">
    <tbody>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">A favor de:</td>
        <td style="border: none; text-align:left;">Banco Múltiple Caribe, S. A.</td>
        <td style="border: none; text-align:left; font-weight: bold;">Oficina:</td>
        <td style="border: none; text-align:left;"></td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Valor del Préstamo:</td>
        <td style="border: none; text-align:left;">{{ number_format($quoteVehicle->loan_amount, 2) }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Fecha:</td>
        <td style="border: none; text-align:left;">{{ date('d/m/Y', strtotime($quote->start_date)) }}</td>
    </tr>
    </tbody>
</table>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td colspan="4" style="text-align: center;"><strong>DATOS DEL ASEGURADO/DEUDOR</strong></td>
    </tr>
    <tr>
        <td colspan="4"><strong>Nombre del Cliente:</strong> {{ $customer->full_name }}</td>
    </tr>
    <tr>
        <td><strong>Sexo:</strong> M ☐ F ☐</td>
        <td><strong>Estado Civil:</strong> Soltero(a) ☐ Casado(a) ☐ Divorciado(a) ☐ Unión Libre ☐</td>
        <td><strong>Cédula/Pasaporte:</strong> {{ $customer->identity_number }}</td>
        <td><strong>Fecha Nacimiento / Edad: {{ $customer->age }}</strong></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Ocupación Principal:</strong></td>
        <td colspan="2"><strong>Otras ocupaciones:</strong></td>
    </tr>
    <tr>
        <td colspan="4"><strong>Lugar de Nacimiento:</strong></td>
    </tr>
    <tr>
        <td><strong>Estatura (pies/pulgadas):</strong></td>
        <td><strong>Peso (lbs):</strong></td>
        <td><strong>Suma asegurada vida:</strong> <br> Cubre saldo insoluto hasta RD$ 300,000.00</td>
        <td><strong>Suma asegurada últimos gastos:</strong> RD$ 50,000.00</td>
    </tr>
    <tr>
        <td colspan="4"><strong>Dirección:</strong> {{ $customer->address }}</td>
    </tr>
    <tr>
        <td><strong>Celular:</strong> {{ $customer->mobile_phone }}</td>
        <td><strong>Tel. Residencia:</strong> {{ $customer->home_phone }}</td>
        <td><strong>Tel. Oficina:</strong> {{ $customer->work_phone }}</td>
        <td><strong>Email:</strong> {{ $customer->email }}</td>
    </tr>
</table>

<br>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr>
        <td><strong>Beneficiario Últimos Gastos:</strong></td>
    </tr>
    <tr>
        <td>_____________________________________________________________________</td>
    </tr>
    <tr>
        <td><em>Beneficiario no aplica para vida deudor</em></td>
    </tr>
</table>

<br>

<h3>Cuestionario de Salud</h3>
<p>
    En Caso de contestar afirmativamente cualquiera de las preguntas, favor dar detalles, indicando: nombre, fechas, tratamientos (si los
    hubo) y condición actual.
</p>
<ol>
    <li>
        ¿Ha sufrido alguna vez enfermedades cardiacas, del sistema respiratorio, diabetes, cáncer, enfermedades de los riñones o del
        sistema genitourinario en general, enfermedades hepáticas, afecciones de la próstata (si es hombre), úlceras, hipertensión arterial, SIDA
        o condiciones relacionadas a este padecimiento, trastornos de órganos
        femeninos (si es mujer)? Si/No, En caso afirmativo, indique cantidad de meses:
    </li>
    <br><br><br>
    <li>¿Ha padecido alguna enfermedad o ha sufrido alguna lesión no mencionada en la pregunta anterior? Si/No</li>
    <br><br><br>
    <li>¿Alguna vez su seguro ha sido rechazado o modificado? Detalles:</li>
</ol>

<br><br>

<p>
    Autorizo a cualquier hospital, clínica o médico para compartir información médica con Humano Seguros...
</p>

<br><br>

<p style="text-align: center;">
    _____________________________________<br>
    Firma del Asegurado/Deudor
</p>

</body>
</html>
