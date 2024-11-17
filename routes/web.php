<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\QueryController;

Route::get('/', function () {
    return view('website/home');
});

Route::get('/home2', function () {
    return view('website/home2');
});

// Route::get('/services', function () {
//     return view('website/services');
// });

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

//TESTING ROUTE PROJECT UPLOAD

Route::get('/customer/session/upload-project', function () {
    return view('/customer/project_upload_form');
});

//TESTING ROUTE SERVICES

Route::get('/services', [ServiceController::class, 'showServices']);

//TESTING ROUTE SUBMIT QUERY

Route::post('/submit-query', [QueryController::class, 'submitQuery']);

Route::get('/customer/session/track-project-report', function () {
    return view('/customer/track-project-report');
});