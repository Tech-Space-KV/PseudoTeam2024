<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('website/home');
});

Route::get('/services', function () {
    return view('website/services');
});
