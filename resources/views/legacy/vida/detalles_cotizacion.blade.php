<h5 class="d-flex justify-content-center bg-primary text-white">PRIMA MENSUAL</h5>
<div class="card-group border">
    <div class="card border-0">
        <div class="card-body">
            <img src="{{ public_path('img/espacio.png') }}" height="50" width="150">

            <p style="font-size: 15px;">
                <b>Fecha Deudor</b>

                @if (!empty($cotizacion->getFieldValue("Fecha_de_nacimiento_codeudor")))
                    <br> <b>Fecha Codeudor</b>
                @endif
            </p>

            <p style="font-size: 15px;">
                <b>Suma Asegurada</b> <br>
                <b>Plazo</b>
            </p>

            <p style="font-size: 15px;">
                @if (session('cuenta_id') == "3222373000005967119")
                    <b>Prima Neta</b> <br>
                    <b>Impuestos</b> <br>
                    <b>Prima total con imp. incluidos</b><br>
                    <b>Cargos mantenimiento de cuenta</b><br>
                    <b>Gran total a pagar</b>
                @else
                    <b>Prima Neta</b> <br>
                    <b>ISC</b> <br>
                    <b>Prima Total</b>
                @endif
            </p>
        </div>
    </div>

    @foreach ($cotizacion->getLineItems() as $lineItem)
        @if ($lineItem->getNetTotal() > 0)
            @php $plan = $libreria->getRecord("Products", $lineItem->getProduct()->getEntityId()); @endphp
            <div class="card border-0">
                <div class="card-body">
                    <img src="{{ public_path('img/aseguradoras/' . $plan->getFieldValue('Vendor_Name')->getLookupLabel() . '.png') }}" height="50" width="150">

                    <p style="font-size: 15px;">
                        {{ $cotizacion->getFieldValue("Fecha_de_nacimiento") }}

                        @if (!empty($cotizacion->getFieldValue("Fecha_de_nacimiento_codeudor")))
                            <br>{{ $cotizacion->getFieldValue("Fecha_de_nacimiento_codeudor") }}
                        @endif
                    </p>

                    <p style="font-size: 15px;">
                        RD$ {{ number_format($cotizacion->getFieldValue("Suma_asegurada"), 2) }} <br>
                        {{ $cotizacion->getFieldValue("Plazo") }} meses
                    </p>

                    <p style="font-size: 15px;">
                        RD$ {{ number_format($lineItem->getNetTotal() / 1.16, 2) }}<br>
                        RD$ {{ number_format($lineItem->getNetTotal() - $lineItem->getNetTotal() / 1.16, 2) }}<br>
                        RD$ {{ number_format($lineItem->getNetTotal(), 2) }}

                        @if (session('cuenta_id') == "3222373000005967119")
                            @php $data = json_decode($lineItem->getDescription(), true); @endphp
                            <br>RD$ {{ number_format($data['monto_mantenimiento'], 2) }}
                            <br>RD$ {{ number_format($lineItem->getNetTotal() + $data['monto_mantenimiento'], 2) }}
                        @endif
                    </p>
                </div>
            </div>
        @endif
    @endforeach
</div>

<div class="col-12" style="margin-bottom: 20px;">
</div>

<div class="card-group border">
    <div class="card border-0">
        <div class="card-body">
            <h6 class="card-title text-center">REQUISITOS DEL DEUDOR</h6>

            @foreach ($cotizacion->getLineItems() as $lineItem)
                @if ($lineItem->getNetTotal() > 0)
                    @php
                    $plan = $libreria->getRecord("Products", $lineItem->getProduct()->getEntityId());
                    $requisitos = $plan->getFieldValue("Requisitos_deudor");
                    @endphp

                    <ul>
                        <li>
                            <b>{{ $plan->getFieldValue("Vendor_Name")->getLookupLabel() }}</b>:
                            @foreach ($requisitos as $posicion => $requisito)
                                {{ $requisito  }}

                                @if ($requisito === end($requisitos))
                                    .
                                @else
                                    ,
                                @endif
                            @endforeach
                        </li>
                    </ul>
                @endif
            @endforeach
        </div>
    </div>

    @if (!empty($cotizacion->getFieldValue("Fecha_de_nacimiento_codeudor")))
        <div class="card border-0">
            <div class="card-body">
                <h6 class="card-title text-center">REQUISITOS DEL CODEUDOR</h6>

                @foreach ($cotizacion->getLineItems() as $lineItem)
                    @if ($lineItem->getNetTotal() > 0)
                        @php
                        $plan = $libreria->getRecord("Products", $lineItem->getProduct()->getEntityId());
                        $requisitos = $plan->getFieldValue("Requisitos_codeudor");
                        @endphp

                        <ul>
                            <li>
                                <b>{{ $plan->getFieldValue("Vendor_Name")->getLookupLabel() }}</b>:
                                @foreach ($requisitos as $posicion => $requisito)
                                    {{ $requisito  }}

                                    @if ($requisito === end($requisitos))
                                        .
                                    @else
                                        ,
                                    @endif
                                @endforeach
                            </li>
                        </ul>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
</div>