<h5 class="d-flex justify-content-center bg-primary text-white">COBERTURAS</h5>
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

            <p><b>DAÑOS PROPIOS</b><br>
                Riesgos Comprensivos<br>
                Riesgos Compr. (Deducible)<br>
                Rotura de Cristales (Deducible)<br>
                Colisión y Vuelco<br>
                Incendio y Robo
            </p>

            <p><b>RESPONSABILIDAD CIVIL</b><br>
                Daños Propiedad Ajena<br>
                Lesiones/Muerte 1 Pers<br>
                Lesiones/Muerte más de 1 Pers<br>
                Lesiones/Muerte 1 Pasajero<br>
                Lesiones/Muerte más de 1 Pas
            </p>

            <p><b>RIESGOS CONDUCTOR</b><br>
                <b>FIANZA JUDICIAL</b>
            </p>

            <p><b>COBERTURAS ADICIONALES</b><br>
                Asistencia Vial<br>
                Renta Vehículo<br>
                En Caso de Accidente
            </p>

            <p>
                <b>PRIMA NETA {{ ($cotizacion->getFieldValue("Plan") == "Mensual Full") ? "MENSUAL" : "ANUAL" }}</b><br>
                <b>ISC</b><br>
                <b>PRIMA TOTAL {{ ($cotizacion->getFieldValue("Plan") == "Mensual Full") ? "MENSUAL" : "ANUAL" }}</b>
            </p>
        </td>

        @foreach ($cotizacion->getLineItems() as $lineItem)
            @if ($lineItem->getNetTotal() > 0)
                @php
                    $plan = $libreria->getRecord("Products", $lineItem->getProduct()->getEntityId());
                    $riesgo_compresivo = $cotizacion->getFieldValue('Suma_asegurada') * ($plan->getFieldValue('Riesgos_comprensivos') / 100);
                    $colision = $cotizacion->getFieldValue('Suma_asegurada') * ($plan->getFieldValue('Colisi_n_y_vuelco') / 100);
                    $incendio = $cotizacion->getFieldValue('Suma_asegurada') * ($plan->getFieldValue('Incendio_y_robo') / 100);
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
                        <br>
                        RD${{ number_format($riesgo_compresivo) }}<br>
                            <?php echo $plan->getFieldValue('Riesgos_comprensivos_deducible') ?><br>
                        {{ $plan->getFieldValue('Rotura_de_cristales_deducible')  }}<br>
                        RD$ {{ number_format($colision) }}<br>
                        RD$ {{ number_format($incendio) }}
                    </p>

                    <p>
                        <br>
                        RD$ {{ number_format($plan->getFieldValue('Da_os_propiedad_ajena')) }} <br>
                        RD$ {{ number_format($plan->getFieldValue('Lesiones_muerte_1_pers')) }} <br>
                        RD$ {{ number_format($plan->getFieldValue('Lesiones_muerte_m_s_1_pers')) }} <br>
                        RD$ {{ number_format($plan->getFieldValue('Lesiones_muerte_1_pas')) }} <br>
                        RD$ {{ number_format($plan->getFieldValue('Lesiones_muerte_m_s_1_pas')) }}
                    </p>

                    <p>
                        RD$ {{ number_format($plan->getFieldValue('Riesgos_conductor')) }} <br>
                        RD$ {{ number_format($plan->getFieldValue('Fianza_judicial')) }}
                    </p>

                    <p>
                        <br>
                        @php
                            if ($plan->getFieldValue('Asistencia_vial') == 1) {
                                if (
                                    preg_match('/\bpesado\b/i', $cotizacion->getFieldValue("Tipo_veh_culo"))
                                    or
                                    $cotizacion->getFieldValue("Tipo_veh_culo") == "Camión"
                                ) {
                                    echo 'No aplica <br>';
                                } else {
                                    if ($plan->getFieldValue('Valor_asistencia_vial')) {
                                        echo "Aplica (RD$". number_format($plan->getFieldValue('Valor_asistencia_vial')) . ") <br>";
                                    } else {
                                        echo 'Aplica <br>';
                                    }
                                }
                            } else {
                                echo 'No aplica <br>';
                            }

                            /**
                             *
                             *
                             */
                            if ($plan->getFieldValue('Renta_veh_culo') == 1) {
                                if (
                                    preg_match('/\bpesado\b/i', $cotizacion->getFieldValue("Tipo_veh_culo"))
                                    or
                                    $cotizacion->getFieldValue("Tipo_veh_culo") == "Camión"
                                ) {
                                    echo 'No aplica <br>';
                                } else {
                                    echo 'Aplica <br>';
                                }
                            } else {
                                echo 'No aplica <br>';
                            }
                            if (!empty($plan->getFieldValue('En_caso_de_accidente'))) {
                                echo $plan->getFieldValue('En_caso_de_accidente');
                            } else {
                                echo 'No aplica';
                            }
                        @endphp
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


