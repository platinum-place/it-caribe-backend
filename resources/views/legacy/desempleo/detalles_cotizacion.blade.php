<h5 class="d-flex justify-content-center bg-primary text-white">PRIMA MENSUAL</h5>
<div class="card-group border">
    <div class="card border-0">
        <div class="card-body">
            <img src="{{ public_path('img/espacio.png') }}" height="50" width="150">

            <p style="font-size: 15px;">
                <b>Fecha Cliente</b>
            </p>

            <p style="font-size: 15px;">
                <b>Suma Asegurada</b> <br>
                <b>Cuota Mensual de Prestamo</b> <br>
                <b>Plazo</b>
            </p>

            <p style="font-size: 15px;">
                <b>Prima Neta</b> <br>
                <b>ISC</b> <br>
                <b>Prima Total</b>
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
                    </p>

                    <p style="font-size: 15px;">
                         RD$ {{ number_format($cotizacion->getFieldValue("Suma_asegurada")) }} <br>
                         RD$ {{ number_format($cotizacion->getFieldValue("Cuota")) }} <br>
                        {{ $cotizacion->getFieldValue("Plazo") }} meses
                    </p>

                    <p style="font-size: 15px;">
                        RD$ {{ number_format($lineItem->getNetTotal() / 1.16, 2) }} <br>
                        RD$ {{ number_format($lineItem->getNetTotal() - $lineItem->getNetTotal() / 1.16, 2) }} <br>
                        RD$ {{ number_format($lineItem->getNetTotal(), 2) }}
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

    <div class="card border-0">
        <div class="card-body">
            <h6 class="card-title text-center">OBSERVACIONES</h6>
            <ul>
                <li>Pago de desempleo por hasta 6 meses.</li>
            </ul>
        </div>
    </div>
</div>