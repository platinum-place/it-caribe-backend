<?php

use Filament\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

Route::middleware(Authenticate::class)
    ->prefix('filament/resources')
    ->name('filament.resources.')
    ->group(function () {
        Route::get('estimates/{id}/download', [\App\Http\Controllers\Api\EstimateController::class, 'download'])->name('estimate.download');
        Route::get('estimates/{id}/condicionado', [\App\Http\Controllers\Api\EstimateController::class, 'condicionado'])->name('estimate.condicionado');
    });

Route::middleware(Authenticate::class)
    ->prefix('filament')
    ->group(function () {
        Route::post('emit-estimate/{id}', [\App\Http\Controllers\Api\EmitEstimateController::class, 'store'])->name('emit-estimate.store');
    });

require_once __DIR__.'/web/filament.php';
