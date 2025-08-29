<?php

use Illuminate\Support\Facades\Route;
use Modules\Zoho\Http\Controllers\ZohoController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('zohos', ZohoController::class)->names('zoho');
});
