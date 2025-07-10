<?php

use App\Http\Middleware\EnsureJsonRequest;
use App\Http\Middleware\SecurityHeaders;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Middleware\EnsureClientIsResourceOwner;

Route::middleware([
    EnsureClientIsResourceOwner::class,
    SecurityHeaders::class,
    EnsureJsonRequest::class,
])->group(function () {
    Route::post('/cotizador/colectiva', [\App\Http\Controllers\Api\VehicleQuoteController::class, 'estimateVehicle']);
    Route::post('/cotizador/EmitirAuto', [\App\Http\Controllers\Api\VehicleQuoteController::class, 'issueVehicle']);
    Route::get('/cotizador/CancelarAuto', [\App\Http\Controllers\Api\VehicleQuoteController::class, 'cancelVehicle']);

    Route::get('/cotizador/ValorPromedio', [\App\Http\Controllers\Api\QuoteController::class, 'valueVehicle']);
    Route::post('/cotizador/ValidarInspeccion', [\App\Http\Controllers\Api\QuoteController::class, 'validateInspection']);
    Route::post('/cotizador/Inspeccionar', [\App\Http\Controllers\Api\QuoteController::class, 'inspect']);
    Route::post('/cotizador/ObtenerQRInspeccion', [\App\Http\Controllers\Api\QuoteController::class, 'getQRInspect']);
    Route::post('/cotizador/ObtenerImagenes', [\App\Http\Controllers\Api\QuoteController::class, 'getPhotos']);

    Route::post('/cotizador/CotizaVida', [\App\Http\Controllers\Api\LifeController::class, 'estimateLife']);
    Route::post('/cotizador/EmitirVida', [\App\Http\Controllers\Api\LifeController::class, 'issueLife']);
    Route::post('/cotizador/CancelarVida', [\App\Http\Controllers\Api\LifeController::class, 'cancelLife']);

    Route::post('/cotizador/CotizaDesempleoDeuda', [\App\Http\Controllers\Api\UnemploymentDebtController::class, 'estimateUnemploymentDebt']);
    Route::post('/cotizador/EmitirDesempleoDeuda', [\App\Http\Controllers\Api\UnemploymentDebtController::class, 'issueUnemploymentDebt']);
    Route::post('/cotizador/CancelarDesempleoDeuda', [\App\Http\Controllers\Api\UnemploymentDebtController::class, 'cancelUnemploymentDebt']);

    Route::post('/cotizador/CotizaDesempleo', [\App\Http\Controllers\Api\UnemploymentController::class, 'estimateUnemployment']);
    Route::post('/cotizador/EmitirDesempleo', [\App\Http\Controllers\Api\UnemploymentController::class, 'issueUnemployment']);
    Route::post('/cotizador/CancelarDesempleo', [\App\Http\Controllers\Api\UnemploymentController::class, 'cancelUnemployment']);

    Route::post('/cotizador/CotizaIncendio', [\App\Http\Controllers\Api\FireController::class, 'estimateFire']);
    Route::post('/cotizador/EmitirIncendio', [\App\Http\Controllers\Api\FireController::class, 'issueFire']);
    Route::post('/cotizador/CancelarIncendio', [\App\Http\Controllers\Api\FireController::class, 'cancelFire']);

    Route::get('/cotizador/GetTipoEmpleado', [\App\Http\Controllers\Api\QuoteController::class, 'employmentTypes']);
    Route::get('/cotizador/GetGiroDelNegocio', [\App\Http\Controllers\Api\QuoteController::class, 'businessTypes']);

    Route::post('/SegurosLeyApi/GuardarSeguro', [\App\Http\Controllers\Api\InsuranceLawController::class, 'estimateVehicleLaw']);
    Route::get('/SegurosLeyApi/Obtener/MetodosDePago', [\App\Http\Controllers\Api\InsuranceLawController::class, 'paymentType']);
    Route::get('/SegurosLeyApi/Buscar/PorNoDocumento/{identification}', [\App\Http\Controllers\Api\InsuranceLawController::class, 'searchDocument']);
    Route::get('/SegurosLeyApi/Anular/{id}', [\App\Http\Controllers\Api\InsuranceLawController::class, 'disableVehicleLaw']);

    Route::post('/vehiculos/Marca', [\App\Http\Controllers\Api\VehicleController::class, 'makeList']);
    Route::post('/vehiculos/Modelos/{makeId}', [\App\Http\Controllers\Api\VehicleController::class, 'modelList']);
    Route::post('/vehiculos/TipoVehiculo', [\App\Http\Controllers\Api\VehicleController::class, 'typeList']);
    Route::post('/vehiculos/Accesorios', [\App\Http\Controllers\Api\VehicleController::class, 'accessoriesList']);
    Route::post('/vehiculos/Actividades', [\App\Http\Controllers\Api\VehicleController::class, 'activitiesList']);
    Route::post('/vehiculos/Circulacion', [\App\Http\Controllers\Api\VehicleController::class, 'routeList']);
    Route::get('/vehiculos/Color', [\App\Http\Controllers\Api\VehicleController::class, 'colorList']);

    Route::get('/Productos', [\App\Http\Controllers\Api\ProductController::class, 'list']);
    Route::get('/Productos/Aseguradoras/{id}', [\App\Http\Controllers\Api\ProductController::class, 'show']);
});
