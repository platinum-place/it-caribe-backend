<div style="width: 100%; overflow: hidden; border: 1px solid #ddd; font-size: 12px;">
    <div style="float: left; width: 50%; padding: 10px; box-sizing: border-box;">
        <table style="width: 100%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold; width: 40%;">Nombre</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Nombre") . " " . $cotizacion->getFieldValue("Apellido") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">RNC/Cédula</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("RNC_C_dula") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Email</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Correo_electr_nico") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Fecha de Nacimiento</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Fecha_de_nacimiento") }}</td>
                </tr>

                @if ($cotizacion->getFieldValue("Plan") == "Vida")
                    <tr>
                        <th style="text-align: left; padding: 5px; font-weight: bold;">Garante</th>
                        <td style="padding: 5px;">{{ ($cotizacion->getFieldValue("Garante")) ? "Si" : "No" }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div style="float: right; width: 50%; padding: 10px; box-sizing: border-box;">
        <table style="width: 100%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold; width: 40%;">Tel. Residencia</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Tel_Residencia") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Tel. Celular</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Tel_Celular") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Tel. Trabajo</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Tel_Trabajo") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Dirección</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Direcci_n") }}</td>
                </tr>

                @if (!empty($cotizacion->getFieldValue("Tipo_de_pago")))
                    <tr>
                        <th style="text-align: left; padding: 5px; font-weight: bold;">Tipo de pago</th>
                        <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Tipo_de_pago") }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div style="clear: both;"></div>
</div>
