<div style="width: 100%; overflow: hidden; border: 1px solid #ddd;">
    <div style="float: left; width: 50%; padding: 10px; box-sizing: border-box;">
        <table style="width: 100%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold; width: 40%;">Nombre</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Nombre_codeudor") . " " . $cotizacion->getFieldValue("Apellido_codeudor") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">RNC/Cédula</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("RNC_C_dula_codeudor") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Email</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Correo_electr_nico_codeudor") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Fecha de Nacimiento</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Fecha_de_nacimiento_codeudor") }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="float: right; width: 50%; padding: 10px; box-sizing: border-box;">
        <table style="width: 100%; border-collapse: collapse;">
            <tbody>
                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold; width: 40%;">Tel. Residencia</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Tel_Residencia_codeudor") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Tel. Celular</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Tel_Celular_codeudor") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Tel. Trabajo</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Tel_Trabajo_codeudor") }}</td>
                </tr>

                <tr>
                    <th style="text-align: left; padding: 5px; font-weight: bold;">Dirección</th>
                    <td style="padding: 5px;">{{ $cotizacion->getFieldValue("Direcci_n_codeudor") }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="clear: both;"></div>
</div>