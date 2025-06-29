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
