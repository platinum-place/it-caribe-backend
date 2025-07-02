<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', \App\Http\Controllers\UserController::class);
    Route::put('users/{id}/restore', [\App\Http\Controllers\UserController::class, 'restore'])->name('users.restore');
});

require_once __DIR__.'/api/auth.php';
require_once __DIR__.'/api/external.php';
require_once __DIR__.'/api/bmc.php';
