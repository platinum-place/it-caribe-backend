<h5 class="d-flex justify-content-center bg-primary text-white">PRIMA</h5>
<table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;" cellpadding="10">
    <tr>
        <td style="font-size: 12px; vertical-align: top;">
            <p>
                <b>Fecha Deudor</b>

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
        <td style="font-size: 12px; vertical-align: top;">
            <p>
                {{ $cotizacion->getFieldValue("Fecha_de_nacimiento") }}

                @if (!empty($cotizacion->getFieldValue("Fecha_de_nacimiento_codeudor")))
                    <br> {{ $cotizacion->getFieldValue("Fecha_de_nacimiento_codeudor") }}
                @endif
            </p>

            <p>
                RD$ {{ number_format($cotizacion->getFieldValue("Suma_asegurada")) }} <br>
                {{ $cotizacion->getFieldValue("Plazo") }} meses
            </p>

            <p>
                RD$ {{ number_format($cotizacion->getFieldValue('Prima_neta'), 2) }} <br>
                RD$ {{ number_format($cotizacion->getFieldValue('ISC'), 2) }} <br>
                RD$ {{ number_format($cotizacion->getFieldValue('Prima'), 2) }} <br>
                RD$ {{ number_format($cotizacion->getFieldValue('Prima') * 12, 2) }}
            </p>
        </td>
    </tr>
</table>

<table style="width: 100%; border-collapse: collapse; font-size: 12px;">
    <tr>
        <td style="padding: 10px; text-align: justify;">
            <p>A. Las aseguradoras, al efectuar su proceso de evaluación de riesgo, se reservan el derecho de aceptación del mismo. En caso de que la aseguradora seleccionada decline el riesgo, el cliente será notificado y en lo inmediato deberá escoger otra aseguradora que haya presentado cotización.</p>
            <p>B. Autorizo que la prima correspondiente a los seguros aceptados por mi persona sea debitada o agregada al monto del préstamo otorgado a mi favor por Banco Múltiple Caribe, S.A., entidad que asume la responsabilidad de entregar a la aseguradora dicha partida, de conformidad al acuerdo entre ambas partes.</p>
            <p>C. Por este medio, les autorizo endosar mi póliza, a favor de Banco Múltiple Caribe, S.A., hasta sus intereses.</p>
            <p>D. Clientes con más de un préstamo y con seguro de vida deben revisar el monto asegurado acumulado para evaluar si requiere otros requisitos médicos según la tabla de aseguradoras.</p>
            <p>E. La aseguradora se reserva el derecho para realizar variación de prima y coberturas en la cotización de seguros suscrita con el cliente.</p>
            <p>F. La cobertura otorgada bajo esta póliza queda condicionada a las cláusulas y condiciones especificadas en los anexos, los cuales han sido incluidos en la póliza definitiva, cuyas condiciones completas están contenidas en la copia que reposa en la entidad financiera y aseguradora:</p>
            <ul style="margin-top: 0; margin-bottom: 10px; padding-left: 20px;">
                <li>Podrán consultarla a través de la página de internet www.bancocaribe.com.do/seguro-de-vida.</li>
                <li>Las condiciones generales de la póliza podrán ser solicitadas en {{ $aseguradora->getFieldValue('Nombre') }}. Puede dirigirse a su oficina principal en la {{ $aseguradora->getFieldValue('Nombre') }}, o contactarse al {{ $aseguradora->getFieldValue('Nombre') }}.</li>
                <li>Pueden contactarse con Sentinel Corredores de Seguros al 809-732-0202 o dirigirse a su oficina en la calle César A. Canó No. 354, Las Praderas, Santo Domingo.</li>
            </ul>
            <p>G. Vigencia: La póliza será válida hasta la cancelación del préstamo.</p>
            <p><strong>Exclusiones:</strong></p>
            <ul style="margin-top: 0; margin-bottom: 10px; padding-left: 20px;">
                <li>A. Asegurado que practique cualquier tipo de deporte de alto riesgo o que preste servicios de vehículos públicos o aéreos. (De acuerdo a formulario).</li>
                <li>B. La aseguradora se reserva el derecho de no pagar ninguna reclamación que surja como consecuencia de suicidio o tentativa de suicidio, siempre y cuando ocurra dentro del plazo de 2 años.<li>
                <li>C. La compañía no pagara la indemnización por fallecimiento de un asegurado que sufra cualquier lesión por accidente o cualquier enfermedad provocada por participar activamente en guerra, rebelión, motín o cualquier otra relacionada a estas. Tampoco indemnizara por fallecimiento por estar cometiendo algún delito como robo, asalto, asesinato o por causa de intervenciones quirúrgicas ilícitas o estéticas.<li>
                <li>D. Hospitalización o incapacidad total y permanente causada por enfermedad, lesión o condición preexistente originada antes del inicio de vigencia de la cobertura.<li>
                <li>E. Epidemias declaradas por las autoridades competentes.<li>
                <li>F. Fallecimiento ocasionado por cualquier enfermedad del Síndrome de Inmunodeficiencia Adquirida – SIDA, virusVIH o cualquier otro desorden inmunológico.<li>
                <li>G. Exclusiones por mora: Si la prima presenta un atraso de mas de 120 días, sera excluido de la póliza.</li>
            </ul>
        </td>
    </tr>
</table>
