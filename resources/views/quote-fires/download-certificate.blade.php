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
        <td style="border: none; text-align:left;">{{ $customer->address }}</td>
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

<h3 style="text-align:center;">DETALLE FACILIDAD</h3>

<table style="width: 100%; border: none;">
    <tbody>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Valor Financiado:</td>
        <td style="border: none; text-align:left;">${{ number_format($quoteFire->property_value, 2) }}</td>
        <td style="border: none; text-align:left; font-weight: bold;">Construcción:</td>
        <td style="border: none; text-align:left;">NO</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Valor Tasación:</td>
        <td style="border: none; text-align:left;">${{ '' }}</td> {{--   TODO --}}
        <td style="border: none; text-align:left; font-weight: bold;">Tipo Construcción:</td>
        <td style="border: none; text-align:left;">{{ $quoteFire->quoteFireConstructionType->name }}</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Ubicación:</td>
        <td style="border: none; text-align:left;"><p style="font-size: 8px">{{ $quoteFire->property_address }}</p></td>
        <td style="border: none; text-align:left; font-weight: bold;">Giro del Negocio:</td>
        <td style="border: none; text-align:left;">{{ '' }}</td>  {{--   TODO --}}
    </tr>
    </tbody>
</table>

<div style="height: 10px;"></div>

<table style="width: 100%; border: none; border-collapse: collapse;">
    <thead>
    <tr>
        <th style="border: none; text-align:left;">Aseguradora</th>
        <th style="border: none; text-align:left;">Años</th>
        <th style="border: none; text-align:left;">Valor</th>
        {{--        <th style="border: none; text-align:left;">Clasificación</th>--}}
        <th style="border: none; text-align:left;">Prima Vida</th>
        <th style="border: none; text-align:left;">Edad al Terminar</th>
        <th style="border: none; text-align:left;">Prima Incendio</th>
        <th style="border: none; text-align:left;">Prima Total</th>
        <th style="border: none; text-align:left;">Prima Anual</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="border: none; text-align:left;">{{ ucwords(strtolower($vendorCRM['Nombre'])) }}</td>
        <td style="border: none; text-align:left;">{{ $quoteFire->deadline }}</td>
        <td style="border: none; text-align:left;">{{ number_format($quoteFire->property_value, 2) }}</td>
        <td style="border: none; text-align:left;">{{ number_format($selectedLine->life_amount, 2) }}</td>
        <td style="border: none; text-align:left;">{{ $customer->age + $quoteFire->deadline }}</td>
        <td style="border: none; text-align:right;">{{ number_format($selectedLine->fire_amount, 2) }}</td>
        <td style="border: none; text-align:right;">{{ number_format($selectedLine->quoteLine->total, 2) }}</td>
        <td style="border: none; text-align:right;">{{ number_format($selectedLine->quoteLine->total * 12, 2) }}</td>
    </tr>
    </tbody>
</table>

<h3 style="text-align:center;">COBERTURAS</h3>

<table style="width: 100%; border: none;">
    <tbody>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Cobertura Incendio</td>
        <td style="border: none; font-weight: bold; text-align:left;">{{ ucwords(strtolower($selectedLine->quoteLine->name)) }}</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Asistencia domiciliaria</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Incendio y/o rayo</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Terremoto/ temblor de tierra</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Colapso y/o derrumbe de edificio</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Huracán, ciclón, tornado y manga de viento</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Daños por agua a consecuencia de huracán</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Inundación y ras de mar</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Granizo</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Daños por naves aéreas y vehículos terrestres</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Explosión</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Motín, huelga, daños malicioso y vandalismo</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Daños por humo</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Inhabilitación de la vivienda</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Perdida de alquiler</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Daños estéticos</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Medidas adoptadas durante el siniestro</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Destrucción de documentos públicos</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Últimos gastos</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Últimos gastos</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Cobertura Incendio</td>
        <td style="border: none; font-weight: bold; text-align:left;">{{ ucwords(strtolower($selectedLine->quoteLine->name)) }}</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Daños por Agua Accidental</td>
        <td style="border: none; font-weight: bold; text-align:left;">15%</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Remoción de escombros</td>
        <td style="border: none; font-weight: bold; text-align:left;">10%</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Interrupción de Hogar de la propiedad</td>
        <td style="border: none; font-weight: bold; text-align:left;">Límite 2 cuotas hasta RD$25,000.00</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Huracán, ciclón, y tornado</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Daños por agua a consecuencia de ciclón</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Deducible</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Riesgos Catastróficos</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Daños por agua accidental</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Solo cubre edificación</td>
        <td style="border: none; font-weight: bold; text-align:left;">Incluido</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Responsabilidad civil básica</td>
        <td style="border: none; font-weight: bold; text-align:left;">RD$1,000,000</td>
    </tr>
    <tr>
        <td style="border: none; text-align:left; font-weight: bold;">Motín y Huelga</td>
        <td style="border: none; font-weight: bold; text-align:left;"></td>
    </tr>
    </tbody>
</table>

<div style="page-break-after: always;"></div>

<table style="width: 100%; font-size: 12px;">
    <tr>
        <td style="padding: 10px;">
            <p>
                A. Las aseguradoras, al efectuar su proceso de evaluación de riesgo, se reservan el derecho de aceptación del mismo. En caso de que la aseguradora seleccionada decline el riesgo, el cliente será notificado y deberá, de inmediato, escoger otra aseguradora que haya presentado cotización.
            </p>

            <p>
                B. Autorizo que la prima correspondiente a los seguros aceptados por mi persona sea adicionada a la cuota del préstamo otorgado a mi favor por Banco Múltiple Caribe, S.A., entidad que asume la responsabilidad de entregar a la aseguradora dicha partida, de conformidad a acuerdo entre ambas partes.
            </p>

            <p>
                C. Por este medio, autorizo el endoso de mi póliza a favor de Banco Múltiple Caribe, S.A., hasta sus intereses.
            </p>

            <p>
                D. La aseguradora se reserva el derecho para realizar variaciones de prima y coberturas en la cotización de seguros suscrita con el cliente, con previa comunicación al banco y al cliente.
            </p>

            <p>
                E. Propiedades en proximidades mayores o iguales a 500 metros de playas o ríos deben ser inspeccionadas por la aseguradora antes de formalizar la facilidad.
            </p>

            <p>
                F. La cobertura otorgada bajo esta póliza queda condicionada a las cláusulas y condiciones especificadas en los anexos, los cuales han sido incluidos en la póliza definitiva, cuyas condiciones completas están contenidas en la copia que reposa en la entidad Financiera y Aseguradora:
                <br>• Podrán consultarla a través de la página de internet <a href="https://www.bancocaribe.com.do/seguroscaribe/seguro-de-incendio" target="_blank">www.bancocaribe.com.do/seguroscaribe/seguro-de-incendio</a>.
                <br>• Las condiciones de la póliza pueden ser solicitadas en {{ $vendorCRM['Nombre'] }}. Puede dirigirse a su oficina principal en la {{ $vendorCRM['Street'] }} o contactarse al {{ $vendorCRM['Phone'] }}.
                <br>• Pueden contactarse con Sentinel Corredores de Seguros al 809-732-0202 o dirigirse a su oficina en la calle César A. Canó No. 354, Las Praderas, Santo Domingo.
            </p>

            <p>
                G. Vigencia: Esta póliza será válida hasta la cancelación del préstamo.
            </p>

            <h4>Exclusiones</h4>

            <p>
                A. Esta póliza no incluye cobertura a: mobiliarios, animales, vehículos de motor, naves acuáticas, aéreas y objetos robados durante el siniestro o después del mismo (a menos que estos sean declarados en la contratación de la póliza).
            </p>

            <p>
                B. Toda pérdida, daño directo o indirecto, costo, reclamación o gasto, sea este preventivo, correctivo o de otra índole.
            </p>

            <p>
                C. Queda excluido pérdida o robo de cualquier metal precioso en cualquiera de sus formas.
            </p>

            <p>
                D. No ampara pérdidas o daños de ninguna naturaleza que, directa o indirectamente, sean ocasionados por, resulten de, o sean consecuencia de guerras, invasión, motines, vandalismo o cualquier evento relacionado.
            </p>

            <p>
                E. Clientes con más de un préstamo y con seguro de vida deben revisar el monto asegurado acumulado para evaluar si requiere otros requisitos médicos según la tabla de aseguradoras.
            </p>

            <p>
                F. Giros comerciales excluidos: Riesgos mineros en general, riesgos con procesos industriales de algodón, riesgos de la industria del tabaco y cigarrillos, campos de golf, riesgos azucareros, cultivos en pie, cosecha, plantaciones, animales vivos, muelles, marinas, escolleras, puertos, rompeolas y dársenas, embarcaciones, aeronaves, naves especiales (incluyendo riesgos espaciales) y bienes similares, vehículos en reposo como contenidos (no aplica para los dealers), riesgos ferroviarios, trenes, industrias madereras, fábricas de arroz, cacao, café, fábricas y/o almacén de papel y cartón, fábrica de pintura, barniz, lacas, fábrica de plástico y derivados, fábrica de fuegos artificiales, explosivos y productos pirotécnicos, fabricación, venta y almacenamiento de gomas y productos de caucho, fabricación, almacenamiento y expendio de gases, envasadora de gas, fábrica de muebles y/o taller de ebanistería, procesos de metalurgia, fábrica de almidón y féculas, planta procesadora de arena y cascajo/planta de agregados, fábrica y almacenamiento de baterías, reparadoras de calzados (goma, piel, plástico), fábrica de velas, fábrica de colchones, fábrica de artículos de paja, laboratorios químicos, laboratorios farmacéuticos, impermeabilización con materiales derivados de telas, caucho y productos similares, compraventas, granjas de animales, invernaderos, plantaciones agrícolas, procesamiento y/o depósito de neumáticos, venta de retazos de tela, venta de ropa usada, almacén de provisiones, almacén y venta de chatarra, venta de artículos viejos, usados o en mal estado, almacén de libros usados, repuestos y otras piezas usadas de vehículos, incluyendo neumáticos, molinos de viento, riesgos abandonados, riesgos de aserraderos, riesgos ferroviarios, trenes, terrenos, bienes ubicados bajo la superficie (subterráneo), destilería de alcohol, talleres de ebanistería, almacenamiento de batería.
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
