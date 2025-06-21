<h5 class="d-flex justify-content-center bg-primary text-white">PRIMA MENSUAL</h5>
<div class="card-group border">
    <div class="card border-0">
        <div class="card-body">
            <img src="{{ public_path('img/espacio.png') }}" height="50" width="150">

            <p style="font-size: 15px;">
                <b>Valor de la Propiedad</b> <br>
                <b>Valor del Préstamo</b> <br>
                <b>Plazo</b>
            </p>

            <p style="font-size: 15px;">
                <b>Tipo de Construcción</b> <br>
                <b>Tipo de Riesgo</b> <br>
                <!-- <b>Direción</b> -->
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
                         RD$ {{ number_format($cotizacion->getFieldValue("Suma_asegurada")) }} <br>
                         RD$ {{ number_format($cotizacion->getFieldValue("Prestamo")) }} <br>
                        {{ $cotizacion->getFieldValue("Plazo") }} meses
                    </p>

                    <p style="font-size: 15px;">
                        {{ $cotizacion->getFieldValue("Construcci_n") }} <br>
                        {{ $cotizacion->getFieldValue("Riesgo") }} <br>
                        <!-- {{ $cotizacion->getFieldValue("Direcci_n") }} -->
                    </p>

                    <p style="font-size: 15px;">
                        RD$ {{ number_format($lineItem->getNetTotal() / 1.16,2) }} <br>
                        RD$ {{ number_format($lineItem->getNetTotal() - $lineItem->getNetTotal() / 1.16,2) }} <br>
                        RD$ {{ number_format($lineItem->getNetTotal(),2) }}
                    </p>
                </div>
            </div>
        @endif
    @endforeach
</div>

<div class="col-12" style="margin-bottom: 80px;">
</div>