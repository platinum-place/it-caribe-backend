<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $name }}</title>
</head>
<body>

@php
    $logoPath = public_path('img/logo.png');
    $logoBase64 = '';
    if (file_exists($logoPath)) {
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoMime = mime_content_type($logoPath);
        $logoBase64 = 'data:' . $logoMime . ';base64,' . $logoData;
    }
@endphp
@if($logoBase64)
    <img src="{{ $logoBase64 }}" width="70" height="70" alt="">
@endif

<h4>COTIZACIÓN DE SEGUROS</h4>
<table>
    <tbody>
    <tr>
        <th>Ramo/Producto:</th>
        <td>{{ $cotizacion->getFieldValue('Plan') }}</td>
        <th>Correo:</th>
        <td>{{ $cotizacion->getFieldValue('Correo_electr_nico') }}</td>
        <th>Fecha:</th>
        <td>{{ date('d/m/Y', strtotime($cotizacion->getCreatedTime())) }}</td>
    </tr>

    <tr>
        <th>Cliente:</th>
        <td>{{ $cotizacion->getFieldValue("Nombre") . " " . $cotizacion->getFieldValue("Apellido") }}</td>
        <th>Equipamientos:</th>
        <td>{{ 'NINGUNO' }}</td>
        <th>Cédula/Pasaporte:</th>
        <td>{{ $cotizacion->getFieldValue('RNC_C_dula') }}</td>
    </tr>

    <tr>
        <th>Dirección:</th>
        <td>{{ $cotizacion->getFieldValue('Direcci_n') }}</td>
        <th>Uso:</th>
        <td>{{ $cotizacion->getFieldValue('Uso') }}</td>
        <th>Teléfono:</th>
        <td>{{ $cotizacion->getFieldValue('Tel_Residencia') }}</td>
    </tr>

    <tr>
        <th>Tipo de vehículo:</th>
        <td>{{ $cotizacion->getFieldValue('Tipo_veh_culo') }}</td>
        <th>Marca:</th>
        <td>{{ $cotizacion->getFieldValue('Marca')->getLookupLabel() }}</td>
        <th>Modelo:</th>
        <td>{{ $cotizacion->getFieldValue('Modelo')->getLookupLabel() }}</td>
    </tr>

    <tr>
        <th>Año:</th>
        <td>{{ $cotizacion->getFieldValue('A_o') }}</td>
        <th>Chasis:</th>
        <td>{{ $cotizacion->getFieldValue('Chasis') }}</td>
        <th>Valor asegurado:</th>
        <td>{{ number_format($cotizacion->getFieldValue("Suma_asegurada"), 2) }}</td>
    </tr>
    </tbody>
</table>

</body>
</html>
