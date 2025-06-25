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

Route::get('/check-limits', function() {
    return [
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        'post_max_size' => ini_get('post_max_size'),
        'max_execution_time' => ini_get('max_execution_time'),
        'max_input_time' => ini_get('max_input_time'),
        'memory_limit' => ini_get('memory_limit'),
    ];
});
