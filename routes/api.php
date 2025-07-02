<?php

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Middleware\EnsureClientIsResourceOwner;

Route::middleware('auth:sanctum')->group(function () {
    //
});

require_once __DIR__ . '/api/auth.php';
require_once __DIR__ . '/api/external.php';
require_once __DIR__ . '/api/bmc.php';
