<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('website/home');
});

Route::get('/home2', function () {
    return view('website/home2');
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

Route::get('/authentication/service-partner/sign-up', function () {
    return view('auth/service_sign_up');
});

// CUSTOMER LOGIN SESSION ROUTES ARE AS FOLLOWING

Route::get('/customer/session/', function () {
    return view('customer/dashboard');
});

Route::get('/customer/session/dashboard', function () {
    return view('customer/dashboard');
});
