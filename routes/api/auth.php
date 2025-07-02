<?php

use App\Http\Controllers\Auth\AuthenticateController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', [AuthenticateController::class, 'store'])
        ->middleware('guest')
        ->name('login');

    Route::post('logout', [AuthenticateController::class, 'destroy'])
        ->middleware('auth:sanctum')
        ->name('logout');
});
