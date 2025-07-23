<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

require_once __DIR__.'/web/filament.php';
require_once __DIR__.'/web/passport.php';
