<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $name }}</title>
    <style>
        @page {
            size: A3 portrait;
            margin: 20px;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 12px;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            width: 16.66%;
        }

        th {
            background-color: #ddd;
            text-align: center;
        }

        td {
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<h3 style="text-align:center;">COTIZACIÓN DE SEGUROS</h3>

<table>
    <tbody>
    <tr>
        <td style="text-align:left;">Ramo/Producto:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue('Plan') }}</td>
        <td style="text-align:center;">Correo:</td>
        <td style="text-align:center;">{{ $cotizacion->getFieldValue('Correo_electr_nico') }}</td>
        <td style="text-align:right;">Fecha:</td>
        <td style="text-align:right;">{{ date('d/m/Y', strtotime($cotizacion->getCreatedTime())) }}</td>
    </tr>

    <tr>
        <td style="text-align:left;">Cliente:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue("Nombre") . " " . $cotizacion->getFieldValue("Apellido") }}</td>
        <td style="text-align:center;">Equipamientos:</td>
        <td style="text-align:center;">{{ 'NINGUNO' }}</td>
        <td style="text-align:right;">Cédula/Pasaporte:</td>
        <td style="text-align:right;">{{ $cotizacion->getFieldValue('RNC_C_dula') }}</td>
    </tr>

    <tr>
        <td style="text-align:left;">Dirección:</td>
        <td style="text-align:left;"><p>{{ $cotizacion->getFieldValue('Direcci_n') }}</p></td>
        <td style="text-align:center;">Uso:</td>
        <td style="text-align:center;">{{ $cotizacion->getFieldValue('Uso') }}</td>
        <td style="text-align:right;">Teléfono:</td>
        <td style="text-align:right;">{{ $cotizacion->getFieldValue('Tel_Residencia') }}</td>
    </tr>

    <tr>
        <td style="text-align:left;">Tipo de vehículo:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue('Tipo_veh_culo') }}</td>
        <td style="text-align:center;">Marca:</td>
        <td style="text-align:center;">{{ $cotizacion->getFieldValue('Marca')->getLookupLabel() }}</td>
        <td style="text-align:right;">Modelo:</td>
        <td style="text-align:right;">{{ $cotizacion->getFieldValue('Modelo')->getLookupLabel() }}</td>
    </tr>

    <tr>
        <td style="text-align:left;">Año:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue('A_o') }}</td>
        <td style="text-align:center;">Chasis:</td>
        <td style="text-align:center;">{{ $cotizacion->getFieldValue('Chasis') }}</td>
        <td style="text-align:right;">Valor asegurado:</td>
        <td style="text-align:right;">{{ number_format($cotizacion->getFieldValue("Suma_asegurada"), 2) }}</td>
    </tr>
    </tbody>
</table>

</body>
</html>
