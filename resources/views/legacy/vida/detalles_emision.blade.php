<h5 class="d-flex justify-content-center bg-primary text-white">PRIMA MENSUAL</h5>
<div class="card-group border">
    <div class="card border-0">
        <div class="card-body">
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
                <b>Prima Neta</b> <br>
                <b>ISC</b> <br>
                <b>Prima Total</b>
            </p>
        </div>
    </div>

    <div class="card border-0">
        <div class="card-body">
            <p style="font-size: 15px;">
                {{ $cotizacion->getFieldValue("Fecha_de_nacimiento") }}

                @if (!empty($cotizacion->getFieldValue("Fecha_de_nacimiento_codeudor")))
                    <br> {{ $cotizacion->getFieldValue("Fecha_de_nacimiento_codeudor") }}
                @endif
            </p>

            <p style="font-size: 15px;">
                RD$ {{ number_format($cotizacion->getFieldValue("Suma_asegurada")) }} <br>
                {{ $cotizacion->getFieldValue("Plazo") }} meses
            </p>

            <p style="font-size: 15px;">
                RD$ {{ number_format($cotizacion->getFieldValue('Prima_neta'), 2) }}
                <br>RD$ {{ number_format($cotizacion->getFieldValue('ISC'), 2) }}
                <br>RD$ {{ number_format($cotizacion->getFieldValue('Prima'), 2) }}
            </p>
        </div>
    </div>
</div>

<div class="col-12">
    &nbsp;
</div>

<div class="card-group">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title text-center">REQUISITOS DEL DEUDOR</h6>
            @php $requisitos = $plan->getFieldValue("Requisitos_deudor"); @endphp
            <ul>
                @foreach ($requisitos as $posicion => $requisito)
                    <li>{{ $requisito  }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    @if (!empty($cotizacion->getFieldValue("Fecha_de_nacimiento_codeudor")))
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-center">REQUISITOS DEL CODEUDOR</h6>
                @php $requisitos = $plan->getFieldValue("Requisitos_codeudor"); @endphp
                <ul>
                    @foreach ($requisitos as $posicion => $requisito)
                        <li>{{ $requisito  }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
