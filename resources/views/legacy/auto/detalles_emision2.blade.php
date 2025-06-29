<div class="page-break"></div>

<table width="100%" style="border-collapse: collapse; font-size: 15px;">
    <tr>
        <!-- Columna izquierda -->
        <td width="50%" style="border: 1px solid #000; vertical-align: top; padding: 5px;">
            @php
                $logoPath = public_path("img/aseguradoras/" . $plan->getFieldValue("Vendor_Name")->getLookupLabel() . ".png");
                $logoBase64 = '';
                if (file_exists($logoPath)) {
                    $logoData = base64_encode(file_get_contents($logoPath));
                    $logoMime = mime_content_type($logoPath);
                    $logoBase64 = 'data:' . $logoMime . ';base64,' . $logoData;
                }
            @endphp

            @if($logoBase64)
                <img src="{{ $logoBase64 }}" style="width: 150px; height: 70px;" alt="">
            @endif

            <table width="100%" style="border-collapse: collapse;">
                <tbody>
                <tr>
                    <th align="left" style="padding: 2px;">Póliza</th>
                    <td style="padding: 2px;">{{ $plan->getFieldValue('P_liza') }}</td>
                </tr>
                <tr>
                    <th align="left" style="padding: 2px;">Marca</th>
                    <td style="padding: 2px;">{{ $cotizacion->getFieldValue('Marca')->getLookupLabel() }}</td>
                </tr>
                <tr>
                    <th align="left" style="padding: 2px;">Modelo</th>
                    <td style="padding: 2px;">{{ $cotizacion->getFieldValue('Modelo')->getLookupLabel() }}</td>
                </tr>
                <tr>
                    <th align="left" style="padding: 2px;">Chasis</th>
                    <td style="padding: 2px;">{{ $cotizacion->getFieldValue('Chasis') }}</td>
                </tr>
                <tr>
                    <th align="left" style="padding: 2px;">Placa</th>
                    <td style="padding: 2px;">{{ $cotizacion->getFieldValue('Placa') }}</td>
                </tr>
                <tr>
                    <th align="left" style="padding: 2px;">Año</th>
                    <td style="padding: 2px;">{{ $cotizacion->getFieldValue('A_o') }}</td>
                </tr>
                <tr>
                    <th align="left" style="padding: 2px;">Desde</th>
                    <td style="padding: 2px;">{{ date('d/m/Y', strtotime($cotizacion->getCreatedTime())) }}</td>
                </tr>
                <tr>
                    <th align="left" style="padding: 2px;">Hasta</th>
                    <td style="padding: 2px;">{{ date('d/m/Y', strtotime($cotizacion->getFieldValue('Valid_Till'))) }}</td>
                </tr>
                </tbody>
            </table>
        </td>

        <!-- Columna derecha -->
        <td width="50%" style="border: 1px solid #000; vertical-align: top; padding: 5px;">
            <div style="text-align: center; font-weight: bold; margin-bottom: 8px;">EN CASO DE ACCIDENTE</div>
            <p style="margin: 0 0 8px;">
                Realiza el levantamiento del acta policial y obtén la siguiente información:
            </p>
            <ul style="margin: 0 0 8px; padding-left: 18px;">
                <li>Nombre, dirección y teléfonos del conductor, los lesionados, del propietario y de los testigos.</li>
                <li>Número de placa y póliza del vehículo involucrado, nombre de la aseguradora.</li>
            </ul>
            <p style="margin: 0 0 8px;"><strong>EN CASO DE ROBO:</strong> Notifica de inmediato a la policía y a la aseguradora.</p>
            <div style="text-align: center; font-weight: bold; margin: 10px 0;">RESERVE SU DERECHO</div>

            <p style="margin: 0 0 8px;"><strong>Aseguradora:</strong> Tel. {{ $plan->getFieldValue('Tel_aseguradora') }}</p>

            <table width="100%" style="border-collapse: collapse;">
                <tr>
                    @if ($plan->getFieldValue('En_caso_de_accidente'))
                        <td style="padding: 2px; vertical-align: top;">
                            <strong>{{ $plan->getFieldValue('En_caso_de_accidente') }}</strong><br>
                            Tel. Sto. Dgo {{ $plan->getFieldValue('Tel_santo_domingo') }}<br>
                            Tel. Santiago {{ $plan->getFieldValue('Tel_santiago') }}
                        </td>
                    @endif

                    @if ($plan->getFieldValue('Asistencia_vial') == 1)
                        <td style="padding: 2px; vertical-align: top;">
                            <strong>Asistencia vial 24 horas</strong><br>
                            Tel. {{ $plan->getFieldValue('Tel_asistencia_vial') }}
                        </td>
                    @endif
                </tr>
            </table>
        </td>
    </tr>
</table>
