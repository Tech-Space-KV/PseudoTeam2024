<?php
namespace App\Http\Controllers;

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
            // Redirect to the customer dashboard after successful login
            $token = bin2hex(random_bytes(16)); // Generates a 32-character hexadecimal token
            session(['user_session_token' => $token]);
            return redirect()->route('customer.dashboard');
        }
    
        // If authentication fails, return to the login page with an error message
        return redirect()->route('auth.customer.sign_in')->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    // Show dashboard
    public function dashboard($viewName = 'customer/dashboard' , $data = []) 
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
        $response = response()->view($viewName , $data);
    
        // Add headers to prevent caching
        $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');
    
        return $response;
    }
    

    // Handle logout
    public function logout(Request $request)
    {
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
    
        return $response;
    }

    public function trackProjectReportLocation($projectid)
    {
        $project_scope = ProjectScope::where('pscope_project_id', $projectid)->first();

        if (!$project_scope) {
            return redirect()->route('customer.dashboard')->with('error', 'Project not found.');
        }
 
        return view('customer.track_project_report_location', compact('project_scope'));
    }


    public function trackProjectReportDetails($projectid)
    {
        $project_planner = ProjectPlanner::where('pplnr_scope_id', $projectid)->first();

        if (!$project_planner) {
            return redirect()->route('customer.dashboard')->with('error', 'Project not found.');
        }
 
        return view('customer.track_project_report_details', compact('project_planner'));
    }

    public function trackProjectPending()
    {
        $projects = Project::where('plist_status', 'No SP Assigned')->get();

        if ($projects->isEmpty()) {
            return redirect()->route('customer.dashboard')->with('error', 'Project not found.');
        }

        return view('customer.track_project_report', compact('projects'));
    }

    public function trackProjectInProgress()
    {
        $projects = Project::where('plist_status', 'In Progress')->get();

        if ($projects->isEmpty()) {
            return redirect()->route('customer.dashboard')->with('error', 'Project not found.');
        }

        return view('customer.track_project_report', compact('projects'));
    }

    public function trackProjectDelivered()
    {
        $projects = Project::where('plist_status', 'Delivered')->get();

        if ($projects->isEmpty()) {
            return redirect()->route('customer.dashboard')->with('error', 'Project not found.');
        }

        return view('customer.track_project_report', compact('projects'));
    }

    public function trackProjectOverdue()
    {
        $currentDate = Carbon::now()->toDateString();

        $projects = Project::whereNotNull('plist_enddate')
        ->where('plist_enddate', '<=', now()->subDay()->format('d/m/Y'))
        ->get();

        if ($projects->isEmpty()) {
            return redirect()->route('customer.dashboard')->with('error', 'Project not found.');
        } 

        return view('customer.track_project_report', compact('projects'));
    }

    public function fetchHardware()
    {
        $hardwares = Hardware::all();

        return view('customer.marketplace_hardwares', compact('hardwares'));
    }

    public function fetchHardwareById($hrdws_id)
    {
        $hardware = Hardware::where('hrdws_id' , $hrdws_id)->first();

        if ($hardware) {
            return view('customer.marketplace_hardwares_details', compact('hardware'));
        }

        return back()->with('error','Problem while fetching data');
    }

    public function fetchNotification()
    {
        $notifications = Notification::all();

        if($notifications)
        {
            return view('customer.notifications', compact('notifications'));
        }

        return back()->with('error','No notification found!');
    }

    public function fetchNotificationDetails($notificationId)
    {
        $notification = Notification::where('ntfn_id' , $notificationId)->first();

        if (!$notification->ntfn_readflag)
        {
            \Log::info('if condition is working'. $notificationId);
            $notification->ntfn_readflag = true;
            $notification->save();
        }

        if($notification)
        {
            return view('customer.notification-details', compact('notification'));
        }

        return back()->with('error','No notification found!');
    }

}