<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::fallback(function () {
    return redirect('/dashboard');
});
