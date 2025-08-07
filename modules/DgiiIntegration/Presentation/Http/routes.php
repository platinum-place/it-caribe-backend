<?php

use Illuminate\Support\Facades\Route;
use Modules\DgiiIntegration\Presentation\Http\Controllers\FetchSeedController;
use Modules\DgiiIntegration\Presentation\Http\Controllers\FetchTokenController;
use Modules\DgiiIntegration\Presentation\Http\Controllers\SendCommercialApprovalController;
use Modules\DgiiIntegration\Presentation\Http\Controllers\SendInvoiceController;

Route::middleware('tenant.valid')
    ->prefix('company/{tenant}')
    ->group(function () {
        Route::get('fe/autenticacion/api/semilla', FetchSeedController::class);
        Route::post('fe/autenticacion/api/ValidacionCertificado', FetchTokenController::class);
        Route::post('fe/autenticacion/api/validacionCertificado', FetchTokenController::class);
        Route::post('fe/autenticacion/api/validacioncertificado', FetchTokenController::class);
        Route::post('fe/recepcion/api/ecf', SendInvoiceController::class);
        Route::post('fe/aprobacioncomercial/api/ecf', SendCommercialApprovalController::class);
    });
