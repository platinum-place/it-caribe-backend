<?php

use Illuminate\Support\Facades\Route;
use Modules\Quote\Http\Controllers\QuoteController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('quotes', QuoteController::class)->names('quote');
});
