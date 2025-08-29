<?php

use Illuminate\Support\Facades\Route;
use Modules\Quote\Http\Controllers\QuoteController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('quotes', QuoteController::class)->names('quote');
});
