<h5 class="d-flex justify-content-center bg-primary text-white">PRIMA MENSUAL</h5>
<table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;" cellpadding="10">
    <tr>
        <td style="font-size: 12px; vertical-align: top;">
            @php
                $logoPath = public_path('img/espacio.png');
                $logoBase64 = '';
                if (file_exists($logoPath)) {
                    $logoData = base64_encode(file_get_contents($logoPath));
                    $logoMime = mime_content_type($logoPath);
                    $logoBase64 = 'data:' . $logoMime . ';base64,' . $logoData;
                }
            @endphp

            @if($logoBase64)
                <img src="{{ $logoBase64 }}" style="width: 100px; height: 25px;" alt="">
            @endif

            <p><b>Fecha Cliente</b>
            </p>

            <p>
                <b>Suma Asegurada</b> <br>
                <b>Cuota Mensual de Prestamo</b> <br>
                <b>Plazo</b>
            </p>

            <p>
                <b>Prima Neta</b><br>
                <b>ISC</b><br>
                <b>Prima Total</b>
            </p>
        </td>

        @foreach ($cotizacion->getLineItems() as $lineItem)
            @if ($lineItem->getNetTotal() > 0)
                @php
                    $plan = $libreria->getRecord("Products", $lineItem->getProduct()->getEntityId());
                @endphp
                <td style="font-size: 12px; vertical-align: top;">
                    @php
                        $logoPath = public_path('img/aseguradoras/' . $plan->getFieldValue('Vendor_Name')->getLookupLabel() . '.png');
                        $logoBase64 = '';
                        if (file_exists($logoPath)) {
                            $logoData = base64_encode(file_get_contents($logoPath));
                            $logoMime = mime_content_type($logoPath);
                            $logoBase64 = 'data:' . $logoMime . ';base64,' . $logoData;
                        }
                    @endphp

                    @if($logoBase64)
                        <img src="{{ $logoBase64 }}" style="width: 100px; height: 25px;" alt="">
                    @endif

                    <p>
                        {{ $cotizacion->getFieldValue("Fecha_de_nacimiento") }}
                    </p>

                    <p>
                        RD$ {{ number_format($cotizacion->getFieldValue("Suma_asegurada")) }} <br>
                        RD$ {{ number_format($cotizacion->getFieldValue("Cuota")) }} <br>
                        {{ $cotizacion->getFieldValue("Plazo") }} meses
                    </p>

                    <p>
                        RD$ {{ number_format($lineItem->getNetTotal() / 1.16, 2) }} <br>
                        RD$ {{ number_format($lineItem->getNetTotal() - $lineItem->getNetTotal() / 1.16, 2) }} <br>
                        RD$ {{ number_format($lineItem->getNetTotal(), 2) }}
                    </p>
                </td>
            @endif
        @endforeach
    </tr>
</table>

<table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="10">
    <tr>
        <td style="width: 50%; vertical-align: top; border: 1px solid #ddd;">
            <h4 style="text-align: center; margin: 0 0 10px 0;">REQUISITOS DEL DEUDOR</h4>

            <ul style="padding-left: 18px; margin: 0;">
                @foreach ($cotizacion->getLineItems() as $lineItem)
                    @if ($lineItem->getNetTotal() > 0)
                        @php
                            $plan = $libreria->getRecord("Products", $lineItem->getProduct()->getEntityId());
                            $requisitos = $plan->getFieldValue("Requisitos_deudor");
                        @endphp

                        <li>
                            <b>{{ $plan->getFieldValue("Vendor_Name")->getLookupLabel() }}</b>:
                            @foreach ($requisitos as $i => $requisito)
                                {{ $requisito }}@if($i < count($requisitos) - 1)
                                    ,
                                @else
                                    .
                                @endif
                            @endforeach
                        </li>
                    @endif
                @endforeach
            </ul>
        </td>

        <td style="width: 50%; vertical-align: top; border: 1px solid #ddd;">
            <h4 style="text-align: center; margin: 0 0 10px 0;">OBSERVACIONES</h4>

            <ul style="padding-left: 18px; margin: 0;">
                <li>Pago de desempleo por hasta 6 meses.</li>
            </ul>
        </td>
    </tr>
</table>

<div class="col-12" style="height: 20px;">
</div>

<table style="width: 100%; border-collapse: collapse; font-size: 12px;">
    <tr>
        <td style="padding: 10px; text-align: justify;">
            <p>a) Las aseguradoras al efectuar su proceso de evaluación de riesgo, se reservan el derecho de aceptación del mismo. En caso de que la aseguradora seleccionada decline el riesgo, el cliente será notificado y en lo inmediato deberá escoger otra aseguradora que haya presentado cotización.</p>

            <p>b) La aseguradora se reserva el derecho para realizar variación de prima y coberturas en esta cotización de seguros suscrita con el cliente.</p>

            <p>c) Todos los asegurados, presentarán evidencias de asegurabilidad sobre la base de los límites, edades y requisitos estipulados en la tabla por aseguradora.</p>

            <p>d) Clientes con más de un préstamo y con seguro de vida, deben revisar el Monto Asegurado acumulado para evaluar si requiere otros requisitos médicos según la tabla.</p>

            <p>e) <b>Giros Comerciales excluidos:</b> Riesgos mineros en general, riesgos con procesos industriales de algodón, riesgos de la industria del tabaco y cigarrillos, campos de golf, riesgos azucareros, cultivos en pie, cosecha, plantaciones, animales vivos, muelles, marinas, escolleras, puertos, rompeolas y dársenas, embarcaciones, aeronaves, naves especiales (incluyendo riesgos espaciales) y bienes similares, vehículos en reposo como contenidos (no aplica para los dealers), riesgos ferrocarriles y trenes, industrias madereras, fábricas de arroz, cacao, café, fábricas y/o almacén de papel y cartón, fábrica de pintura, barniz, lacas, fábrica de plástico y derivados, fábrica de fuegos artificiales, explosivos y productos pirotécnicos, fábrica, venta y almacenamiento de gomas y productos de caucho, fábrica, almacenamiento y expendio de gases, envasadora de gas, fábrica de muebles y/o taller de ebanistería, procesos de metalurgia, fábrica de almidón y féculas, planta procesadora de arena y cascajo / planta de agregados, fábrica y almacenamiento de baterías, reparadoras de calzados (goma, piel, plástico), fábrica de velas, fábrica de colchones, fábrica de artículos de paja, laboratorios químicos, laboratorios farmacéuticos, impermeabilización con materiales derivados de telas, caucho y productos similares, compraventas, granjas de animales, invernaderos, plantaciones agrícolas, procesamiento y/o depósito de neumáticos, venta de retazos de tela, venta de ropa usada, almacén de provisiones, almacén y venta de chatarra, venta de artículos viejos, usados o en mal estado, almacén de libros usados, repuestos y otras piezas usadas de vehículos incluyendo neumáticos, molinos de viento, riesgos abandonados, riesgos de aserraderos, riesgos de ferrocarriles y trenes, terrenos, bienes ubicados bajo la superficie (subterráneo), destilería de alcohol, talleres de ebanistería, almacenamiento de batería.</p>

            <p><b>Vigencia:</b> Por el período del préstamo.</p>

            <p>He leído y estoy de acuerdo en seleccionar la aseguradora: ________________________________</p>
        </td>
    </tr>
</table>

