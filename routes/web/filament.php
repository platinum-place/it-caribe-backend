<?php

use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuoteFireController;
use App\Http\Controllers\QuoteLifeController;
use App\Http\Controllers\QuoteVehicleController;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)
    ->prefix('filament/resources')
    ->name('filament.resources.')
    ->group(function () {});

Route::middleware(Authenticate::class)
    ->prefix('filament')
    ->name('filament.')
    ->group(function () {
        Route::get('quotes/{id}/download-crm-documents', [QuoteController::class, 'downloadCRMDocuments'])->name('quotes.downloadCRMDocuments');

        Route::get('quote-vehicles/{quote_vehicle}', [QuoteVehicleController::class, 'download'])
            ->name('quote-vehicles.download');
        Route::get('quote-vehicles/{quote_vehicle}/certificate', [QuoteVehicleController::class, 'downloadCertificate'])
            ->name('quote-vehicles.downloadCertificate');

        Route::get('quote-lives/{quote_life}', [QuoteLifeController::class, 'download'])
            ->name('quote-lives.download');
        Route::get('quote-lives/{quote_life}/certificate', [QuoteLifeController::class, 'downloadCertificate'])
            ->name('quote-lives.downloadCertificate');

        Route::get('quote-fires/{quote_fire}', [QuoteFireController::class, 'download'])
            ->name('quote-fires.download');
        Route::get('quote-fires/{quote_fire}/certificate', [QuoteFireController::class, 'downloadCertificate'])
            ->name('quote-fires.downloadCertificate');
    });
