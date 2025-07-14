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
        <td style="text-align:left; font-weight: bold;">Ramo/Producto:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue('Plan') }}</td>
        <td style="text-align:center; font-weight: bold;">Correo:</td>
        <td style="text-align:center;">{{ $cotizacion->getFieldValue('Correo_electr_nico') }}</td>
        <td style="text-align:right; font-weight: bold;">Fecha:</td>
        <td style="text-align:right;">{{ date('d/m/Y', strtotime($cotizacion->getCreatedTime())) }}</td>
    </tr>
    <tr>
        <td style="text-align:left; font-weight: bold;">Cliente:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue("Nombre") . " " . $cotizacion->getFieldValue("Apellido") }}</td>
        <td style="text-align:center; font-weight: bold;">Equipamientos:</td>
        <td style="text-align:center;">{{ 'NINGUNO' }}</td>
        <td style="text-align:right; font-weight: bold;">Cédula/Pasaporte:</td>
        <td style="text-align:right;">{{ $cotizacion->getFieldValue('RNC_C_dula') }}</td>
    </tr>
    <tr>
        <td style="text-align:left; font-weight: bold;">Dirección:</td>
        <td style="text-align:left;"><p>{{ $cotizacion->getFieldValue('Direcci_n') }}</p></td>
        <td style="text-align:center; font-weight: bold;">Uso:</td>
        <td style="text-align:center;">{{ $cotizacion->getFieldValue('Uso') }}</td>
        <td style="text-align:right; font-weight: bold;">Teléfono:</td>
        <td style="text-align:right;">{{ $cotizacion->getFieldValue('Tel_Residencia') }}</td>
    </tr>
    <tr>
        <td style="text-align:left; font-weight: bold;">Tipo de vehículo:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue('Tipo_veh_culo') }}</td>
        <td style="text-align:center; font-weight: bold;">Marca:</td>
        <td style="text-align:center;">{{ $cotizacion->getFieldValue('Marca')->getLookupLabel() }}</td>
        <td style="text-align:right; font-weight: bold;">Modelo:</td>
        <td style="text-align:right;">{{ $cotizacion->getFieldValue('Modelo')->getLookupLabel() }}</td>
    </tr>
    <tr>
        <td style="text-align:left; font-weight: bold;">Año:</td>
        <td style="text-align:left;">{{ $cotizacion->getFieldValue('A_o') }}</td>
        <td style="text-align:center; font-weight: bold;">Chasis:</td>
        <td style="text-align:center;">{{ $cotizacion->getFieldValue('Chasis') }}</td>
        <td style="text-align:right; font-weight: bold;">Valor asegurado:</td>
        <td style="text-align:right;">{{ number_format($cotizacion->getFieldValue("Suma_asegurada"), 2) }}</td>
    </tr>
    </tbody>
</table>

<table style="width: 100%; border: 1px solid #000; border-collapse: collapse;">
    <tr>
        <td style="font-weight: bold;">Coberturas</td>
        @foreach ($cotizacion->getLineItems() as $lineItem)
            @if ($lineItem->getNetTotal() > 0)
                @php
                    $product = $libreria->getRecord("Products", $lineItem->getProduct()->getEntityId());
                    $vendor = $libreria->getRecord("Vendors", $product->getFieldValue('Vendor_Name')->getEntityId());
                @endphp
                <td>
                    {{ $vendor->getFieldValue('Nombre') }}
                </td>
            @endif
        @endforeach
    </tr>
{{--    <tr>--}}
{{--        <td style="font-weight: bold;">Prima Neta</td>--}}
{{--        @foreach ($cotizacion->getLineItems() as $lineItem)--}}
{{--            @if ($lineItem->getNetTotal() > 0)--}}
{{--                <td>--}}
{{--                    RD$ {{ number_format($lineItem->getNetTotal() / 1.16, 2) }}--}}
{{--                </td>--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td style="font-weight: bold;">Prima Total</td>--}}
{{--        @foreach ($cotizacion->getLineItems() as $lineItem)--}}
{{--            @if ($lineItem->getNetTotal() > 0)--}}
{{--                <td>--}}
{{--                    RD$ {{ number_format($lineItem->getNetTotal(), 2) }}--}}
{{--                </td>--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--    </tr>--}}
</table>
</body>
</html>
