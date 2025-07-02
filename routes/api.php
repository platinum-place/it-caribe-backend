<?php

use App\Http\Controllers\Partners\VendorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::put('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');

    Route::apiResource('vendors', VendorController::class);
    Route::put('vendors/{id}/restore', [VendorController::class, 'restore'])->name('users.restore');
});

require_once __DIR__.'/api/auth.php';
require_once __DIR__.'/api/external.php';
require_once __DIR__.'/api/bmc.php';
