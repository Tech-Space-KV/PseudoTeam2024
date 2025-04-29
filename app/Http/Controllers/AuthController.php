<?php
namespace App\Http\Controllers;

use App\Mail\CustomerSignUpMail;
use App\Models\Cart;
use App\Models\Hardware;
use App\Models\ProjectOwners;
use App\Models\ProjectPlanner;
use App\Models\ProjectPlannerTask;
use App\Models\ProjectScope;
use App\Models\ServiceProvider;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Project;
use App\Models\Notification;
use Mail;
use Str;

class AuthController extends Controller
{
    // Show signup page
    public function showSignupPage()
    {
        return view('auth/customer_sign_up');
    }

    // Handle signup
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'contact' => ['required', 'regex:/^\+?[0-9]{10,15}$/', 'unique:users,contact'],
        ]);

        //Need to generate user_id also

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'contact' => $validated['contact'],
            'user_type' => 'customer',
        ]);

        Mail::to($request->email)->send(new CustomerSignUpMail());

        return redirect()->route('auth.customer.sign_in')->with('success', 'Signup successful! Please log in.');
    }

    public function completeProfileCustomer(Request $request)
    {
        $validated = $request->validate([
            'pown_country' => 'required|string|max:255',
            'pown_username' => 'required|string|max:255',
            'pown_email' => 'required|email|unique:project_owners,pown_email',
            'pown_password' => 'required|string|min:8|confirmed',
        ]);

        $projectOwner = new ProjectOwners();
        $projectOwner->pown_name = $validated['pown_name'];
        $projectOwner->pown_username = $validated['pown_username'];
        $projectOwner->pown_email = $validated['pown_email'];
        $projectOwner->pown_password = Hash::make($validated['pown_password']);
        $projectOwner->pown_profile_completion_flag = true;
        $projectOwner->save();

        return redirect()->route('auth.customer.sign_in')->with('success', 'Profile completed successfully! Please log in.');
    }


    // Show login page
    public function showLoginPage()
    {

        $response = response()->view('auth/customer_sign_in');
        $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');

        return $response;
    }


    // Handle login
    //old login method/function
    // public function login(Request $request)
    // {
    //     // Validate the login data
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {

    //         //added by sanskar on 22/02/2025
    //         $user = Auth::user();

    //         // Redirect to the customer dashboard after successful login
    //         $token = bin2hex(random_bytes(16)); // Generates a 32-character hexadecimal token
    //         session(['user_session_token' => $token]);

    //         session(['customer_id' => $user->customer_id]);
    //         session(['name' => $user->name]);

    //         //code added by sanskar sharma (20/02/2025)
    //         $dashboardData = [
    //             'unreadNotificationsCount' => Notification::where('ntfn_readflag', false)->count(),
    //             'recentProjects' => Project::orderBy('created_at', 'desc')->take(5)->get(),
    //             'inProgressCount' => Project::where('plist_status', 'In Progress')->count(),
    //             'pendingCount' => Project::where('plist_status', 'No SP Assigned')->count(),
    //             'deliveredCount' => Project::where('plist_status', 'Delivered')->count(),
    //             'cartCount' => Cart::where('cart_customer_id', $user->customer_id)->count(),
    //             'addedToCart' => Cart::where('cart_customer_id', $user->customer_id)->get(),
    //         ];

    //         session($dashboardData);

    //         return redirect()->route('customer.dashboard');
    //     }

    //     // If authentication fails, return to the login page with an error message
    //     return redirect()->route('auth.customer.sign_in')->withErrors([
    //         'email' => 'These credentials do not match our records.',
    //     ]);
    // }


    //new login method/function implemented by sanskar sharma on 31/03/2025
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->where('user_type', 'customer')->first();

        if ($user) {

            $projectOwner = ProjectOwners::where('pown_email', $email)->first();

            if ($projectOwner) {

                if (Hash::check($password, $projectOwner->pown_password)) {

                    Auth::login($user);

                    if ($projectOwner->pown_profile_completion_flag) {

                        $token = bin2hex(random_bytes(16));
                        session(['user_session_token' => $token]);

                        // session(['user_id' => $user->user_id]);

                        session(['user_id' => $projectOwner->pown_id]);
                        // session(['pown_id' => $projectOwner->pown_id]);
                        session(['pown_name' => $projectOwner->pown_name]);
                        session(['pown_username' => $projectOwner->pown_username]);
                        session(['pown_email' => $projectOwner->pown_email]);
                        session(['pown_complete_profile_flag' => $projectOwner->pown_profile_completion_flag]);

                        //pown_id , pown_email , pown_complete_profile_flag , pown_name , pown_username

                        //code added by sanskar sharma (20/02/2025)
                        $dashboardData = [
                            'unreadNotificationsCount' => Notification::where('ntfn_readflag', false)->where('ntfn_forUserId', $projectOwner->pown_id)->where('ntfn_type', 'cust')->count(),
                            'recentProjects' => Project::orderBy('plist_id', 'desc')->where('plist_customer_id', $projectOwner->pown_id)->take(5)->get(),
                            'inProgressCount' => Project::where('plist_status', 'In Progress')->where('plist_customer_id', $projectOwner->pown_id)->count(),
                            'pendingCount' => Project::where('plist_status', 'No SP Assigned')->where('plist_customer_id', $projectOwner->pown_id)->count(),
                            'deliveredCount' => Project::where('plist_status', 'Delivered')->where('plist_customer_id', $projectOwner->pown_id)->count(),
                            'cartCount' => Cart::where('cart_customer_id', $projectOwner->pown_id)->count(),
                            'addedToCart' => Cart::where('cart_customer_id', $projectOwner->pown_id)->get(),
                        ];

                        session($dashboardData);

                        return redirect()->route('customer.dashboard');
                    } else {
                        session(['user_id' => $projectOwner->pown_id]);
                        session(['pown_name' => $projectOwner->pown_name]);
                        return redirect()->route('customer.complete_profile');
                    }

                } else {

                    return redirect()->route('auth.customer.sign_in')->withErrors(['error' => 'The provided credentials are incorrect.']);

                }

            } else {

                return redirect()->route('auth.customer.sign_in')->withErrors(['email' => 'No account found with the provided email.']);
            }

        }

        return redirect()->route('auth.customer.sign_in')->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);

    }

    public function splogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->where('user_type', 'sp')->first();

        if ($user) {

            $serviceProvider = ServiceProvider::where('sprov_email', $email)->first();

            if ($serviceProvider) {

                if (Hash::check($password, $serviceProvider->sprov_password)) {

                    Auth::login($user);

                    if ($serviceProvider->sprov_profile_completion_flag) {

                        session(['sp_user_id' => $serviceProvider->sprov_id]);
                        session(['sprov_name' => $serviceProvider->sprov_name]);
                        session(['sprov_username' => $serviceProvider->sprov_username]);
                        session(['sprov_email' => $serviceProvider->sprov_email]);
                        session(['sprov_complete_profile_flag' => $serviceProvider->sprov_profile_completion_flag]);

                        $spId = 1;

                        // $projects = ProjectPlannerTask::with([
                        //     'projectPlanner.projectScope.project.manager' 
                        // ])
                        //     ->where('pptasks_sp_id', $spId)
                        //     ->get()
                        //     ->map(function ($task) {
                        //         return optional(optional($task->projectPlanner)->projectScope)->project;
                        //     })
                        //     ->filter()
                        //     ->unique('plist_id')
                        //     ->values();

                        // $totalAssignedProjects = ProjectPlannerTask::where('pptasks_sp_id', $spId)->count();

                        // $totalFullfilledProjects = ProjectPlannerTask::where('pptasks_sp_id', $spId)
                        //     ->get()
                        //     ->filter(function ($task) {
                        //         return Str::lower($task->pptasks_pt_status) === 'fullfilled';
                        //     })
                        //     ->count();

                        // $jobSuccessRate = $totalAssignedProjects > 0
                        //     ? round(($totalFullfilledProjects / $totalAssignedProjects) * 100, 2)
                        //     : 0;

                        //code added by sanskar sharma (07/04/2025)
                        $dashboardData = [
                            'unreadNotificationsCount' => Notification::where('ntfn_readflag', false)->where('ntfn_forUserId', $serviceProvider->sprov_id)->where('ntfn_type', 'cust')->count(),
                            // 'recentProjects' => Project::orderBy('plist_id', 'desc')->where('plist_customer_id', $serviceProvider->sprov_id)->take(5)->get(),
                            // 'recentProjects' => $projects,
                            // 'jobSuccessRate' => $jobSuccessRate,
                            'inProgressCount' => Project::where('plist_status', 'In Progress')->where('plist_customer_id', $serviceProvider->sprov_id)->count(),
                            'pendingCount' => Project::where('plist_status', 'No SP Assigned')->where('plist_customer_id', $serviceProvider->sprov_id)->count(),
                            'deliveredCount' => Project::where('plist_status', 'Delivered')->where('plist_customer_id', $serviceProvider->sprov_id)->count(),
                            'cartCount' => Cart::where('cart_customer_id', $serviceProvider->sprov_id)->count(),
                            'addedToCart' => Cart::where('cart_customer_id', $serviceProvider->sprov_id)->get(),
                        ];

                        session($dashboardData);

                        return redirect()->route('service-partner.dashboard');

                    } else {

                        return redirect()->route('service-partner.complete_profile');

                    }

                }

            }

        } else {

            return redirect()->route('auth.sp.sign_in')->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);

        }

    }

    // Show dashboard
    public function dashboard($viewName = 'customer/dashboard', $data = [])
    {
        // Check if user session token exists, redirect to home if not
        // Uncomment the following block if this logic is required:
        // if (!session('user_session_token')) {
        //     return view('website/home');
        // }

        //changes made by sanskar
        if ($viewName === 'customer/track_project_report') {
            $projects = Project::all();
            $data['projects'] = $projects;
        }

        if ($viewName === 'customer/ticket') {

            if (isset($data['ticket'])) {
                $data['readonly'] = true;
            } else {
                $data['readonly'] = false;
            }

        }

        if ($viewName === 'customer/project_upload_form') {
            if (isset($data['project_upload_form'])) {
                $data['readonly'] = true;
                $data['project'] = $data['project'] ?? null;
            } else {
                $data['readonly'] = false;
                $data['project'] = $data['project'] ?? null;
            }
        }

        // Generate response for the given view
        $response = response()->view($viewName, $data);

        // Add headers to prevent caching
        $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');

        return $response;
    }


    // Handle logout
    public function logout(Request $request)
    {

        \Log::info('Logout method working!');

        // Logout the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token
        $request->session()->regenerateToken();

        // Clear PHP's file status cache
        clearstatcache();

        // Clear session variables and destroy the session
        session_unset();
        // session_destroy();
        session_write_close();

        // Remove the session cookie
        setcookie(session_name(), '', 0, '/');

        // Regenerate session ID to prevent session fixation
        // session_regenerate_id(true);

        // Redirect with cache headers
        $response = response()
            ->redirectToRoute('auth.customer.sign_in')
            ->with('status', 'You have been logged out.');

        $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');


        \Log::info('Logout method working1!');

        return $response;
    }

}