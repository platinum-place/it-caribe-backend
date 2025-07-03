<h5 class="d-flex justify-content-center bg-primary text-white">PRIMA</h5>
<table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;" cellpadding="10">
    <tr>
        <td style="font-size: 12px; vertical-align: top;">
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
        <td style="font-size: 12px; vertical-align: top;">
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
            <p><strong>A.</strong> Las aseguradoras, al efectuar su proceso de evaluación de riesgo, se reservan el derecho de aceptación del mismo. En caso de que la aseguradora seleccionada decline el riesgo, el cliente será notificado y deberá, de inmediato, escoger otra aseguradora que haya presentado cotización.</p>

            <p><strong>B.</strong> Autorizo que la prima correspondiente a los seguros aceptados por mi persona sea adicionada a la cuota del préstamo otorgado a mi favor por Banco Múltiple Caribe, S.A., entidad que asume la responsabilidad de entregar a la aseguradora dicha partida, de conformidad a acuerdo entre ambas partes.</p>

            <p><strong>C.</strong> Por este medio, autorizo el endoso de mi póliza a favor de Banco Múltiple Caribe, S.A., hasta sus intereses.</p>

            <p><strong>D.</strong> La aseguradora se reserva el derecho para realizar variaciones de prima y coberturas en la cotización de seguros suscrita con el cliente, con previa comunicación al banco y al cliente.</p>

            <p><strong>F.</strong> La cobertura otorgada bajo esta póliza queda condicionada a las cláusulas y condiciones especificadas en los anexos, los cuales han sido incluidos en la póliza definitiva, cuyas condiciones completas están contenidas en la copia que reposa en la entidad financiera y aseguradora:</p>

            <ul style="margin-top: 0; margin-bottom: 10px; padding-left: 20px;">
                <li>Podrán consultarla a través de la página de internet <a href="https://www.bancocaribe.com.do/seguroscaribe/seguro-de-incendio" style="color: black; text-decoration: underline;">www.bancocaribe.com.do/seguroscaribe/seguro-de-incendio</a>.</li>
                <li>Las condiciones generales de la póliza podrán ser solicitadas en Humano Seguros. Puede dirigirse a su oficina principal en la Av. 27 de Febrero No. 50, Santo Domingo, o contactarse al 809-381-5000.</li>
                <li>Pueden contactarse con Sentinel Corredores de Seguros al 809-732-0202 o dirigirse a su oficina en la calle César A. Canó No. 354, Las Praderas, Santo Domingo.</li>
            </ul>

            <p><strong>G.</strong> <strong>Vigencia:</strong> Esta póliza será válida hasta la cancelación del préstamo.</p>

            <p><strong>H.</strong> Propiedades en proximidades menores o iguales a 500 metros de playas o ríos deben ser inspeccionadas por la aseguradora antes de formalizar la facilidad.</p>

            <p><strong>Exclusiones:</strong></p>
            <ul style="margin-top: 0; margin-bottom: 10px; padding-left: 20px;">
                <li><strong>A.</strong> Esta póliza no incluye cobertura a: mobiliarios, animales, vehículos de motor, naves acuáticas, aéreas y objetos robados durante el siniestro o después del mismo (a menos que estos sean declarados en la contratación de la póliza).</li>
                <li><strong>B.</strong> Toda pérdida, daño directo o indirecto, costo, reclamación o gasto, sea este preventivo, correctivo o de otra índole.</li>
                <li><strong>C.</strong> Queda excluido pérdida o robo de cualquier metal precioso en cualquiera de sus formas.</li>
                <li><strong>D.</strong> No ampara pérdidas o daños de ninguna naturaleza que, directa o indirectamente, sean ocasionados por, resulten de, o sean consecuencia de guerras, invasión, motines, vandalismo o cualquier evento relacionado.</li>
                <li><strong>E.</strong> Clientes con más de un préstamo y con seguro de vida deben revisar el monto asegurado acumulado para evaluar si requiere otros requisitos médicos según la tabla de aseguradoras.</li>
                <li><strong>F.</strong> <strong>Giros comerciales excluidos:</strong> Riesgos mineros, industriales, agrícolas, químicos, y otros riesgos detallados como: fábricas de explosivos, pintura, neumáticos, muebles, laboratorios, cultivos, plantaciones, venta de artículos usados, entre otros. (Ver listado completo en documento original).</li>
                <li><strong>G.</strong> <strong>Exclusiones por mora:</strong> Si la prima presenta un atraso de más de 120 días, será excluido de la póliza.</li>
            </ul>

            <br><br>

            <table style="width: 100%; font-size: 12px; margin-top: 40px;">
                <tr>
                    <td style="width: 45%; border-top: 1px solid black; text-align: center; padding-top: 5px;">
                        Nombre o Firma del cliente
                    </td>
                    <td style="width: 10%;"></td>
                    <td style="width: 45%;"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
