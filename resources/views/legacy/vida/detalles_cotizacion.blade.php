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

            <p><b>Fecha Deudor</b>
                @if (!empty($cotizacion->getFieldValue("Fecha_de_nacimiento_codeudor")))
                    <br> <b>Fecha Codeudor</b>
                @endif
            </p>

            <p>
                <b>Suma Asegurada</b> <br>
                <b>Plazo</b>
            </p>

            <p>
                <b>Prima Neta</b><br>
                <b>ISC</b><br>
                <b>Prima Total Mensual</b> <br>
                <b>Prima Total Anual</b>
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

                        @if (!empty($cotizacion->getFieldValue("Fecha_de_nacimiento_codeudor")))
                            <br>{{ $cotizacion->getFieldValue("Fecha_de_nacimiento_codeudor") }}
                        @endif
                    </p>

                    <p>
                        RD$ {{ number_format($cotizacion->getFieldValue("Suma_asegurada")) }} <br>
                        {{ $cotizacion->getFieldValue("Plazo") }} meses
                    </p>

                    <p>
                        RD$ {{ number_format($lineItem->getNetTotal() / 1.16, 2) }} <br>
                        RD$ {{ number_format($lineItem->getNetTotal() - $lineItem->getNetTotal() / 1.16, 2) }} <br>
                        RD$ {{ number_format($lineItem->getNetTotal(), 2) }} <br>
                        RD$ {{ number_format($lineItem->getNetTotal() * 12, 2) }}
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
                                {{ $requisito }}@if($i < count($requisitos) - 1), @else.@endif
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

@if (!empty($cotizacion->getFieldValue("Fecha_de_nacimiento_codeudor")))
    <table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="10">
        <tr>
            <td style="width: 50%; vertical-align: top; border: 1px solid #ddd;">
                <h4 style="text-align: center; margin: 0 0 10px 0;">REQUISITOS DEL CODEUDOR</h4>

                <ul style="padding-left: 18px; margin: 0;">
                    @foreach ($cotizacion->getLineItems() as $lineItem)
                        @if ($lineItem->getNetTotal() > 0)
                            @php
                                $plan = $libreria->getRecord("Products", $lineItem->getProduct()->getEntityId());
                                $requisitos = $plan->getFieldValue("Requisitos_codeudor");
                            @endphp

                            <li>
                                <b>{{ $plan->getFieldValue("Vendor_Name")->getLookupLabel() }}</b>:
                                @foreach ($requisitos as $i => $requisito)
                                    {{ $requisito }}@if($i < count($requisitos) - 1), @else.@endif
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
@endif

<table style="width: 100%; border-collapse: collapse; font-size: 12px;">
    <tr>
        <td style="padding: 10px; text-align: justify;">
            <p>a) Las aseguradoras, al efectuar su proceso de evaluación de riesgo, se reservan el derecho de aceptación del mismo. En caso de que la aseguradora seleccionada decline el riesgo, el cliente será notificado y en lo inmediato deberá escoger otra aseguradora que haya presentado cotización.</p>

            <p>b) La aseguradora se reserva el derecho para realizar variación de prima y coberturas en esta cotización de seguros suscrita con el cliente.</p>

            <p><strong>Vigencia:</strong> Por el período del préstamo.</p>

            <p>He leído y estoy de acuerdo en seleccionar la aseguradora: ________________________________</p>
        </td>
    </tr>
</table>
