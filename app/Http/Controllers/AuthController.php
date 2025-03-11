<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Hardware;
use App\Models\ProjectPlanner;
use App\Models\ProjectScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Project;
use App\Models\Notification;

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
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('auth.customer.sign_in')->with('success', 'Signup successful! Please log in.');
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
    public function login(Request $request)
    {
        // Validate the login data
        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {

            //added by sanskar on 22/02/2025
            $user = Auth::user();

            // Redirect to the customer dashboard after successful login
            $token = bin2hex(random_bytes(16)); // Generates a 32-character hexadecimal token
            session(['user_session_token' => $token]);

            session(['customer_id' => $user->customer_id]);
            session(['name' => $user->name]);

            //code added by sanskar sharma (20/02/2025)
            $dashboardData = [
                'unreadNotificationsCount' => Notification::where('ntfn_readflag', false)->count(),
                'recentProjects' => Project::orderBy('created_at', 'desc')->take(5)->get(),
                'inProgressCount' => Project::where('plist_status', 'In Progress')->count(),
                'pendingCount' => Project::where('plist_status', 'No SP Assigned')->count(),
                'deliveredCount' => Project::where('plist_status', 'Delivered')->count(),
                'cartCount' => Cart::where('cart_customer_id', $user->customer_id)->count(),
            ];

            session($dashboardData);
            
            return redirect()->route('customer.dashboard');
        }

        // If authentication fails, return to the login page with an error message
        return redirect()->route('auth.customer.sign_in')->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
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

    public function fetchNotification()
    {
        $notifications = Notification::all();

        if ($notifications) {
            return view('customer.notifications', compact('notifications'));
        }

        return back()->with('error', 'No notification found!');
    }

    public function fetchNotificationDetails($notificationId)
    {
        $notification = Notification::where('ntfn_id', $notificationId)->first();

        if (!$notification->ntfn_readflag) {
            $notification->ntfn_readflag = true;
            $notification->save();

            $unreadNotificationsCount = session('unreadNotificationsCount', 0);

            if ($unreadNotificationsCount > 0) {
                session(['unreadNotificationsCount' => $unreadNotificationsCount - 1]);
            }
        }

        if ($notification) {
            return view('customer.notification-details', compact('notification'));
        }

        return back()->with('error', 'No notification found!');
    }

}