<?php
namespace App\Http\Controllers;

use App\Mail\CustomerForgotPasswordMail;
use App\Mail\CustomerSignUpMail;
use App\Mail\CustomerSignUpMailCopy;
use App\Mail\ServicePartnerSignUpMail;
use App\Mail\ServicePartnerSignUpMailCopy;
use App\Models\Cart;
use App\Models\ProjectOwners;
use App\Models\ServiceProvider;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Project;
use App\Models\Notification;
use Illuminate\Support\Facades\URL;
use Mail;
use Str;
use Validator;

class AuthController extends Controller
{
    public function showSignupPage()
    {
        return view('auth/customer_sign_up');
    }

    public function signup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            // 'contact' => ['required', 'regex:/^\+?[0-9]{10,15}$/', 'unique:users,contact'],
            'contact' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'contact' => $validated['contact'],
            'user_type' => 'customer',
        ]);

        $verificationLink = URL::to('authentication/customer/verify') . '?id=' . $user->id;

        $date = date('Y-m-d H:i:s');

        Mail::to('sanskarsharma0119@gmail.com')->send(new CustomerSignUpMailCopy( $user->name, $user->email, $date));
        Mail::to($request->email)->send(new CustomerSignUpMail($verificationLink, $user->name));

        return redirect()->route('auth.customer.sign_in')->with('success', 'Signup successful! Check your email for verification link.');
    }

    public function spSignUp(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                // 'contact' => ['required', 'regex:/^\+?[0-9]{10,15}$/', 'unique:users,contact'],
                'contact' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'contact' => $validated['contact'],
                'user_type' => 'SP',
            ]);

            $verificationLink = URL::to('authentication/service-partner/verify') . '?id=' . $user->id;

            Mail::to($request->email)->send(new ServicePartnerSignUpMail($verificationLink, $user->name));
            Mail::to('sanskarsharma0119@gmail.com')->send(new ServicePartnerSignUpMailCopy($user->name, $user->email, date('Y-m-d H:i:s')));

            return redirect()->route('auth.sp.sign_in')->with('success', 'Signup successful! Check your email for verification link.');
        } catch (\Exception $e) {
            \Log::error('Service Partner Signup Error: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
        }
    }

    public function completeProfileCustomer(Request $request)
    {
        try {

            $rules = [
                'pown_country' => 'required|string|max:255',
                'pown_state' => 'required|string|max:255',
                'pown_pincode' => 'required|string|max:10',
                'pown_address' => 'required|string|max:1000',
                'type' => 'required|in:Organization,Individual',
                'pown_about' => 'required|string|max:1000',
            ];

            if ($request->type === 'Organization') {
                $rules['pown_cin'] = 'required|string|max:255';
                $rules['pown_gstpin'] = 'required|string|max:255';
            } else {
                $rules['pown_govt_id'] = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                \Log::warning('Profile validation failed', [
                    'errors' => $validator->errors()->toArray(),
                    'input' => $request->all()
                ]);
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $profile = ProjectOwners::find(session('user_id'));

            if (!$profile) {
                return redirect()->back()->with('error', 'User not found.');
            }

            $profile->pown_country = $request->pown_country;
            $profile->pown_state = $request->pown_state;
            $profile->pown_pincode = $request->pown_pincode;
            $profile->pown_address = $request->pown_address;
            $profile->pown_about = $request->about;
            $profile->pown_user_type = $request->type;
            $profile->pown_profile_completion_flag = true;

            if ($request->type === 'Organization') {
                $profile->pown_cin = $request->cin;
                $profile->pown_gstpin = $request->gst;
            } else {
                if ($request->hasFile('pown_govt_id')) {
                    $filePath = $request->file('pown_govt_id')->store('govt_ids', 'public');
                    $profile->pown_adhaarfile = $filePath;
                }
            }

            $profile->save();

            return redirect()->route('customer.dashboard')
                ->with('success', 'Profile completed successfully! Please log in.');

        } catch (\Exception $e) {
            \Log::error('Unexpected error during profile submission', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function spCompleteProfile(Request $request)
    {

        try {
            // Validate incoming request
            $data = $request->validate([
                'country' => 'required|string',
                'city' => 'required|string',
                'pincode' => 'required|string',
                'address' => 'required|string',
                'type' => 'required|in:Organization,Individual',
                'about' => 'required|string',

                'skills' => 'nullable|array|max:3',
                'skills.*.name' => 'required|string',
                'skills.*.experience' => 'required|numeric|min:0',

                'orgName' => 'nullable|string',
                'cin' => 'nullable|string',
                'gst' => 'nullable|string',

                'govtID' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            // Process skills
            $skill1 = $skill2 = $skill3 = null;
            $skills = $data['skills'] ?? [];

            if (isset($skills[0])) {
                $skill1 = $skills[0]['name'] . ' (' . $skills[0]['experience'] . ' yrs)';
            }
            if (isset($skills[1])) {
                $skill2 = $skills[1]['name'] . ' (' . $skills[1]['experience'] . ' yrs)';
            }
            if (isset($skills[2])) {
                $skill3 = $skills[2]['name'] . ' (' . $skills[2]['experience'] . ' yrs)';
            }

            $govtIDPath = null;
            if ($request->hasFile('govtID')) {
                $govtIDPath = $request->file('govtID')->store('uploads', 'public');
            }

            $seviceProvider = ServiceProvider::find(session('sp_user_id'));

            if (!$seviceProvider) {
                return redirect()->back()->with('error', 'User not found.');
            }

            $seviceProvider->sprov_country = $data['country'];
            $seviceProvider->sprov_state = $data['city'];
            $seviceProvider->sprov_pincode = $data['pincode'];
            $seviceProvider->sprov_address = $data['address'];
            $seviceProvider->sprov_user_type = $data['type'];
            $seviceProvider->sprov_about = $data['about'];
            $seviceProvider->sprov_skill1 = $skill1;
            $seviceProvider->sprov_skill2 = $skill2;
            $seviceProvider->sprov_skill3 = $skill3;
            $seviceProvider->sprov_organisation_name = $data['orgName'] ?? null;
            $seviceProvider->sprov_cin = $data['cin'] ?? null;
            $seviceProvider->sprov_gstpin = $data['gst'] ?? null;
            $seviceProvider->sprov_profile_completion_flag = true;

            $seviceProvider->save();

            return redirect()->route('service-partner.dashboard')
                ->with('success', 'Profile completed successfully! Please log in.');
        } catch (\Exception $e) {
            \Log::error('Profile submission error: ' . $e->getMessage());

            return back()->with('error', 'Something went wrong while submitting your profile. Please try again.');
        }


    }

    public function verify(Request $request)
    {

        $id = $request->query('id');

        if ($id) {
            $user = User::find($id);

            if ($user) {

                return view('customer/set_password', ['id' => $user->id]);

            } else {

                return redirect()->route('auth.customer.sign_in')->withErrors(['error' => 'Invalid verification link.']);

            }
        }

        return redirect()->route('auth.customer.sign_in')->withErrors(['error' => 'Invalid verification link.']);
    }


    public function setPassword(Request $request)
    {

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'user_id' => 'required|exists:users,id', // or project_owners,id
        ]);

        $user = User::find($request->user_id);

        if ($user) {

            ProjectOwners::create([
                'pown_name' => $user->name,
                'pown_email' => $user->email,
                'pown_password' => Hash::make($request->password),
                'pown_profile_completion_flag' => false,
            ]);

            return redirect()->route('auth.customer.sign_in')->with('success', 'Verification successful! Please sign in.');
        }

        return redirect()->route('auth.customer.sign_in')->withErrors(['error' => 'User not found.']);
    }

    public function spVerify(Request $request)
    {

        $id = $request->query('id');

        if ($id) {
            $user = User::find($id);

            if ($user) {

                return view('service-partner/set_password', ['id' => $user->id]);

            } else {

                return redirect()->route('auth.customer.sign_in')->withErrors(['error' => 'Invalid verification link.']);

            }
        }

        return redirect()->route('auth.customer.sign_in')->withErrors(['error' => 'Invalid verification link.']);
    }

    public function spSetPassword(Request $request)
    {
        // Validate password + confirmation
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);

        if ($user) {

            ServiceProvider::create([
                'sprov_name' => $user->name,
                'sprov_email' => $user->email,
                // 'sprov_contact' => $user->contact,
                'sprov_password' => Hash::make($request->password),
                // 'sprov_user_type' => 'SP',
                'sprov_profile_completion_flag' => false,
            ]);

            return redirect()->route('auth.sp.sign_in')->with('success', 'Password set successfully! Please log in.');
        }

        \Log::warning('User not found for password set. ID: ' . $request->user_id);

        return redirect()->route('auth.sp.sign_in')->withErrors(['error' => 'User not found.']);
    }

    public function showLoginPage()
    {

        $response = response()->view('auth/customer_sign_in');
        $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');

        return $response;
    }

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

                        //code added by sanskar sharma (07/04/2025)
                        $dashboardData = [
                            'unreadNotificationsCount' => Notification::where('ntfn_readflag', false)->where('ntfn_forUserId', $serviceProvider->sprov_id)->where('ntfn_type', 'cust')->count(),
                            'inProgressCount' => Project::where('plist_status', 'In Progress')->where('plist_customer_id', $serviceProvider->sprov_id)->count(),
                            'pendingCount' => Project::where('plist_status', 'No SP Assigned')->where('plist_customer_id', $serviceProvider->sprov_id)->count(),
                            'deliveredCount' => Project::where('plist_status', 'Delivered')->where('plist_customer_id', $serviceProvider->sprov_id)->count(),
                            'cartCount' => Cart::where('cart_customer_id', $serviceProvider->sprov_id)->count(),
                            'addedToCart' => Cart::where('cart_customer_id', $serviceProvider->sprov_id)->get(),
                        ];

                        session($dashboardData);

                        return redirect()->route('service-partner.dashboard');

                    } else {
                        session(['sp_user_id' => $serviceProvider->sprov_id]);
                        session(['sprov_name' => $serviceProvider->sprov_name]);
                        return redirect()->route('service-partner.complete_profile');

                    }

                }

            }

        } else {

            return redirect()->route('auth.sp.sign_in')->with('error', 'The provided credentials are incorrect.');

        }

    }

    public function customerForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        // Check if the email exists in the database
        $user = User::where('email', $email)->first();

        if ($user) {

            $projectOwner = ProjectOwners::where('pown_email', $email)->first();

            if (!$projectOwner) {
                return redirect()->back()->withErrors(['email' => 'No account found with the provided email.']);
            }

            // Generate a password reset token
            $token = Str::random(60);

            // Store the token in the database (you may want to create a separate table for this)
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => Hash::make($token),
                'created_at' => Carbon::now(),
            ]);

            $resetLink = URL::to('/customer/session/reset-password') . '?token=' . urlencode($token) . '&email=' . urlencode($email);

            // Send email
            Mail::to($email)->send(new CustomerForgotPasswordMail($resetLink, $projectOwner->pown_name));

            return redirect()->back()->with('status', 'Password reset link sent to your email.');
        } else {

        }
        return redirect()->back()->withErrors(['email' => 'Invalid email address or no account found!']);
    }

    public function showPasswordResetForm(Request $request)
    {

        $token = $request->query('token');
        $email = $request->query('email');

        $reset = DB::table('password_resets')->where('email', $email)->first();

        if (!$reset || !Hash::check($token, $reset->token)) {
            return redirect()->route('login')->withErrors(['token' => 'Invalid or expired token.']);
        }

        if (Carbon::parse($reset->created_at)->addMinutes(60)->isPast()) {
            return redirect()->route('login')->withErrors(['token' => 'Token has expired.']);
        }

        return view('customer/reset_password_form', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $passwordConfirmation = $request->input('password_confirmation');

        $user = ProjectOwners::where('pown_email', $email)->first();

        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'No account found with the provided email.']);
        }

        $user->pown_password = Hash::make($password);
        $user->save();

        DB::table('password_resets')->where('email', $email)->delete();

        return redirect()->route('auth.customer.sign_in')->with('status', 'Password reset successful. Please log in.');
    }

    public function dashboard($viewName = 'customer/dashboard', $data = [])
    {
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

        $response = response()->view($viewName, $data);

        $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');

        return $response;
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        clearstatcache();

        session_unset();
 
        session_write_close();

        setcookie(session_name(), '', 0, '/');

        $response = response()
            ->redirectToRoute('auth.customer.sign_in')
            ->with('success', 'You have been logged out.');

        $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');


        \Log::info('Logout method working1!');

        return $response;
    }

    public function spLogout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        clearstatcache();

        session_unset();

        session_write_close();

        setcookie(session_name(), '', 0, '/');

        $response = response()
            ->redirectToRoute('auth.sp.sign_in')
            ->with('success', 'You have been logged out.');

        $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->header('Pragma', 'no-cache');
        $response->header('Expires', '0');

        return $response;

    }

}