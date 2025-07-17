<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\HardwareController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderAddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReferAndEarnController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TicketController;
use Dom\Comment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;

// Landing Pages
Route::get('/', function () {
    return view('website/home');
})->name('home');

Route::get('/partner', function () {
    return view('website/partner');
})->name('partner');

Route::post('/post/inquire/submit', [QueryController::class, 'submitInquery'])->name('post.inquire.submit');

Route::post('/post/contact/us', [QueryController::class, 'contactUs'])->name('post.contact.us');
Route::post('/post/sp/contact/us', [QueryController::class, 'spContactUs'])->name('sp.contact.us');

//kal krunga

// Route::get('/forgot-password', function () {
//     return (new AuthController)->dashboard('customer/forgot_password');
// })->name('customer.forgot-password');

// Authentication Routes
Route::prefix('authentication/customer')->group(function () {
    Route::get('/sign-up', [AuthController::class, 'showSignupPage'])->name('auth.customer.sign_up');
    Route::post('/sign-up', [AuthController::class, 'signup'])->name('auth.customer.sign_up.post');
    Route::get('/sign-in', [AuthController::class, 'showLoginPage'])->name('auth.customer.sign_in');
    Route::post('/sign-in', [AuthController::class, 'login'])->name('auth.customer.sign_in.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('customer.logout');
    Route::get('/login', [AuthController::class, 'showLoginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/verify', [AuthController::class, 'verify'])->name('auth.customer.verify');
    Route::post('/verify', [AuthController::class, 'setPassword'])->name('customer.set-password');
    Route::get('/forgot-password', function () {
        return (new AuthController)->dashboard('customer/forgot_password');
    })->name('customer.forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'customerForgotPassword'])->name('customer.forgot-password.post');
});

Route::prefix('authentication/service-partner')->group(function () {

    Route::get('/sign-in', fn() => view('auth/service_sign_in'))->name('auth.sp.sign_in');
    Route::get('/sign-up', fn() => view('auth/service_sign_up'))->name('auth.sp.sign_up');
    Route::post('/sign-up', [AuthController::class, 'spSignup'])->name('auth.sp.sign_up.post');
    Route::post('/logout', [AuthController::class, 'spLogout'])->name('service-partner.logout');
    Route::get('/verify', [AuthController::class, 'spVerify'])->name('auth.sp.verify');
    Route::post('/verify', [AuthController::class, 'spSetPassword'])->name('sp.set-password');

});

// Customer Session Routes
Route::middleware(['auth'])->prefix('customer/session')->group(function () {
    Route::get('/', [AuthController::class, 'dashboard'])->name('customer.dashboard');
    // // In web.php
    // Route::prefix('customer/session')->group(function () {
    //     Route::post('/todo/add', [TodoController::class, 'add'])->name('todo.add');
    // });
    // Route::post('/todo/add', [TodoController::class, 'add'])->name('todo.add');
    // Route::post('/customer/session/todo/add', [TodoController::class, 'add'])->name('todo.add');

    // Route::post('/customer/session/todo/delete', [TodoController::class, 'delete'])->name('todo.delete');
    // Route::get('/customer/session/todo/fetch', [TodoController::class, 'fetchTodos'])->name('todo.fetch');

    Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store');

    Route::get('/complete-profile', function () {
        return (new AuthController)->dashboard('customer/complete_profile');
    })->name('customer.complete_profile');

    Route::post('/customer/profile/save', [AuthController::class, 'completeProfileCustomer'])->name('customer.profile.save');

    Route::get('/reports', function () {
        return (new AuthController)->dashboard('customer/reports');
    });

    // Route::get('/forgot-password', function () {
    //     return (new AuthController)->dashboard('customer/forgot_password');
    // })->name('customer.forgot-password');

    // Route::post('/forgot-password', [AuthController::class, 'customerForgotPassword'])->name('customer.forgot-password.post');


    Route::get('/reset-password', [AuthController::class, 'showPasswordResetForm'])->name('customer.password.reset');


    Route::get('/customer/session/reset-password', [AuthController::class, 'showPasswordResetForm']);
    Route::post('/customer/session/reset-password', [AuthController::class, 'resetPassword']);

    Route::post('/customer/session/reset-password', [AuthController::class, 'resetPassword'])->name('customer.reset-password.post');

    // Route::get('/search_project', function () {
    //     return view('customer/search_project');
    // });

    Route::get('/customer-verification', function () {
        return (new AuthController)->dashboard('customer/forgot_password');
    })->name('customer.customer-verification');

    Route::get('/search_project', [ProjectController::class, 'searchProject']);

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

    // Route::get('/marketplace/hardwares-orders', function () {
    //     return (new AuthController)->dashboard('customer/marketplace_hardwares_orders');
    // });

    Route::get('/marketplace/hardwares-order-details/{ordplcd_order_no}', function ($ordplcd_order_no) {
        return (new OrderController)->fetchOrderHistoryDetails($ordplcd_order_no);
    });

    Route::get('/marketplace/hardwares-orders', function () {
        return (new OrderController)->fetchOrderHistory();
    });

    Route::get('/help', function () {
        return (new AuthController)->dashboard('customer/help');
    });

    // Route::get('/profileoptions', function () {
    //     return (new AuthController)->dashboard('customer/profileoptions');
    // });

    Route::get('/profileoptions', function () {
        return (new ProfileController)->profileOptions();
    })->name('customer.profileoptions');

    Route::get('/referandearn', function () {
        return (new AuthController)->dashboard('customer/referandearn');
    });

    Route::post('/referandearnmail', [ReferAndEarnController::class, 'sendMail']);

    Route::get('/notifications', function () {
        return (new NotificationController)->fetchNotification();
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


    //need to make changes in this route.

    // Route::get('/project-timeline', function () {
    //     return (new AuthController)->dashboard('customer/project_timeline');
    // });

    Route::get('/project-timeline/{pplnr_id}', function ($pplnr_id) {
        return (new ProjectController)->projectTimeline($pplnr_id);
    });

    Route::get('/cart', function () {
        return (new CartController)->viewCart();
    });

    // Route::post('/addToCart', function () {
    //     return (new CartController)->addToCart();
    // });

    // routes/web.php
    // Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    Route::post('/marketplace/hardwares-details/addToCart', [CartController::class, 'addToCart']);

    // Route::get('/trackticket', function () {
    //     return (new AuthController)->dashboard('customer/trackticket');
    // });

    Route::get('/ticket', function () {
        return (new AuthController)->dashboard('customer/ticket');
    });


    Route::get('/trackticket', function () {
        return (new TicketController)->fetchTickets();
    });

    Route::get('/ticketdetails/{tckt_id}', function ($tckt_id) {
        return (new TicketController)->ticketDetails($tckt_id);
    });

    Route::get('/notification-details/{notificationId}', function ($notificationId) {
        return (new NotificationController)->fetchNotificationDetails($notificationId);
    });

    Route::post('/submitSupportQuery', [QueryController::class, 'submitSupportQuery'])->name('submitSupportQuery');

    Route::get('/project-details/{plist_id}', function ($plist_id) {
        return (new ProjectController)->fetchProject($plist_id);
    });

    Route::get('/ticket/{id}/attachment', [TicketController::class, 'viewAttachment'])->name('ticket.attachment');


    Route::get('/project/{id}/sow', [ProjectController::class, 'viewSow'])->name('project.sow');

    Route::post('/project/comment', [CommentController::class, 'store'])->name('comment.store');

});

Route::post('/customer/session/todo/add', [TodoController::class, 'add'])->name('todo.add');
Route::post('/customer/session/todo/delete', [TodoController::class, 'delete'])->name('todo.delete');
Route::get('/customer/session/todo/fetch', [TodoController::class, 'fetchTodos'])->name('todo.fetch');
Route::post('/customer/session/upload-dp', [ProfileController::class, 'uploadProfilePicture'])->name('profileController.upload.dp');
Route::get('/customer/session/get-profile-picture', [ProfileController::class, 'getProfilePicture'])->name('profileController.get.dp');
Route::get('/customer/session/get-location', [ProfileController::class, 'getLocation'])->name('profileController.get.location');
Route::post('/customer/session/update-location', [ProfileController::class, 'updateLocation'])->name('profileController.update.location');
Route::post('/customer/session/update-cinid', [ProfileController::class, 'updateCinId'])->name('profileController.update.cinid');
Route::get('/customer/session/cinid', [ProfileController::class, 'getCinGovId'])->name('profileController.get.cinid');
Route::post('/customer/session//change-password', [ProfileController::class, 'changePassword'])->name('profileController.changePassword');

Route::post('/login', [AuthController::class, 'spLogin'])->name('splogin.post');

Route::get('/projects/export/csv', [ProjectController::class, 'exportCSV'])->name('projects.export.csv');
Route::get('/projects/export/pdf', [ProjectController::class, 'exportPDF'])->name('projects.export.pdf');

Route::post('/save-address', [OrderAddressController::class, 'saveAddress'])->name('saveAddress');

Route::post('/save-existing-address', [OrderAddressController::class, 'saveExistingAddress'])->name('saveExistingAddress');

// Route::post('/storeticket' , [TicketController::class , 'storeTicket']);

Route::post('/customer/session/ticket/storeticket', [TicketController::class, 'storeTicket']);

Route::delete('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('placeOrder');

// Services and Queries
Route::get('/services', [ServiceController::class, 'showServices'])->name('services');
Route::post('/submit-query', [QueryController::class, 'submitQuery'])->name('submit.query');

// Chart Routes
Route::get('/customer/session/reports', [ChartController::class, 'index'])->name('customer.reports');
Route::get('/PseudoTeam2024/public/chart-data', [ChartController::class, 'getData'])->name('chart.data');



Route::middleware(['auth'])->prefix('service-partner/session')->group(function () {

    Route::get('service-partner/session/complete-profile', function () {
        return view('/service-partner/complete_profile');
    })->name('service-partner.complete_profile');

    Route::post('/service-partner/profile/save', [AuthController::class, 'spCompleteProfile'])->name('sp.profile.save');

    Route::get('/', function () {
        return view('/service-partner/dashboard');
    })->name('service-partner.dashboard');

    Route::get('/dashboard', function () {
        return view('/service-partner/dashboard');
    });

    Route::get('/sp_search_project', [ProjectController::class, 'spSearchProject']);

    // Route::get('service-partner/session/manage_project', function () {
    //     return view('/service-partner/manage_project');
    // });

    Route::get('/manage_project', function () {
        return (new ProjectController)->manageProject();
    });

    // Route::get('service-partner/session/manage_project_details', function () {
    //     return view('/service-partner/manage_project_details');
    // });

    Route::get('/manage_project_details/{pscopeId}', function ($pscopeId) {
        return (new ProjectController)->manageprojectDetails($pscopeId);
    });

    // Route::get('service-partner/session/manage_project_location', function () {
    //     return view('/service-partner/manage_project_location');
    // });

    Route::get('/manage_project_location/{projectId}', function ($projectId) {
        return (new ProjectController)->manageProjectLocation($projectId);
    });

    // Route::get('service-partner/session/manage_project_view_tasks', function () {
    //     return view('/service-partner/manage_project_view_tasks');
    // });

    Route::get('/manage_project_view_tasks/{plannerId}', function ($plannerId) {
        return (new ProjectController)->manageProjectViewTasks($plannerId);
    });

    // Route::get('service-partner/session/manage_project_edit_task', function () {
    //     return view('/service-partner/manage_project_edit_task');
    // });

    Route::get('/manage_project_edit_task/{ppTaskId}', function ($ppTaskId) {
        return (new ProjectController)->manageProjectEditTasks($ppTaskId);
    });

    Route::post('/update-task', [ProjectController::class, 'updateTask'])->name('update.task');

    // Route::get('/hardware', function () {
    //     return view('/service-partner/hardware');
    // });

    Route::get('/hardware', function () {
        return (new HardwareController)->spFetchHardware();
    })->name('hardware.fetch');

    Route::get('/import-hardware', function () {
        return view('/service-partner/import_hardware');
    });

    Route::post('/hardware/import', [HardwareController::class, 'importHardware'])->name('hardware.import');

    Route::get('/add-hardware', function () {
        return view('/service-partner/add_hardware');
    });

    Route::post('/hardware/store', [HardwareController::class, 'storeHardware'])->name('hardware.store');

    Route::get('/hardware-details', function () {
        return view('/service-partner/hardware_details');
    });

    // Route::get('/profileoptions', function () {
    //     return view('/service-partner/profileoptions');
    // });

    Route::get('/profileoptions', function () {
        return (new ProfileController)->spProfileOptions();
    })->name('service-partner.profileoptions');

    Route::get('/find-project', function () {
        return view('/service-partner/find_project');
    });
    Route::get('/find-project-details', function () {
        return view('/service-partner/find_project_details');
    });
    Route::get('/hardware-orders', function () {
        return view('/service-partner/marketplace_hardwares_orders');
    });
    Route::get('/hardware-details', function () {
        return view('/service-partner/marketplace_hardwares_details');
    });
    // Route::get('service-partner/session/reports', function () {
    //     return view('/service-partner/reports');
    // });

    Route::get('/reports', [ChartController::class, 'spIndex'])->name('sp.reports');
    // Route::get('/sp-chart-data', [ChartController::class, 'getSPData'])->name('chart.data');

    // Route::get('service-partner/session/track-project-pending', function () {
    //     return view('/service-partner/track-project-pending');
    // });

    Route::get('/project-reports-not-started', function () {
        return (new ProjectController)->projectNotStartedReports();
    });

    Route::get('/project-reports-fullfilled', function () {
        return (new ProjectController)->projectFullfilledReports();
    });

    Route::get('/project-reports-on-going', function () {
        return (new ProjectController)->projectOnGoingreports();
    });

    Route::get('/project-reports-scrapped', function () {
        return (new ProjectController)->projectScrappedReports();
    });

    // Route::get('service-partner/session/track-project-delivered', function () {
    //     return view('/service-partner/track-project-delivered');
    // });

    Route::get('/track-project-delivered', function () {
        return (new ProjectController)->spTrackProjectDelivered();
    });

    Route::get('/track-project-report', function () {
        return view('/service-partner/manage_project');
    });
    Route::get('/track-project-overdue', function () {
        return view('/service-partner/track-project-overdue');
    });

    Route::get('/help', function () {
        return view('/service-partner/help');
    });

    Route::get('/reports', function () {
        return view('/service-partner/reports');
    });

    Route::get('/referandearn', function () {
        return view('/service-partner/referandearn');
    });

    Route::post('/spreferandearnmail', [ReferAndEarnController::class, 'spSendMail']);

    // Route::get('service-partner/session/all-projects', function () {
    //     return view('/service-partner/all_projects');
    // });

    Route::get('/all-projects', function () {
        return (new ProjectController)->listOfProjects();
    });

    // Route::get('service-partner/session/notifications', function () {
    //     return view('/service-partner/notifications');
    // });

    Route::get('/notifications', function () {
        return (new NotificationController)->fetchSpNotification();
    });

    // Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store');

    // Route::get('/find-project', [ProjectController::class, 'index']);

    Route::get('/find-project', [ProjectController::class, 'findProjects']);


    Route::get('/find-project-details', [ProjectController::class, 'showProjectDetails']);

    Route::post('/submitSupportQuery', [QueryController::class, 'submitSupportQuery'])->name('spSubmitSupportQuery');

    Route::post('/sp/project/comment', [CommentController::class, 'spCommentStore'])->name('sp.comment.store');

    Route::post('/todo/add', [TodoController::class, 'spAdd'])->name('todo.sp.add');
    Route::post('todo/delete', [TodoController::class, 'spDelete'])->name('todo.sp.delete');
    Route::get('/todo/fetch', [TodoController::class, 'spFetchTodos'])->name('todo.sp.fetch');

    // Route::post('/change-password', [ProfileController::class, 'spChangePassword'])->name('profileController.spChangePassword');

    Route::post('/upload-dp', [ProfileController::class, 'spUploadProfilePicture'])->name('profileController.upload.dp.sp');
    Route::get('/get-profile-picture', [ProfileController::class, 'spGetProfilePicture'])->name('profileController.get.dp.sp');
    Route::get('get-location', [ProfileController::class, 'spGetLocation'])->name('profileController.get.location.sp');
    Route::post('/update-location', [ProfileController::class, 'spUpdateLocation'])->name('profileController.update.location.sp');
    Route::post('/update-cinid', [ProfileController::class, 'spUpdateCinId'])->name('profileController.update.cinid.sp');
    Route::get('/cinid', [ProfileController::class, 'spGetCinGovId'])->name('profileController.get.cinid.sp');
    Route::post('/change-password', [ProfileController::class, 'spChangePassword'])->name('profileController.changePassword.sp');


});

Route::post('/change-password', [ProfileController::class, 'spChangePassword'])->name('profileController.spChangePassword');

Route::get('/sp-chart-data', [ChartController::class, 'getSPData'])->name('chart.data');