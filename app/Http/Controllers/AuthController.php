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
    public function dashboard()
    {
        // if (!session('user_session_token')) {
        //     return  view('website/home');
        // }
        $response = response()->view('customer/dashboard');
        $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');

        return $response;
    }

    // Handle logout
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken(); // Regenerate session token
    $request->session()->flush();
    $response = response()->redirectToRoute('auth.customer.sign_in')->with('status', 'You have been logged out.');
    $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    $response->header('Pragma', 'no-cache');
    $response->header('Expires', '0');
    return $response;
}

}
