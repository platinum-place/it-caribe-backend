<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
    //    return view('welcome');
});

require_once __DIR__.'/passport.php';
