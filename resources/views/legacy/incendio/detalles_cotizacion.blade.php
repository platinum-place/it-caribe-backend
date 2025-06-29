<h5 class="d-flex justify-content-center bg-primary text-white">PRIMA</h5>
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

            <p>
                <b>Valor de la Propiedad</b> <br>
                <b>Valor del Préstamo</b> <br>
                <b>Plazo</b>
            </p>

            <p>
                <b>Tipo de Construcción</b> <br>
                <b>Tipo de Riesgo</b>
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
                        RD$ {{ number_format($cotizacion->getFieldValue("Suma_asegurada")) }} <br>
                        RD$ {{ number_format($cotizacion->getFieldValue("Prestamo")) }} <br>
                        {{ $cotizacion->getFieldValue("Plazo") }} meses
                    </p>

                    <p>
                        {{ $cotizacion->getFieldValue("Construcci_n") }} <br>
                        {{ $cotizacion->getFieldValue("Riesgo") }}
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
