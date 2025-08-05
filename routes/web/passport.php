<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

Route::group([
    'as' => 'passport.',
    'prefix' => config('passport.path', 'oauth'),
    'namespace' => '\Laravel\Passport\Http\Controllers',
], function () {
    Route::post('/token', [
        'uses' => 'AccessTokenController@issueToken',
        'as' => 'token',
        'middleware' => 'throttle:100,1',
    ])
        ->withoutMiddleware(VerifyCsrfToken::class);
});
