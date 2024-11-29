<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ChartController;

Route::get('/', function () {
    return view('website/home');
});

Route::get('/home2', function () {
    return view('website/home2');
});

Route::get('/customer/session/complete-profile', function () {
    return view('/customer/complete_profile');
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

Route::get('/customer/session/reports', function () {
    return view('customer/reports');
});


Route::get('/customer/session/dashboard', function () {
    return view('customer/dashboard');
});



Route::get('/customer/session/reports', [ChartController::class, 'index']);

Route::get('/chart-data', [ChartController::class, 'getData']);


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


Route::get('/customer/session/marketplace/hardwares', function () {
    return view('/customer/marketplace_hardwares');
});


Route::get('/customer/session/marketplace/hardwares-orders', function () {
    return view('/customer/marketplace_hardwares_orders');
});

Route::get('/customer/session/help', function () {
    return view('/customer/help');
});
Route::get('/customer/session/profileoptions', function () {
    return view('/customer/profileoptions');
});


Route::get('customer/session/track-project-report-details', function () {
    return view('customer/track_project_report_details');
});


Route::get('customer/session/project-timeline', function () {
    return view('customer/project_timeline');
});

Route::get('customer/session/cart', function () {
    return view('customer/cart');
});

