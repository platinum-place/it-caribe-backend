<div style="width: 100%; overflow: hidden; border: 1px solid #ddd; font-size: 12px;">
    <div style="float: left; width: 50%; padding: 10px; box-sizing: border-box;">
        <table style="width: 100%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold; width: 40%;">Marca</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue('Marca')->getLookupLabel() }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Modelo</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue('Modelo')->getLookupLabel() }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Año</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("A_o") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Color</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Color") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Tipo</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Tipo_veh_culo") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Salvamento</th>
                    <td style="padding: 5px;">{{ ($cotizacion->getFieldValue("Salvamento")) ? "Si" : "No" }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="float: right; width: 50%; padding: 10px; box-sizing: border-box;">
        <table style="width: 100%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold; width: 40%;">Chasis</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Chasis") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Placa</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Placa") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Uso</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Uso") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Condiciones</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Condiciones") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Suma asegurada</th>
                    <td style="padding: 5px;">RD${{ number_format($cotizacion->getFieldValue("Suma_asegurada"), 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="clear: both;"></div>
</div>
