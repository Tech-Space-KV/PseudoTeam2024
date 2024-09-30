<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('website/home');
});

Route::get('/services', function () {
    return view('website/services');
});

Route::get('/authentication/customer/sign-in', function () {
    return view('auth/customer_sign_in');
});

Route::get('/authentication/customer/sign-up', function () {
    return view('auth/customer_sign_up');
});

Route::get('/authentication/service-partner/sign-in', function () {
    return view('auth/service_sign_in');
});
