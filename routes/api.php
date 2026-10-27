<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HardwareController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReferAndEarnController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'appLogin']);

// Route::get('/trackProjects', [ProjectController::class, 'appTrackProjects']);

Route::middleware('auth:sanctum')->group(function () {


Route::get('/trackProjects', [ProjectController::class, 'appTrackProjects']);
Route::get('/trackProjectsLocation', [ProjectController::class, 'appTrackProjectReportLocation']);
Route::get('/trackProjectReport/{projectid}', [ProjectController::class, 'appTrackProjectReportDetails']);
Route::get('/project-timeline/{pplnr_id}', [ProjectController::class, 'appProjectTimeline']);
Route::post('/project/store', [ProjectController::class, 'appStore']);
Route::get('/project/report', [ProjectController::class, 'appProjectReport']);
Route::get('/critical/spares', [HardwareController::class, 'appCriticalSpare']);
Route::post('/open/ticket', [TicketController::class, 'appOpenTicket']);
Route::get('/fetch/ticket', [TicketController::class, 'appFetchTicket']);
Route::get('/fetch/account' , [AuthController::class , 'appOwnerProfile']);
Route::post('/change/password' , [AuthController::class , 'appChangePassword']);
Route::post('/refer' , [ReferAndEarnController::class, 'appReferFriend']);
Route::get('/fetch/notifications' , [NotificationController::class , 'appFetchNotification']);
Route::get('/notification/details/{id}', [NotificationController::class, 'appFetchNotificationDetails']);
Route::get('/dashboard' , [AuthController::class , 'appDashboard']);
Route::post('/profile/location', [ProfileController::class, 'updateLocation']);
Route::post('/profile/details', [ProfileController::class, 'updateCinId']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/partner/onboard', [AuthController::class, 'onboard']);
