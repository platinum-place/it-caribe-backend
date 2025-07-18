<h5 class="d-flex justify-content-center bg-primary text-white">PRIMA</h5>
<table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;" cellpadding="10">
    <tr>
        <td style="font-size: 12px; vertical-align: top;">
            <p>
                <b>Fecha Cliente</b>
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
        <td style="font-size: 12px; vertical-align: top;">
            <p>
                {{ $cotizacion->getFieldValue("Fecha_de_nacimiento") }}
            </p>

            <p>
                RD$ {{ number_format($cotizacion->getFieldValue("Suma_asegurada")) }} <br>
                RD$ {{ number_format($cotizacion->getFieldValue("Cuota")) }} <br>
                {{ $cotizacion->getFieldValue("Plazo") }} meses
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
            <p><strong>A)</strong> <strong>Desempleo:</strong> El seguro de desempleo cubre hasta 6 meses la cuota del préstamo en caso de desempleo involuntario, siempre y cuando el asegurado permanezca desempleado. Cobertura para empleados públicos y privados.</p>

            <p><strong>B)</strong> <strong>Periodo de carencia:</strong> Es el tiempo que debe transcurrir desde la incorporación del asegurado en la póliza y durante el cual, en caso de ocurrir un desempleo involuntario, no estará cubierto por la aseguradora.</p>

            <ul style="margin-top: 0; margin-bottom: 10px; padding-left: 20px;">
                <li>El periodo de carencia será de (3) meses para empleados privados.</li>
                <li>El periodo de carencia será de (5) meses para empleados de empresas públicas y militares.</li>
                <li>Asalariado independiente: este periodo no aplica para profesionales independientes.</li>
            </ul>

            <p><strong>C)</strong> Las aseguradoras, al efectuar su proceso de evaluación de riesgo, se reservan el derecho de aceptación de este. En caso de que la aseguradora seleccionada decline el riesgo, el cliente será notificado y deberá escoger otra aseguradora que haya presentado cotización.</p>

            <p><strong>D)</strong> Autorizo que la prima correspondiente a los seguros aceptados por mi persona sea debitada o agregada al monto del préstamo otorgado a mi favor por Banco Múltiple Caribe, S.A., entidad que asume la responsabilidad de entregar a la aseguradora dicha partida, de conformidad al acuerdo entre ambas partes.</p>

            <p><strong>E)</strong> Por este medio, les autorizo endosar mi póliza, a favor de Banco Múltiple Caribe, S.A., hasta sus intereses.</p>

            <p><strong>F)</strong> La aseguradora se reserva el derecho para realizar variación de prima y coberturas en la cotización de seguros suscrita con el cliente, con previa comunicación al banco y al cliente.</p>

            <p><strong>G)</strong> El beneficio de la cobertura aplicará para deudores o asegurados militares y empleados de empresas públicas que hayan permanecido laborando en la empresa al menos (24) veinticuatro meses consecutivos antes de la ocurrencia del despido.</p>

            <p><strong>H)</strong> La cobertura otorgada bajo esta póliza queda condicionada a las cláusulas y condiciones especificadas en los anexos, los cuales han sido incluidos en la póliza definitiva, cuyas condiciones completas están contenidas en la copia que reposa en la entidad financiera y aseguradora:</p>

            <ul style="margin-top: 0; margin-bottom: 10px; padding-left: 20px;">
                <li>Podrán consultarla a través de la página de internet <a href="https://www.bancocaribe.com.do" style="color: black; text-decoration: underline;">www.bancocaribe.com.do</a>.</li>
                <li>Las condiciones generales de la póliza podrán ser solicitadas en Sura. Puede dirigirse a su oficina principal en la Av. John F. Kennedy, Santo Domingo, o contactarse al 809-985-5000.</li>
                <li>Pueden contactarse con Sentinel Corredores de Seguros al 809-732-0202 o dirigirse a su oficina en la calle César A. Canó No. 354, Las Praderas, Santo Domingo.</li>
            </ul>

            <p><strong>I)</strong> <strong>Vigencia:</strong> La póliza será válida hasta la cancelación del préstamo.</p>

            <p><strong>Exclusiones:</strong></p>
            <ul style="margin-top: 0; margin-bottom: 10px; padding-left: 20px;">
                <li>A) Pérdida del empleo por incumplimiento del contrato de trabajo y las disposiciones del Código de Trabajo. Terminación por renuncia o pérdida voluntaria del empleo.</li>
                <li>B) Empleados con incapacidad por accidente, enfermedad, desorden mental o embarazo.</li>
                <li>C) Para la cobertura de discapacidad temporal por accidentes aplican las personas que sean trabajadores, comerciantes y profesionales independientes, siempre que estén percibiendo un ingreso. No aplican jubilados, pensionados o personas que hayan sido retiradas del seguro.</li>
                <li>D) Periodo en el que el asegurado pase fuera del país más de 30 días consecutivos.</li>
                <li>E) Personas con contratos de trabajo informales y trabajos a tiempo completo no suscritos en la Tesorería de la Seguridad Social y en el Ministerio de Trabajo.</li>
                <li>F) Deudor-asegurado que se encuentre de licencia sin disfrute de sueldo.</li>
                <li>G) Asegurado con más de un empleo que pierda menos del 50% de sus ingresos.</li>
                <li>H) <strong>Exclusiones por mora:</strong> Si la prima presenta un atraso de más de 120 días, será excluido de la póliza. Aplica para cuota mensual.</li>
            </ul>

            <br>

            <p><strong>Nombre del cliente:</strong> ________________________________________</p>
            <p><strong>Cédula:</strong> _________________________________________________</p>
        </td>
    </tr>
</table>
