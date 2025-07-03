<?php

use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\Partners\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Vehicle\VehicleMakeController;
use App\Http\Controllers\Vehicle\VehicleModelController;
use App\Http\Controllers\Vehicle\VehicleTypeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::put('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');

    Route::apiResource('vendors', VendorController::class);
    Route::put('vendors/{id}/restore', [VendorController::class, 'restore'])->name('vendors.restore');

    Route::apiResource('vehicle-makes', VehicleMakeController::class);
    Route::put('vehicle-makes/{id}/restore', [VehicleMakeController::class, 'restore'])->name('vehicle-makes.restore');

    Route::apiResource('vehicle-models', VehicleModelController::class);
    Route::put('vehicle-models/{id}/restore', [VehicleModelController::class, 'restore'])->name('vehicle-models.restore');

    Route::apiResource('vehicle-types', VehicleTypeController::class);
    Route::put('vehicle-types/{id}/restore', [VehicleTypeController::class, 'restore'])->name('vehicle-types.restore');

});

require_once __DIR__.'/api/auth.php';
require_once __DIR__.'/api/external.php';
require_once __DIR__.'/api/bmc.php';
