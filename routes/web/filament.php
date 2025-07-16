<?php

use App\Http\Controllers\Api\EmitEstimateController;
use App\Http\Controllers\Api\EstimateController;
use App\Http\Controllers\QuoteVehicleController;
use App\Http\Controllers\ZohoCRMController;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)
    ->prefix('filament/resources')
    ->name('filament.resources.')
    ->group(function () {
        Route::get('estimates/{id}/download', [EstimateController::class, 'download'])->name('estimate.download');
        Route::get('estimates/{id}/condicionado', [EstimateController::class, 'condicionado'])->name('estimate.condicionado');
    });

Route::middleware(Authenticate::class)
    ->prefix('filament')
    ->group(function () {
        Route::post('emit-estimate/{id}', [EmitEstimateController::class, 'store'])->name('emit-estimate.store');
    });

Route::middleware(Authenticate::class)
    ->prefix('filament')
    ->name('filament.')
    ->group(function () {
        Route::get('quote-vehicles/{quote_vehicle}', [QuoteVehicleController::class, 'download'])
            ->name('quote-vehicles.download');
        Route::get('quote-vehicles/{quote_vehicle}/completed', [QuoteVehicleController::class, 'downloadCompleted'])
            ->name('quote-vehicles.downloadCompleted');

        Route::get('zoho-crm/download-product-attachments/{id}', [ZohoCRMController::class, 'downloadProductAttachments'])
            ->name('zoho-crm.download-product-attachments');
    });
