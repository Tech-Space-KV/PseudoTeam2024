<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HardwareController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;

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
    
    Route::get('/search_project', function () {
        return view('customer/search_project');
    });
   
    Route::get('/upload-project', function () {
        return (new AuthController)->dashboard('customer/project_upload_form');
    });

    Route::get('/track-project-report', function () {
        return (new ProjectController)->trackProjects();
    });

    Route::get('/track-project-report-location/{projectid}', function ($projectid) {
        return (new ProjectController)->trackProjectReportLocation($projectid);
    }); 

    Route::get('/track-project-report-details/{projectid}', function ($projectid) {
        return (new ProjectController)->trackProjectReportDetails($projectid);
    });

    Route::get('/track-project-pending-location/{projectid}', function ($projectid) {
        return (new ProjectController)->trackProjectReportLocation($projectid);
    }); 

    Route::get('/track-project-report-details/{projectid}', function ($projectid) {
        return (new ProjectController)->trackProjectReportDetails($projectid);
    });

    Route::get('/marketplace/hardwares', function () {
        return (new HardwareController)->fetchHardware();
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
        return (new AuthController)->fetchNotification();
    });

    Route::get('/track-project-overdue', function () {
        return (new ProjectController)->trackProjectOverdue();
    });

    Route::get('/track-project-pending', function () {
        return (new ProjectController)->trackProjectPending();
    });

    Route::get('/track-project-in-progress', function () {
        return (new ProjectController)->trackProjectInProgress();
    });

    Route::get('/track-project-delivered', function () {
        return (new ProjectController)->trackProjectDelivered();
    });

    Route::get('/marketplace/hardwares-details/{hrdws_id}', function ($hrdws_id) {
        return (new HardwareController)->fetchHardwareById($hrdws_id);
    });

    Route::get('/project-timeline', function () {
        return (new AuthController)->dashboard('customer/project_timeline');
    });

    Route::get('/cart', function () {
        return (new AuthController)->dashboard('customer/cart');
    });

    // Route::post('/addToCart', function () {
    //     return (new CartController)->addToCart();
    // });

    Route::post('/marketplace/hardwares-details/addToCart', [CartController::class,'addToCart']);

    Route::get('/trackticket', function () {
        return (new AuthController)->dashboard('customer/trackticket');
    });
    Route::get('/ticket', function () {
        return (new AuthController)->dashboard('customer/ticket');
    });

    Route::get('/notification-details/{notificationId}', function ($notificationId) {
        return (new AuthController)->fetchNotificationDetails($notificationId);
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
Route::get('service-partner/session/find-project-details', function () {
    return view('/service-partner/find_project_details');
});
Route::get('service-partner/session/hardware-orders', function () {
    return view('/service-partner/marketplace_hardwares_orders');
});
Route::get('service-partner/session/hardware-details', function () {
    return view('/service-partner/marketplace_hardwares_details');
});
Route::get('service-partner/session/reports', function () {
    return view('/service-partner/reports');
});

Route::get('service-partner/session/track-project-pending', function () {
    return view('/service-partner/track-project-pending');
});
Route::get('service-partner/session/track-project-delivered', function () {
    return view('/service-partner/track-project-delivered');
});
Route::get('service-partner/session/track-project-report', function () {
    return view('/service-partner/manage_project');
});
Route::get('service-partner/session/track-project-overdue', function () {
    return view('/service-partner/track-project-overdue');
});

Route::get('service-partner/session/help', function () {
    return view('/service-partner/help');
});

Route::get('service-partner/session/reports', function () {
    return view('/service-partner/reports');
});
Route::get('service-partner/session/referandearn', function () {
    return view('/service-partner/referandearn');
});

Route::get('service-partner/session/all-projects', function () {
    return view('/service-partner/all_projects');
});

Route::get('service-partner/session/notifications', function () {
    return view('/service-partner/notifications');
});

Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store'); 

Route::get('service-partner/session/find-project', [ProjectController::class, 'index']);


Route::get('service-partner/session/find-project-details', [ProjectController::class, 'showProjectDetails']);
