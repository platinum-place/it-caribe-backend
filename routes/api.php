<?php

use App\Http\Middleware\EnsureJsonRequest;
use App\Http\Middleware\SecurityHeaders;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Middleware\EnsureClientIsResourceOwner;

Route::middleware(EnsureClientIsResourceOwner::class)
    ->middleware(SecurityHeaders::class)
    ->middleware(EnsureJsonRequest::class)
    ->group(function () {
        Route::post('/cotizador/colectiva', \App\Http\Controllers\Quote\Vehicle\EstimateQuoteVehicleController::class);
        Route::post('/cotizador/EmitirAuto', \App\Http\Controllers\Quote\Vehicle\IssueQuoteVehicleController::class);
        Route::get('/cotizador/CancelarAuto', \App\Http\Controllers\Quote\Vehicle\CancelQuoteVehicleController::class);
        Route::get('/cotizador/ValorPromedio', \App\Http\Controllers\Quote\Vehicle\AverageValueController::class);
        Route::post('/cotizador/ValidarInspeccion', \App\Http\Controllers\Quote\Vehicle\ValidateInspectionController::class);
        Route::post('/cotizador/Inspeccionar', \App\Http\Controllers\Quote\Vehicle\InspectController::class);
        Route::post('/cotizador/ObtenerQRInspeccion', \App\Http\Controllers\Quote\Vehicle\InspectionQRController::class);
        Route::post('/cotizador/ObtenerImagenes', \App\Http\Controllers\Quote\Vehicle\PhotosController::class);

        Route::post('/vehiculos/Marca', \App\Http\Controllers\Vehicle\FetchVehicleMakeController::class);
        Route::post('/vehiculos/Modelos/{makeId}', \App\Http\Controllers\Vehicle\FetchVehicleModelController::class);
        Route::post('/vehiculos/TipoVehiculo', \App\Http\Controllers\Vehicle\FetchVehicleTypeController::class);
        Route::post('/vehiculos/Accesorios', \App\Http\Controllers\Vehicle\FetchVehicleAccessoryController::class);
        Route::post('/vehiculos/Actividades', \App\Http\Controllers\Vehicle\FetchVehicleActivityController::class);
        Route::post('/vehiculos/Circulacion', \App\Http\Controllers\Vehicle\FetchVehicleRouteController::class);
        Route::get('/vehiculos/Color', \App\Http\Controllers\Vehicle\FetchVehicleColorController::class);

        Route::post('/cotizador/CotizaVida', \App\Http\Controllers\Quote\Life\EstimateQuoteLifeController::class);
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

        //        Route::post('/SegurosLeyApi/GuardarSeguro', [\App\Http\Controllers\Api\InsuranceLawController::class, 'estimateVehicleLaw']);
        //        Route::get('/SegurosLeyApi/Obtener/MetodosDePago', [\App\Http\Controllers\Api\InsuranceLawController::class, 'paymentType']);
        //        Route::get('/SegurosLeyApi/Buscar/PorNoDocumento/{identification}', [\App\Http\Controllers\Api\InsuranceLawController::class, 'searchDocument']);
        //        Route::get('/SegurosLeyApi/Anular/{id}', [\App\Http\Controllers\Api\InsuranceLawController::class, 'disableVehicleLaw']);
    });
