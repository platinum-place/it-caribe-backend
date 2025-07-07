<?php

use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleMakeController;
use App\Http\Controllers\VehicleModelController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ZohoOauthAccessTokenController;
use App\Http\Controllers\ZohoOauthRefreshTokenController;
use App\Http\Controllers\ZohoServiceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::put('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::apiResource('users', UserController::class);

    Route::put('vendors/{id}/restore', [VendorController::class, 'restore'])->name('vendors.restore');
    Route::apiResource('vendors', VendorController::class);

    Route::put('vehicle-makes/{id}/restore', [VehicleMakeController::class, 'restore'])->name('vehicle-makes.restore');
    Route::post('vehicle-makes/import', [VehicleMakeController::class, 'import'])->name('vehicle-makes.import');
    Route::apiResource('vehicle-makes', VehicleMakeController::class);

    Route::put('vehicle-models/{id}/restore', [VehicleModelController::class, 'restore'])->name('vehicle-models.restore');
    Route::post('vehicle-models/import', [VehicleModelController::class, 'import'])->name('vehicle-models.import');
    Route::apiResource('vehicle-models', VehicleModelController::class);

    Route::put('vehicle-types/{id}/restore', [VehicleTypeController::class, 'restore'])->name('vehicle-types.restore');
    Route::apiResource('vehicle-types', VehicleTypeController::class);

    Route::put('zoho-oauth-access-tokens/{id}/restore', [ZohoOauthAccessTokenController::class, 'restore'])->name('zoho-oauth-access-tokens.restore');
    Route::apiResource('zoho-oauth-access-tokens', ZohoOauthAccessTokenController::class);

    Route::put('zoho-oauth-refresh-tokens/{id}/restore', [ZohoOauthRefreshTokenController::class, 'restore'])->name('zoho-oauth-refresh-tokens.restore');
    Route::apiResource('zoho-oauth-refresh-tokens', ZohoOauthRefreshTokenController::class);

    Route::get('zoho-services/generate-token', [ZohoServiceController::class, 'generateToken'])->name('zoho-services.generateToken');
    Route::get('zoho-services/token', [ZohoServiceController::class, 'token'])->name('zoho-services.token');

    Route::put('product-types/{id}/restore', [ProductTypeController::class, 'restore'])->name('product-types.restore');
    Route::apiResource('product-types', ProductTypeController::class);
});

require_once __DIR__.'/api/auth.php';
require_once __DIR__.'/api/external.php';
