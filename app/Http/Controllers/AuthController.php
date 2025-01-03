<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
    public function dashboard($viewName = 'customer/dashboard')
    {
        // Check if user session token exists, redirect to home if not
        // Uncomment the following block if this logic is required:
        // if (!session('user_session_token')) {
        //     return view('website/home');
        // }
    
        // Generate response for the given view
        $response = response()->view($viewName);
    
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
    

}
