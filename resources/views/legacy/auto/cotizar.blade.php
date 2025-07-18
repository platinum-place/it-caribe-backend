<form method="POST" action="{{ url("cotizaciones") }}">
    <div class="modal fade" id="cotizar_auto" tabindex="-1" aria-labelledby="cotizar_auto" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cotizar_auto">Cotizar Plan Auto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label">Marca</label>
                                <select name="marca" class="form-control selectpicker" id="marca" onchange="modelosAJAX(this)" required data-live-search="true">
                                    <option value="" selected disabled>Selecciona una Marca</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->getEntityId() }}">
                                            {{ strtoupper($marca->getFieldValue('Name')) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label">Modelo</label>
                                <select name="modelo" class="form-control selectpicker" id="modelos" required data-live-search="true">
                                    <option value="" selected disabled>Selecciona un modelo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label">Año</label>
                                <input type="number" class="form-control" name="ano" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label">Suma Asegurada</label>
                                <input type="number" class="form-control" required name="suma">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label">Plan</label>
                                <select name="plan" class="form-select">
                                    <option value="Mensual full" selected>Mensual Full</option>
                                    @if (session("cuenta_id") != "3222373000090574697")
                                        <option value="Anual full">Anual Full</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label">Uso</label>
                                <select name="uso" class="form-select">
                                    <option value="Privado" selected>Privado</option>
                                    @if (session("cuenta_id") != "3222373000090574697")
                                        <option value="Publico">Publico</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label">Estado</label>
                                <select name="estado" class="form-select">
                                    <option value="Nuevo" selected>Nuevo</option>
                                    <option value="Usado">Usado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label class="form-label" for="salvamento">Salvamento</label>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="salvamento" name="salvamento">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Cotizar</button>
                </div>
            </div>
        </div>
    </div>
</form>