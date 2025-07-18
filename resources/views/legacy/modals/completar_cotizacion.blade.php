<form method="POST" action="{{ url("cotizaciones/completar") }}">
    <input type="text" hidden name="garante" value="{{ $cotizacion->garante ?? 0 }}">
    <input type="text" hidden name="tipo_pago" value="{{ $cotizacion->tipo_pago }}">

    <div class="modal fade" id="completar_cotizacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="completar_cotizacion" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="completar_cotizacion">Completar cotización</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <h6>Datos del cliente</h6>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label">Nombre (Obligatorio)</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label">Apellido (Obligatorio)</label>
                                <input type="text" class="form-control" name="apellido" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label">RNC/Cédula (Obligatorio)</label>
                                <input type="text" class="form-control" name="rnc_cedula" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                @if (empty($cotizacion->fecha_deudor))
                                    <label class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" name="fecha" id="fecha">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="correo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label">Tel. Celular</label>
                                <input type="tel" class="form-control" name="telefono" placeholder="809-457-8888" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label">Tel. Residencial</label>
                                <input type="tel" class="form-control" name="tel_residencia" placeholder="809-457-8888" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label">Tel. Trabajo</label>
                                <input type="tel" class="form-control" name="tel_trabajo" placeholder="809-457-8888" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                            </div>
                        </div>
                    </div>

                    @if (empty($cotizacion->direccion))
                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion">
                        </div>
                    @endif

                    @if (!empty($cotizacion->marcaid))
                        <input type="text" hidden name="marcaid" value="{{ $cotizacion->marcaid }}">
                        <input type="text" hidden name="uso" value="{{ $cotizacion->uso }}">
                        <input type="text" hidden name="ano" value="{{ $cotizacion->ano }}">
                        <input type="text" hidden name="modeloid" value="{{ $cotizacion->modeloid }}">
                        <input type="text" hidden name="modelotipo" value="{{ $cotizacion->modelotipo }}">
                        <input type="text" hidden name="estado" value="{{ $cotizacion->estado }}">
                        <input type="text" hidden name="salvamento" value="{{ $cotizacion->salvamento }}">

                        <h6>Datos del vehículo</h6>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label">Chasis (Obligatorio)</label>
                                    <input type="text" class="form-control" name="chasis" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label">Placa</label>
                                    <input type="text" class="form-control" name="placa">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label">Color</label>
                                    <input type="text" class="form-control" name="color">
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Formulario codeudor, en caso de plan vida -->
                    @if (!empty($cotizacion->fecha_codeudor))
                        <input type="text" hidden name="fecha_codeudor" value="{{ $cotizacion->fecha_codeudor }}">

                        <h6>Datos del Codeudor</h6>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label">Nombre (Obligatorio)</label>
                                    <input type="text" class="form-control" name="nombre_codeudor" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label">Apellido (Obligatorio)</label>
                                    <input type="text" class="form-control" name="apellido_codeudor" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label">RNC/Cédula (Obligatorio)</label>
                                    <input type="text" class="form-control" name="rnc_cedula_codeudor" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control" name="correo_codeudor">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label">Tel. Celular</label>
                                    <input type="tel" class="form-control" name="telefono_codeudor" placeholder="809-457-8888" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label">Tel. Residencial</label>
                                    <input type="tel" class="form-control" name="tel_residencia_codeudor" placeholder="809-457-8888" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label">Tel. Trabajo</label>
                                    <input type="tel" class="form-control" name="tel_trabajo_codeudor" placeholder="809-457-8888" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion_codeudor">
                        </div>
                    @endif

                    @if (!empty($cotizacion->cuota))
                        <input type="text" hidden name="cuota" value="{{ $cotizacion->cuota }}">
                    @endif

                    @if (!empty($cotizacion->construccion))
                        <input type="text" hidden name="construccion" value="{{ $cotizacion->construccion }}">
                        <input type="text" hidden name="riesgo" value="{{ $cotizacion->riesgo }}">
                        <input type="text" hidden name="tipo_equipo" value="{{ $cotizacion->tipo_equipo }}">
                    @endif

                    @if (!empty($cotizacion->prestamo))
                        <input type="text" hidden name="prestamo" value="{{ $cotizacion->prestamo }}">
                    @endif

                    <!-- datos en general -->
                    <input type="text" hidden name="plan" value="{{ $cotizacion->plan }}">
                    <input type="number" hidden name="suma" value="{{ $cotizacion->suma }}">
                    <input type="text" hidden name="planes" value='{{ json_encode($cotizacion->planes)  }}'>
                    <input type="text" hidden name="plazo" value="{{ $cotizacion->plazo }}">
                    <input type="text" hidden name="fecha" value="{{ $cotizacion->fecha_deudor }}">
                    <input type="text" hidden name="direccion" value="{{ $cotizacion->direccion }}">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Completar</button>
                </div>
            </div>
        </div>
    </div>
</form>