<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\AuthController;

// Landing Pages
Route::get('/', function () {
    return view('website/home');
})->name('home');

// Authentication Routes
Route::prefix('authentication/customer')->group(function () {
    Route::get('/sign-up', [AuthController::class, 'showSignupPage'])->name('auth.customer.sign_up');
    Route::post('/sign-up', [AuthController::class, 'signup'])->name('auth.customer.sign_up.post');
    Route::get('/sign-in', [AuthController::class, 'showLoginPage'])->name('auth.customer.sign_in');
    Route::post('/sign-in', [AuthController::class, 'login'])->name('auth.customer.sign_in.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('customer.logout');
    Route::get('/login', [AuthController::class, 'showLoginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::get('/authentication/service-partner/sign-in', fn () => view('auth/service_sign_in'));
Route::get('/authentication/service-partner/sign-up', fn () => view('auth/service_sign_up'));

// Customer Session Routes
Route::middleware(['auth'])->prefix('customer/session')->group(function () {
    
    Route::get('/', [AuthController::class, 'dashboard'])->name('customer.dashboard');
    Route::view('/complete-profile', 'customer/complete_profile')->name('customer.complete_profile');
    Route::view('/reports', 'customer/reports');
    Route::view('/upload-project', 'customer/project_upload_form');
    Route::view('/track-project-report', 'customer/track-project-report');
    Route::view('/marketplace/hardwares', 'customer/marketplace_hardwares');
    Route::view('/marketplace/hardwares-orders', 'customer/marketplace_hardwares_orders');
    Route::view('/help', 'customer/help');
    Route::view('/profileoptions', 'customer/profileoptions');
    Route::view('/referandearn', 'customer/referandearn');
    Route::view('/notifications', 'customer/notifications');
    Route::view('/track-project-overdue', 'customer/track-project-overdue');
    Route::view('/track-project-pending', 'customer/track-project-pending');
    Route::view('/track-project-delivered', 'customer/track-project-delivered');
    Route::view('/marketplace/hardwares-details', 'customer/marketplace_hardwares_details');
    Route::view('/track-project-report-details', 'customer/track_project_report_details');
    Route::view('/project-timeline', 'customer/project_timeline');
    Route::view('/cart', 'customer/cart');
});

// Services and Queries
Route::get('/services', [ServiceController::class, 'showServices'])->name('services');
Route::post('/submit-query', [QueryController::class, 'submitQuery'])->name('submit.query');

// Chart Routes
Route::get('/customer/session/reports', [ChartController::class, 'index'])->name('customer.reports');
Route::get('/chart-data', [ChartController::class, 'getData'])->name('chart.data');
