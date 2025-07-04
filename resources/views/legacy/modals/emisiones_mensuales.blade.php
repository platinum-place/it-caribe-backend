<div class="modal fade" id="emisiones_mensuales" tabindex="-1" aria-labelledby="emisiones_mensuales" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emisiones_mensuales">Pólizas emitidas este mes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Aseguradora</th>
                            <th scope="col">Referidor</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ((array)$cotizaciones as $cotizacion)
                            @if (date('m/Y', strtotime($cotizacion->getFieldValue("Vigencia_desde"))) == date("m/Y"))
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($cotizacion->getFieldValue("Vigencia_desde"))) }}</td>
                                    <td>
                                        {{ $cotizacion->getFieldValue('Nombre') . ' ' . $cotizacion->getFieldValue('Apellido') }}
                                    </td>
                                    <td>{{ $cotizacion->getFieldValue('Coberturas')->getLookupLabel() }}</td>
                                    <td>{{ ($cotizacion->getFieldValue('Contact_Name')) ? $cotizacion->getFieldValue('Contact_Name')->getLookupLabel() : "" }}</td>
                                    <td>
                                        <a href="{{ url("cotizaciones/adjuntar/" . $cotizacion->getEntityId()) }}" title="Adjuntar">
                                            <i class="fas fa-upload"></i>
                                        </a>
                                        |
                                        <a href="{{ url("cotizaciones/descargar/" . $cotizacion->getEntityId()) }}" title="Descargar" target="__blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>