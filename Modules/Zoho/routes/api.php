<?php

use Illuminate\Support\Facades\Route;
use Modules\Zoho\Http\Controllers\ZohoController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('zohos', ZohoController::class)->names('zoho');
});
