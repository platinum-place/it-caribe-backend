<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    EnsureClientIsResourceOwner::class,
    SecurityHeaders::class,
    EnsureJsonRequest::class,
])
    ->group(function () {
        Route::post('/cotizador/colectiva', \App\Http\Controllers\Quote\Vehicle\EstimateQuoteVehicleController::class);
        Route::post('/cotizador/EmitirAuto', \App\Http\Controllers\Quote\Vehicle\IssueQuoteVehicleController::class);
        Route::get('/cotizador/CancelarAuto', \App\Http\Controllers\Quote\Vehicle\CancelQuoteVehicleController::class);
        Route::get('/cotizador/ValorPromedio', \App\Http\Controllers\Quote\Vehicle\AverageValueController::class);
        Route::post('/cotizador/ValidarInspeccion', \App\Http\Controllers\Quote\Vehicle\ValidateInspectionController::class);
        Route::post('/cotizador/Inspeccionar', \App\Http\Controllers\Quote\Vehicle\InspectController::class);
        Route::post('/cotizador/ObtenerQRInspeccion', \App\Http\Controllers\Quote\Vehicle\InspectionQRController::class);
        Route::post('/cotizador/ObtenerImagenes', \App\Http\Controllers\Quote\Vehicle\PhotosController::class);

//        Route::post('/SegurosLeyApi/GuardarSeguro', [\App\Http\Controllers\Api\InsuranceLawController::class, 'estimateVehicleLaw']);
//        Route::get('/SegurosLeyApi/Obtener/MetodosDePago', [\App\Http\Controllers\Api\InsuranceLawController::class, 'paymentType']);
//        Route::get('/SegurosLeyApi/Buscar/PorNoDocumento/{identification}', [\App\Http\Controllers\Api\InsuranceLawController::class, 'searchDocument']);
//        Route::get('/SegurosLeyApi/Anular/{id}', [\App\Http\Controllers\Api\InsuranceLawController::class, 'disableVehicleLaw']);
//
//        Route::post('/vehiculos/Marca', [\App\Http\Controllers\Api\VehicleController::class, 'makeList']);
//        Route::post('/vehiculos/Modelos/{makeId}', [\App\Http\Controllers\Api\VehicleController::class, 'modelList']);
//        Route::post('/vehiculos/TipoVehiculo', [\App\Http\Controllers\Api\VehicleController::class, 'typeList']);
//        Route::post('/vehiculos/Accesorios', [\App\Http\Controllers\Api\VehicleController::class, 'accessoriesList']);
//        Route::post('/vehiculos/Actividades', [\App\Http\Controllers\Api\VehicleController::class, 'activitiesList']);
//        Route::post('/vehiculos/Circulacion', [\App\Http\Controllers\Api\VehicleController::class, 'routeList']);
//        Route::get('/vehiculos/Color', [\App\Http\Controllers\Api\VehicleController::class, 'colorList']);
//
//        Route::post('/cotizador/CotizaVida', [\App\Http\Controllers\Api\LifeController::class, 'estimateLife']);
//        Route::post('/cotizador/EmitirVida', [\App\Http\Controllers\Api\LifeController::class, 'issueLife']);
//        Route::post('/cotizador/CancelarVida', [\App\Http\Controllers\Api\LifeController::class, 'cancelLife']);
//
//        Route::post('/cotizador/CotizaDesempleoDeuda', [\App\Http\Controllers\Api\UnemploymentDebtController::class, 'estimateUnemploymentDebt']);
//        Route::post('/cotizador/EmitirDesempleoDeuda', [\App\Http\Controllers\Api\UnemploymentDebtController::class, 'issueUnemploymentDebt']);
//        Route::post('/cotizador/CancelarDesempleoDeuda', [\App\Http\Controllers\Api\UnemploymentDebtController::class, 'cancelUnemploymentDebt']);
//
//        Route::post('/cotizador/CotizaDesempleo', [\App\Http\Controllers\Api\UnemploymentController::class, 'estimateUnemployment']);
//        Route::post('/cotizador/EmitirDesempleo', [\App\Http\Controllers\Api\UnemploymentController::class, 'issueUnemployment']);
//        Route::post('/cotizador/CancelarDesempleo', [\App\Http\Controllers\Api\UnemploymentController::class, 'cancelUnemployment']);
//
//        Route::post('/cotizador/CotizaIncendio', [\App\Http\Controllers\Api\FireController::class, 'estimateFire']);
//        Route::post('/cotizador/EmitirIncendio', [\App\Http\Controllers\Api\FireController::class, 'issueFire']);
//        Route::post('/cotizador/CancelarIncendio', [\App\Http\Controllers\Api\FireController::class, 'cancelFire']);
//
//        Route::get('/cotizador/GetTipoEmpleado', [\App\Http\Controllers\Api\QuoteController::class, 'employmentTypes']);
//        Route::get('/cotizador/GetGiroDelNegocio', [\App\Http\Controllers\Api\QuoteController::class, 'businessTypes']);
//
//        Route::get('/Productos', [\App\Http\Controllers\Api\ProductController::class, 'list']);
//        Route::get('/Productos/Aseguradoras/{id}', [\App\Http\Controllers\Api\ProductController::class, 'show']);
    });
