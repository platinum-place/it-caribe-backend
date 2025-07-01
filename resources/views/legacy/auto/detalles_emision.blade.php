<h5 class="d-flex justify-content-center bg-primary text-white">COBERTURAS</h5>
<table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;" cellpadding="10">
    <tr>
        <td style="font-size: 12px; vertical-align: top;">
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

        @php
            $riesgo_compresivo = $cotizacion->getFieldValue('Suma_asegurada') * ($plan->getFieldValue('Riesgos_comprensivos') / 100);
            $colision = $cotizacion->getFieldValue('Suma_asegurada') * ($plan->getFieldValue('Colisi_n_y_vuelco') / 100);
            $incendio = $cotizacion->getFieldValue('Suma_asegurada') * ($plan->getFieldValue('Incendio_y_robo') / 100);
        @endphp
        <td style="font-size: 12px; vertical-align: top;">
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
                                                echo 'Aplica <br>';

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
                RD$ {{ number_format($cotizacion->getFieldValue('Prima_neta'), 2) }} <br>
                RD$ {{ number_format($cotizacion->getFieldValue('ISC'), 2) }} <br>
                RD$ {{ number_format($cotizacion->getFieldValue('Prima'), 2) }}
            </p>
        </td>
    </tr>
</table>

<table style="width: 100%; border-collapse: collapse; font-size: 12px;">
    <tr>
        <td style="padding: 10px; text-align: justify;">
            <p>A) Autorizo que la prima correspondiente a los seguros aceptados por mi persona sean adicionadas a la
                cuota del préstamo otorgado a mi favor por Banco Múltiple Caribe, S. A., hasta sus intereses,
                entidad que ha asumido la responsabilidad de entregar a la aseguradora dicha partida, de conformidad
                a acuerdo entre ambas partes.</p>

            <p>B) Por este medio, les autorizo endosar mi póliza de Vehículo No. 30-35-1953 por el monto de RD$
                1,100,000.00 a favor de Banco Múltiple Caribe, S. A., hasta sus intereses.</p>

            <p>C) La cobertura otorgada bajo esta póliza queda condicionada a las cláusulas y condiciones
                especificadas en los anexos, los cuales han sido incluidos en la póliza definitiva, cuyas
                condiciones completas están contenidas en la copia que reposa en la entidad financiera y
                aseguradora.</p>

            <ul style="margin-top: 0; margin-bottom: 10px; padding-left: 20px;">
                <li>Podrán consultarla a través de la página de internet <a
                        href="http://www.bancocaribe.com.do/seguroscaribe/vehiculos"
                        style="color: black; text-decoration: underline;">www.bancocaribe.com.do/seguroscaribe/vehiculos</a>.
                </li>
                <li>Las condiciones generales de la póliza podrán ser solicitadas en Humano Seguros. Puede dirigirse
                    a su oficina principal en la Av. Lope de Vega No. 36, Santo Domingo, o contactarse al
                    809-476-3570.
                </li>
                <li>Puede contactarse con Segurnet Corredores de Seguros al 809-620-2524 o dirigirse a su oficina en
                    la calle Viriato Fiallo No. 24, D.N., Santo Domingo.
                </li>
            </ul>

            <p>D) La cobertura de vida cubrirá el préstamo del deudor de Banco Caribe hasta el saldo insoluto y
                hasta sus intereses, sin exceder los RD$300,000.00, según las condiciones generales de la
                póliza.</p>

            <p>E) La cobertura de últimos gastos indicada en este certificado indemnizará al beneficiario (declarado
                en la solicitud de vida) en el momento del fallecimiento del asegurado y deudor de Banco Caribe,
                siempre que el valor adeudado y hasta sus intereses no excedan los RD$300,000.00, según las
                condiciones generales de la póliza.</p>

            <p>F) Los asegurados deberán comunicar al banco y a la aseguradora cualquier cambio de propietario del
                vehículo asegurado, así como también en caso de que el vehículo asegurado sea sustituido por otro,
                de acuerdo con la política del banco.</p>

            <p>G) En caso de ocurrir un accidente cubierto bajo las condiciones de esta póliza cuya reparación
                requiera la sustitución de partes, piezas y accesorios del vehículo asegurado, si dichas partes,
                piezas y accesorios no pueden ser suministradas por falta de existencias en los distribuidores del
                país, Humano no será responsable del sobreprecio que se produzca para obtenerlas en mercados
                extranjeros ni de las demoras generadas en el proceso de importación de las mismas. Se entiende
                expresamente que en ningún caso dichas demoras obligarán a la aseguradora a la liquidación del
                vehículo asegurado si aplica.</p>

            <p>H) En los casos de salvamento, la aseguradora se reserva el derecho de cubrir únicamente la deuda del
                siniestro de acuerdo con el valor del vehículo en el mercado al momento del evento.</p>

            <p>I) El salvamento al 100% es propiedad de la compañía de seguros una vez se haya indemnizado el valor
                asegurado.</p>

            <p>J) En caso de accidente, el asegurado deberá proteger el vehículo asegurado contra toda pérdida o
                daño adicional. Cualquier daño que ocurra, directa o indirectamente, por falta de protección por
                parte del asegurado no será indemnizable bajo esta póliza.</p>

            <p>K) <b>Exclusión por mora:</b><br>
                El cliente que presente un atraso de más de 120 días será excluido de la póliza de vehículos.
                Efectuado el pago, el cliente deberá pasar por una sucursal de Banco Caribe, donde se realizará la
                reinspección del vehículo. Si no procede con la misma, continuará sin cobertura de póliza.
            </p>

            <p>L) Vigencia: La póliza estará válida hasta la cancelación del préstamo.</p>

            <p>M) 5% del V/A Mín. RD$20,000 – Pérdidas Parciales; 10% del V/A Mín. RD$30,000 – Pérdidas Totales.</p>

            <p>N) Aplicaremos 30% anual de depreciación para vehículos pesados y 24% anual para livianos y medianos
                al momento de declarar el vehículo como pérdida total.</p>

            <p>1) Deducible de Humano en su plan cero deducible y para vehículos 0km: en el caso de automóviles,
                jeepetas, camionetas y vehículos pesados tendrán 0 % de deducible y a partir del 5to año cambia al
                deducible del 1 % mínimo RD$ 5,000.00</p>

            <p>Al firmar acepta todas las condiciones detalladas en esta cotización de la aseguradora
                seleccionada.</p>
        </td>
    </tr>
</table>
