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
        Route::get('estimates/{id}/download', [\App\Http\Controllers\EstimateController::class, 'download'])->name('estimate.download');
        Route::get('estimates/{id}/condicionado', [\App\Http\Controllers\EstimateController::class, 'condicionado'])->name('estimate.condicionado');
    });
