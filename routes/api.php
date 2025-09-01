<?php

use App\Http\Middleware\EnsureJsonRequest;
use App\Http\Middleware\SecurityHeaders;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Middleware\EnsureClientIsResourceOwner;

Route::middleware(EnsureClientIsResourceOwner::class)
    ->middleware(SecurityHeaders::class)
    ->middleware(EnsureJsonRequest::class)
    ->group(function () {
        //         Route::post('/cotizador/colectiva', \App\Http\Controllers\EstimateQuoteVehicleController::class);
        Route::post('/cotizador/EmitirAuto', \App\Http\Controllers\IssueQuoteVehicleController::class);
        Route::get('/cotizador/CancelarAuto', \App\Http\Controllers\CancelQuoteVehicleController::class);
        Route::get('/cotizador/ValorPromedio', \App\Http\Controllers\AverageValueController::class);
        //         Route::post('/cotizador/ValidarInspeccion', \App\Http\Controllers\ValidateInspectionController::class);
        //         Route::post('/cotizador/Inspeccionar', \App\Http\Controllers\InspectController::class);
        //         Route::post('/cotizador/ObtenerQRInspeccion', \App\Http\Controllers\InspectionQRController::class);
        Route::post('/cotizador/ObtenerImagenes', \App\Http\Controllers\PhotosController::class);

        Route::post('/vehiculos/Marca', \App\Http\Controllers\FetchVehicleMakeController::class);
        Route::post('/vehiculos/Modelos/{makeId}', \App\Http\Controllers\FetchVehicleModelController::class);
        Route::post('/vehiculos/TipoVehiculo', \App\Http\Controllers\FetchVehicleTypeController::class);
        Route::post('/vehiculos/Accesorios', \App\Http\Controllers\FetchVehicleAccessoryController::class);
        Route::post('/vehiculos/Actividades', \App\Http\Controllers\FetchVehicleActivityController::class);
        Route::post('/vehiculos/Circulacion', \App\Http\Controllers\FetchVehicleRouteController::class);
        Route::get('/vehiculos/Color', \App\Http\Controllers\FetchVehicleColorController::class);

        // Route::post('/cotizador/CotizaVida', \App\Http\Controllers\EstimateQuoteLifeController::class);
        Route::post('/cotizador/EmitirVida', \App\Http\Controllers\IssueQuoteLifeController::class);
        // Route::post('/cotizador/CancelarVida', \App\Http\Controllers\CancelQuoteLifeController::class);

        //        Route::post('/cotizador/CotizaDesempleoDeuda', [\App\Http\Controllers\Api\UnemploymentDebtController::class, 'estimateUnemploymentDebt']);
        //        Route::post('/cotizador/EmitirDesempleoDeuda', [\App\Http\Controllers\Api\UnemploymentDebtController::class, 'issueUnemploymentDebt']);
        //        Route::post('/cotizador/CancelarDesempleoDeuda', [\App\Http\Controllers\Api\UnemploymentDebtController::class, 'cancelUnemploymentDebt']);

        //        Route::post('/cotizador/CotizaDesempleo', [\App\Http\Controllers\Api\UnemploymentController::class, 'estimateUnemployment']);
        //        Route::post('/cotizador/EmitirDesempleo', [\App\Http\Controllers\Api\UnemploymentController::class, 'issueUnemployment']);
        //        Route::post('/cotizador/CancelarDesempleo', [\App\Http\Controllers\Api\UnemploymentController::class, 'cancelUnemployment']);

        // Route::post('/cotizador/CotizaIncendio', \App\FilamentHttp\Controllers\Quote\Fire\EstimateQuoteFireController::class);
        //        Route::post('/cotizador/EmitirIncendio', [\App\Http\Controllers\Api\FireController::class, 'issueFire']);
        //        Route::post('/cotizador/CancelarIncendio', [\App\Http\Controllers\Api\FireController::class, 'cancelFire']);

        //        Route::get('/cotizador/GetTipoEmpleado', [\App\Http\Controllers\Api\QuoteController::class, 'employmentTypes']);
        //        Route::get('/cotizador/GetGiroDelNegocio', [\App\Http\Controllers\Api\QuoteController::class, 'businessTypes']);

        //        Route::get('/Productos', [\App\Http\Controllers\Api\ProductController::class, 'list']);
        //        Route::get('/Productos/Aseguradoras/{id}', [\App\Http\Controllers\Api\ProductController::class, 'show']);

        //        Route::post('/SegurosLeyApi/GuardarSeguro', [\App\Http\Controllers\Api\InsuranceLawController::class, 'estimateVehicleLaw']);
        //        Route::get('/SegurosLeyApi/Obtener/MetodosDePago', [\App\Http\Controllers\Api\InsuranceLawController::class, 'paymentType']);
        //        Route::get('/SegurosLeyApi/Buscar/PorNoDocumento/{identification}', [\App\Http\Controllers\Api\InsuranceLawController::class, 'searchDocument']);
        //        Route::get('/SegurosLeyApi/Anular/{id}', [\App\Http\Controllers\Api\InsuranceLawController::class, 'disableVehicleLaw']);
    });
