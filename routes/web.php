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

    Route::get('/complete-profile', function () {
        return (new AuthController)->dashboard('customer/complete_profile');
    })->name('customer.complete_profile');

    Route::get('/reports', function () {
        return (new AuthController)->dashboard('customer/reports');
    });

    Route::get('/upload-project', function () {
        return (new AuthController)->dashboard('customer/project_upload_form');
    });

    Route::get('/track-project-report-location', function () {
        return (new AuthController)->dashboard('customer/track_project_report_location');
    });

    Route::get('/track-project-report', function () {
        return (new AuthController)->dashboard('customer/track_project_report');
    });

    Route::get('/marketplace/hardwares', function () {
        return (new AuthController)->dashboard('customer/marketplace_hardwares');
    });

    Route::get('/marketplace/hardwares-orders', function () {
        return (new AuthController)->dashboard('customer/marketplace_hardwares_orders');
    });

    Route::get('/help', function () {
        return (new AuthController)->dashboard('customer/help');
    });

    Route::get('/profileoptions', function () {
        return (new AuthController)->dashboard('customer/profileoptions');
    });

    Route::get('/referandearn', function () {
        return (new AuthController)->dashboard('customer/referandearn');
    });

    Route::get('/notifications', function () {
        return (new AuthController)->dashboard('customer/notifications');
    });

    Route::get('/track-project-overdue', function () {
        return (new AuthController)->dashboard('customer/track-project-overdue');
    });

    Route::get('/track-project-pending', function () {
        return (new AuthController)->dashboard('customer/track-project-pending');
    });

    Route::get('/track-project-delivered', function () {
        return (new AuthController)->dashboard('customer/track-project-delivered');
    });

    Route::get('/marketplace/hardwares-details', function () {
        return (new AuthController)->dashboard('customer/marketplace_hardwares_details');
    });

    Route::get('/track-project-report-details', function () {
        return (new AuthController)->dashboard('customer/track_project_report_details');
    });

    Route::get('/project-timeline', function () {
        return (new AuthController)->dashboard('customer/project_timeline');
    });

    Route::get('/cart', function () {
        return (new AuthController)->dashboard('customer/cart');
    });
});

// Services and Queries
Route::get('/services', [ServiceController::class, 'showServices'])->name('services');
Route::post('/submit-query', [QueryController::class, 'submitQuery'])->name('submit.query');

// Chart Routes
Route::get('/customer/session/reports', [ChartController::class, 'index'])->name('customer.reports');
Route::get('/chart-data', [ChartController::class, 'getData'])->name('chart.data');


Route::get('service-partner/session/complete-profile', function () {
    return view('/service-partner/complete_profile');
});
Route::get('/service-partner/session/', function () {
    return view('/service-partner/dashboard');
});

Route::get('/service-partner/session/dashboard', function () {
    return view('/service-partner/dashboard');
});

Route::get('service-partner/session/manage_project', function () {
    return view('/service-partner/manage_project');
});

Route::get('service-partner/session/manage_project_details', function () {
    return view('/service-partner/manage_project_details');
});

Route::get('service-partner/session/manage_project_location', function () {
    return view('/service-partner/manage_project_location');
});

Route::get('service-partner/session/manage_project_view_tasks', function () {
    return view('/service-partner/manage_project_view_tasks');
});
Route::get('service-partner/session/manage_project_edit_task', function () {
    return view('/service-partner/manage_project_edit_task');
});

Route::get('service-partner/session/hardware', function () {
    return view('/service-partner/hardware');
});
Route::get('service-partner/session/import-hardware', function () {
    return view('/service-partner/import_hardware');
});
Route::get('service-partner/session/add-hardware', function () {
    return view('/service-partner/add_hardware');
});

Route::get('service-partner/session/hardware-details', function () {
    return view('/service-partner/hardware_details');
});

Route::get('service-partner/session/profileoptions', function () {
    return view('/service-partner/profileoptions');

});

Route::get('service-partner/session/find-project', function () {
    return view('/service-partner/find_project');
});