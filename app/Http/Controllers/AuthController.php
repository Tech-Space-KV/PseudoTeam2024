<?php
namespace App\Http\Controllers;

use App\Mail\CustomerForgotPasswordMail;
use App\Mail\CustomerSignUpMail;
use App\Mail\CustomerSignUpMailCopy;
use App\Mail\ServicePartnerForgotPasswordMail;
use App\Mail\ServicePartnerSignUpMail;
use App\Mail\ServicePartnerSignUpMailCopy;
use App\Models\Cart;
use App\Models\ProjectOwner;
use App\Models\ProjectOwners;
use App\Models\ProjectPlanner;
use App\Models\ProjectPlannerTask;
use App\Models\ProjectScope;
use App\Models\ReferralTable;
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
use Illuminate\Validation\Rule;
use Mail;
use Str;
use Throwable;
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
            'promo_code' => 'nullable|string|max:255',
        ]);

        if ($validated['promo_code']) {

            $flag = ReferralTable::where('rfrls_promo_code', $validated['promo_code'])->exists();
            if (!$flag) {
                return redirect()->back()->withErrors(['promo_code_error' => 'Invalid promo code.']);
            } else {
                $flag->rfrls_onboard_flag = true;
                $flag->save();
            }
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'contact' => $validated['contact'],
            'promo_code' => $validated['promo_code'] ?? null,
            'user_type' => 'customer',
        ]);

        $verificationLink = URL::to('authentication/customer/verify') . '?id=' . $user->id;

        $date = date('Y-m-d H:i:s');

        Mail::to('info@pseudoteam.com')->send(new CustomerSignUpMailCopy($user->name, $user->email, $date));
        Mail::to($request->email)->send(new CustomerSignUpMail($verificationLink, $user->name));

        return redirect()->route('auth.customer.sign_in')->with('success', 'Signup successful! Check your email for verification link.');
    }

    // public function spSignUp(Request $request)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'name' => 'required|string|max:255',
    //             'email' => 'required|email',
    //             // 'contact' => ['required', 'regex:/^\+?[0-9]{10,15}$/', 'unique:users,contact'],
    //             'contact' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
    //             'promo_code' => 'nullable|string|max:255',
    //         ]);

    //         if ($validated['promo_code']) {

    //             $flag = ReferralTable::where('rfrls_promo_code', $validated['promo_code'])->exists();
    //             if (!$flag) {
    //                 return redirect()->back()->withErrors(['promo_code_error' => 'Invalid promo code.']);
    //             } else {
    //                 $flag->rfrls_onboard_flag = true;
    //                 $flag->save();
    //             }
    //         }

    //         $user = User::create([
    //             'name' => $validated['name'],
    //             'email' => $validated['email'],
    //             'contact' => $validated['contact'],
    //             'promo_code' => $validated['promo_code'] ?? null,
    //             'user_type' => 'SP',
    //         ]);

    //         $verificationLink = URL::to('authentication/service-partner/verify') . '?id=' . $user->id;

    //         Mail::to($request->email)->send(new ServicePartnerSignUpMail($verificationLink, $user->name));
    //         Mail::to('info@pseudoteam.com')->send(new ServicePartnerSignUpMailCopy($user->name, $user->email, date('Y-m-d H:i:s')));

    //         \Log::info('Working sp sign up till here!');

    //         return redirect()->route('auth.sp.sign_in')->with('success', 'Signup successful! Check your email for verification link.');
    //     } catch (\Exception $e) {
    //         \Log::error('Service Partner Signup Error: ' . $e->getMessage(), [
    //             'stack' => $e->getTraceAsString(),
    //             'request' => $request->all()
    //         ]);

    //         return back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
    //     }
    // }

    public function spSignUp(Request $request)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|string|max:255',

                'email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email'),
                ],

                'contact' => [
                    'required',
                    'regex:/^\+?[0-9]{10,15}$/',
                    Rule::unique('users', 'contact'),
                ],

                'promo_code' => 'nullable|string|max:255',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Validate Promo Code
            |--------------------------------------------------------------------------
            */

            if (!empty($validated['promo_code'])) {

                $referral = ReferralTable::where(
                    'rfrls_promo_code',
                    $validated['promo_code']
                )->first();

                if (!$referral) {

                    return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors([
                            'promo_code' => 'Invalid promo code.'
                        ]);
                }

                // Update onboard flag
                $referral->rfrls_onboard_flag = true;
                $referral->save();
            }

            /*
            |--------------------------------------------------------------------------
            | Create User
            |--------------------------------------------------------------------------
            */

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'contact' => $validated['contact'],
                'promo_code' => $validated['promo_code'] ?? null,
                'user_type' => 'SP',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Verification Link
            |--------------------------------------------------------------------------
            */

            $verificationLink = URL::to(
                'authentication/service-partner/verify'
            ) . '?id=' . $user->id;

            /*
            |--------------------------------------------------------------------------
            | Send Mail
            |--------------------------------------------------------------------------
            */

            Mail::to($user->email)->send(
                new ServicePartnerSignUpMail(
                    $verificationLink,
                    $user->name
                )
            );

            Mail::to('info@pseudoteam.com')->send(
                new ServicePartnerSignUpMailCopy(
                    $user->name,
                    $user->email,
                    now()->format('Y-m-d H:i:s')
                )
            );

            \Log::info('Service Partner Signup Successful', [
                'user_id' => $user->id,
                'email' => $user->email,
            ]);

            return redirect()
                ->route('auth.sp.sign_in')
                ->with(
                    'success',
                    'Signup successful! Check your email for verification link.'
                );

        } catch (\Illuminate\Validation\ValidationException $e) {

            throw $e;

        } catch (\Exception $e) {

            \Log::error('Service Partner Signup Error: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'error' => 'An unexpected error occurred. Please try again later.'
                ]);
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
                'pown_promo_code' => str_replace(' ', '', $user->name) . '_' . date('Ymd_His'),

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
                'sprov_promo_code' => str_replace(' ', '', $user->name) . '_' . date('Ymd_His'),
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

                    $overallProgress = $this->calculateOverallProjectProgress($projectOwner->pown_id);

                    \Log::info($overallProgress);

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
                            // 'recentProjects' => Project::orderBy('plist_id', 'desc')->where('plist_customer_id', $projectOwner->pown_id)->take(5)->get(),
                            'recentProjects' => Project::orderBy('plist_id', 'desc')
                                ->where('plist_customer_id', $projectOwner->pown_id)
                                ->where('plist_status', '!=', 'Delivered')  // exclude delivered
                                ->take(5)
                                ->get(),

                            'cartCount' => Cart::where('cart_customer_id', $projectOwner->pown_id)->count(),
                            'addedToCart' => Cart::where('cart_customer_id', $projectOwner->pown_id)->get(),
                            'overallProgress' => $overallProgress,
                        ];

                        session($dashboardData);

                        return redirect()->route('customer.dashboard');
                    } else {
                        session(['user_id' => $projectOwner->pown_id]);
                        session(['pown_name' => $projectOwner->pown_name]);
                        session(['overallProgress' => $overallProgress]);
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

    public function calculateProjectProgress($projectId): float
    {
        \Log::info("calculateProjectProgress() started for Project ID: {$projectId}");

        $project_scope = ProjectScope::where('pscope_project_id', $projectId)->get();

        if ($project_scope->isEmpty()) {
            \Log::warning("Project ID {$projectId} has no scopes/locations.");
            return 0.0;
        }

        $totalProjectLocationProgress = 0.0;

        foreach ($project_scope as $scope) {
            $locationId = $scope->pscope_id;
            $locationWeightage = $scope->pscope_weightage ?? 0; // percent of project
            \Log::info("Location ID {$locationId} → Weightage: {$locationWeightage}%");

            $milestones = ProjectPlanner::where('pplnr_scope_id', $locationId)->get();

            if ($milestones->isEmpty()) {
                \Log::info("Location ID {$locationId} has no milestones.");
                continue;
            }

            $locationMilestoneProgress = 0.0;

            // log total milestone weight (we don't normalize them)
            $totalMilestoneWeightage = $milestones->sum('pplnr_weightage');
            \Log::info("Total raw milestone weight for Location ID {$locationId}: {$totalMilestoneWeightage}");

            foreach ($milestones as $milestone) {
                $milestoneWeight = $milestone->pplnr_weightage ?? 0;
                $normalizedMilestoneWeight = $milestoneWeight; // treated as absolute percent

                // tasks for this milestone
                $tasks = ProjectPlannerTask::where('pptasks_planner_id', $milestone->pplnr_id)->get();

                $totalDefinedWeightage = $tasks->sum('pptasks_weightage');
                if ($totalDefinedWeightage <= 0) {
                    // fallback to equal distribution (sum = 100)
                    $totalDefinedWeightage = 100;
                }

                $milestoneTaskProgress = 0.0;

                foreach ($tasks as $task) {
                    $taskWeight = $task->pptasks_weightage ?? 0;
                    $normalizedTaskWeight = ($taskWeight / $totalDefinedWeightage) * 100;

                    $status = strtolower(trim($task->pptasks_pt_status ?? ''));

                    // rule: 'fullfilled'/'fulfilled' => 100, else 0
                    $taskProgress = ($status === 'fullfilled' || $status === 'fulfilled') ? 100 : 0;

                    $milestoneTaskProgress += ($normalizedTaskWeight * $taskProgress) / 100;
                }

                $milestoneProgress = round($milestoneTaskProgress, 2); // percent of milestone completed

                // weighted contribution of milestone to the location
                $weightedMilestoneProgress = ($milestoneProgress * $normalizedMilestoneWeight) / 100;

                $locationMilestoneProgress += $weightedMilestoneProgress;

                \Log::info("Milestone ID {$milestone->pplnr_id} → Milestone Progress: {$milestoneProgress}%, Milestone Weight: {$milestoneWeight}%, WeightedContribution: " . round($weightedMilestoneProgress, 2) . "%");
            }

            // scope progress (percent)
            $scopeProgress = round($locationMilestoneProgress, 2);

            // weighted contribution of this location to the project
            $scopeWeighted = round(($scopeProgress * $locationWeightage) / 100, 2);

            $totalProjectLocationProgress += $scopeWeighted;

            \Log::info("Location ID {$locationId} → Scope Progress: {$scopeProgress}%, WeightedToProject: {$scopeWeighted}%");
        }

        $final = round($totalProjectLocationProgress, 2);
        \Log::info("calculateProjectProgress() finished for Project ID: {$projectId} → Final: {$final}%");

        return (float) $final;
    }


    private function calculateOverallProjectProgress($customerId)
    {
        $projects = Project::where('plist_customer_id', $customerId)->get();

        // Same status-to-progress map as trackProjects()
        $statusProgressMap = [
            'delivered' => 100,
            'in progress' => 50,
            'no sp assigned' => 0,
            // 'cancelled' is excluded
        ];

        $totalProgress = 0;
        $validProjects = 0;

        foreach ($projects as $project) {
            // Normalize status just like in trackProjects()
            $rawStatus = $project->plist_status;
            $normalizedStatus = strtolower(trim(preg_replace('/\s+/', ' ', $rawStatus)));

            if (!isset($statusProgressMap[$normalizedStatus])) {
                continue; // Skip invalid/cancelled/unknown
            }

            $progress = $statusProgressMap[$normalizedStatus];
            $totalProgress += $progress;
            $validProjects++;
        }

        return $validProjects > 0 ? round($totalProgress / $validProjects) : 0;
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

                } else {

                    return redirect()->route('auth.sp.sign_in')->with('error', 'The provided credentials are incorrect.');

                }

            }

        } else {

            return redirect()->route('auth.sp.sign_in')->with('error', 'The provided credentials are incorrect.');

        }

    }

    // public function customerForgotPassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //     ]);

    //     $email = $request->input('email');

    //     // Check if the email exists in the database
    //     $user = User::where('email', $email)->first();

    //     if ($user) {

    //         $projectOwner = ProjectOwners::where('pown_email', $email)->first();

    //         if (!$projectOwner) {

    //             \Log::warning('Password reset requested for non-existent email: ' . $email);

    //             return redirect()->back()->withErrors(['email' => 'No account found with the provided email.']);
    //         }

    //         // Generate a password reset token
    //         $token = Str::random(60);

    //         // Store the token in the database (you may want to create a separate table for this)
    //         DB::table('password_resets')->insert([
    //             'email' => $email,
    //             'token' => Hash::make($token),
    //             'created_at' => Carbon::now(),
    //         ]);

    //         $resetLink = URL::to('/reset-password') . '?token=' . urlencode($token) . '&email=' . urlencode($email);

    //         \Log::info('Password reset link generated for email: ' . $email . ' Link: ' . $resetLink);

    //         // Send email
    //         Mail::to($email)->send(new CustomerForgotPasswordMail($resetLink, $projectOwner->pown_name));

    //         return redirect()->back()->with('status', 'Password reset link sent to your email.');
    //     } else {

    //     }
    //     return redirect()->back()->withErrors(['email' => 'Invalid email address or no account found!']);
    // }

    public function customerForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        // --------------------------------------------------
        // START
        // --------------------------------------------------

        \Log::info('========================================');
        \Log::info('PROJECT OWNER FORGOT PASSWORD STARTED');
        \Log::info('Email received', [
            'email' => $email,
        ]);

        // --------------------------------------------------
        // CHECK USER
        // --------------------------------------------------

        \Log::info('Checking user in users table', [
            'email' => $email,
        ]);

        $user = User::where('email', $email)->first();

        if (!$user) {

            \Log::warning('User not found', [
                'email' => $email,
            ]);

            \Log::info('========================================');

            return redirect()->back()->withErrors([
                'email' => 'Invalid email address or no account found!'
            ]);
        }

        \Log::info('User found successfully', [
            'email' => $email,
            'user_id' => $user->id ?? null,
        ]);

        // --------------------------------------------------
        // CHECK PROJECT OWNER
        // --------------------------------------------------

        \Log::info('Checking ProjectOwner in database', [
            'email' => $email,
        ]);

        $projectOwner = ProjectOwner::where(
            'pown_email',
            $email
        )->first();

        if (!$projectOwner) {

            \Log::warning('ProjectOwner not found', [
                'email' => $email,
            ]);

            \Log::info('========================================');

            return redirect()->back()->withErrors([
                'email' => 'No account found with the provided email.'
            ]);
        }

        \Log::info('ProjectOwner found successfully', [
            'email' => $email,
            'project_owner_id' => $projectOwner->id ?? null,
            'project_owner_name' => $projectOwner->pown_name ?? null,
        ]);

        try {

            // --------------------------------------------------
            // GENERATE PASSWORD RESET TOKEN
            // --------------------------------------------------

            \Log::info('Generating password reset token', [
                'email' => $email,
            ]);

            $token = Str::random(60);

            \Log::info('Password reset token generated successfully', [
                'email' => $email,
            ]);

            // --------------------------------------------------
            // STORE TOKEN
            // --------------------------------------------------

            \Log::info('Storing password reset token in database', [
                'email' => $email,
            ]);

            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => Hash::make($token),
                'created_at' => Carbon::now(),
            ]);

            \Log::info('Password reset token stored successfully', [
                'email' => $email,
            ]);

            // --------------------------------------------------
            // GENERATE RESET LINK
            // --------------------------------------------------

            $resetLink = URL::to('/reset-password')
                . '?token=' . urlencode($token)
                . '&email=' . urlencode($email);

            \Log::info('Password reset link generated', [
                'email' => $email,
                'reset_link' => $resetLink,
            ]);

            // --------------------------------------------------
            // PREPARE EMAIL
            // --------------------------------------------------

            \Log::info('Preparing password reset email', [
                'to' => $email,
                'name' => $projectOwner->pown_name,
                'subject' => 'TEST - Project Owner Password Reset',
            ]);

            // --------------------------------------------------
            // SEND EMAIL
            // --------------------------------------------------

            \Log::info('Attempting to send password reset email', [
                'to' => $email,
            ]);

            Mail::raw(
                'Password Reset Request' . "\n\n" .

                'Hello ' . $projectOwner->pown_name . ',' . "\n\n" .

                'We received a request to reset the password for your Project Owner account with Pseudoteam.' . "\n\n" .

                'If you made this request, please click the link below to reset your password.' . "\n\n" .

                'If you did not request a password reset, you can safely ignore this email. Your account will remain secure.' . "\n\n" .

                'Your password reset token has also been generated successfully.' . "\n\n" .

                'Reset Link:' . "\n" .
                $resetLink . "\n\n" .

                'For security reasons, this link will expire in 24 hours.' . "\n" .
                'If you need further assistance, please contact our support team.' . "\n\n" .

                'Best Regards,' . "\n" .
                'Pseudoteam',

                function ($message) use ($email) {

                    $message->to($email)
                        ->subject('TEST - Project Owner Password Reset');
                }
            );

            // --------------------------------------------------
            // EMAIL SENT SUCCESSFULLY
            // --------------------------------------------------

            \Log::info('PASSWORD RESET EMAIL SENT SUCCESSFULLY', [
                'to' => $email,
            ]);

            \Log::info('Project Owner forgot password process completed');
            \Log::info('========================================');

            return redirect()->back()->with(
                'status',
                'Test password reset email sent successfully.'
            );

        } catch (\Throwable $e) {

            // --------------------------------------------------
            // EMAIL / PROCESS FAILED
            // --------------------------------------------------

            \Log::error('PASSWORD RESET EMAIL FAILED', [
                'to' => $email,
                'error' => $e->getMessage(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            \Log::info('Project Owner forgot password process failed');
            \Log::info('========================================');

            return redirect()->back()->withErrors([
                'email' => 'Unable to send test email. Please check the mail configuration.'
            ]);
        }
    }


    public function spForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        // --------------------------------------------------
        // CHECK USER
        // --------------------------------------------------

        $user = User::where('email', $email)->first();

        if (!$user) {

            return redirect()->back()->withErrors([
                'email' => 'Invalid email address or no account found!'
            ]);
        }

        // --------------------------------------------------
        // CHECK SERVICE PROVIDER
        // --------------------------------------------------

        $projectOwner = ServiceProvider::where(
            'sprov_email',
            $email
        )->first();

        if (!$projectOwner) {

            return redirect()->back()->withErrors([
                'email' => 'No account found with the provided email.'
            ]);
        }

        try {

            // --------------------------------------------------
            // GENERATE PASSWORD RESET TOKEN
            // --------------------------------------------------

            $token = Str::random(60);

            // --------------------------------------------------
            // STORE TOKEN
            // --------------------------------------------------

            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => Hash::make($token),
                'created_at' => Carbon::now(),
            ]);

            // --------------------------------------------------
            // GENERATE RESET LINK
            // --------------------------------------------------

            $resetLink = URL::to('/sp-reset-password')
                . '?token=' . urlencode($token)
                . '&email=' . urlencode($email);


            // --------------------------------------------------
            // TEST EMAIL
            // --------------------------------------------------

            Mail::raw(
                'Password Reset Request' . "\n\n" .

                'Hello ' . $projectOwner->sprov_name . ',' . "\n\n" .

                'We received a request to reset the password for your Service Partner account with Pseudoteam.' . "\n\n" .

                'If you made this request, please click the button below to reset your password.' . "\n\n" .

                'If you did not request a password reset, you can safely ignore this email. Your account will remain secure.' . "\n\n" .

                'Your password reset token has also been generated successfully.' . "\n\n" .

                'Reset Link:' . "\n" .
                $resetLink . "\n\n" .

                'For security reasons, this link will expire in 24 hours.
                If you need further assistance, please contact our support team.' . "\n\n" .

                'Best Regards,' . "\n" .
                'Pseudoteam',

                function ($message) use ($email) {

                    $message->to($email)
                        ->subject('TEST - Service Partner Password Reset');
                }
            );

            // --------------------------------------------------
            // EMAIL SENT SUCCESSFULLY
            // --------------------------------------------------

            return redirect()->back()->with(
                'status',
                'Test password reset email sent successfully.'
            );

        } catch (\Throwable $e) {

            // --------------------------------------------------
            // EMAIL FAILED
            // --------------------------------------------------

            \Log::error('TEST EMAIL: FAILED', [
                'to' => $email,
                'error' => $e->getMessage(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            \Log::info('========================================');

            return redirect()->back()->withErrors([
                'email' => 'Unable to send test email. Please check the mail configuration.'
            ]);
        }
    }

    public function showPasswordResetForm(Request $request)
    {

        \Log::info('Accessing password reset form with token: ' . $request->query('token') . ' and email: ' . $request->query('email'));

        $token = $request->query('token');
        $email = $request->query('email');

        $reset = DB::table('password_resets')->where('email', $email)->first();

        if (!$reset || !Hash::check($token, $reset->token)) {

            \Log::warning('Invalid or expired password reset token for email: ' . $email);

            return redirect()->route('login')->withErrors(['token' => 'Invalid or expired token.']);
        }

        if (Carbon::parse($reset->created_at)->addMinutes(60)->isPast()) {

            \Log::warning('Expired password reset token for email: ' . $email);

            return redirect()->route('login')->withErrors(['token' => 'Token has expired.']);
        }

        \Log::info('Valid password reset token for email: ' . $email . '. Displaying reset form.');

        return view('customer/reset_password_form', compact('token', 'email'));
    }

    public function spShowPasswordResetForm(Request $request)
    {

        \Log::info('Accessing password reset form with token: ' . $request->query('token') . ' and email: ' . $request->query('email'));

        $token = $request->query('token');
        $email = $request->query('email');

        $reset = DB::table('password_resets')->where('email', $email)->first();

        if (!$reset || !Hash::check($token, $reset->token)) {

            \Log::warning('Invalid or expired password reset token for email: ' . $email);

            return redirect()->route('login')->withErrors(['token' => 'Invalid or expired token.']);
        }

        if (Carbon::parse($reset->created_at)->addMinutes(60)->isPast()) {

            \Log::warning('Expired password reset token for email: ' . $email);

            return redirect()->route('login')->withErrors(['token' => 'Token has expired.']);
        }

        \Log::info('Valid password reset token for email: ' . $email . '. Displaying reset form.');

        return view('service-partner/reset_password_form', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {

        \Log::info('111111 Attempting to reset password for email: ' . $request->input('email'));

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $passwordConfirmation = $request->input('password_confirmation');

        \Log::info('Password reset request details - Email: ' . $email . ', Password: ' . $password . ', Confirmation: ' . $passwordConfirmation);

        $user = ProjectOwners::where('pown_email', $email)->first();

        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'No account found with the provided email.']);
        }

        $user->pown_password = Hash::make($password);
        $user->save();

        DB::table('password_resets')->where('email', $email)->delete();

        \Log::info('Password reset successful for email: ' . $email);

        return redirect()->route('auth.customer.sign_in')->with('status', 'Password reset successful. Please log in.');
    }

    public function spResetPassword(Request $request)
    {

        \Log::info('Attempting to reset password for email: ' . $request->input('email'));

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $passwordConfirmation = $request->input('password_confirmation');

        \Log::info('Password reset request details - Email: ' . $email . ', Password: ' . $password . ', Confirmation: ' . $passwordConfirmation);

        $user = ServiceProvider::where('sprov_email', $email)->first();

        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'No account found with the provided email.']);
        }

        $user->sprov_password = Hash::make($password);
        $user->save();

        DB::table('password_resets')->where('email', $email)->delete();

        \Log::info('Password reset successful for email: ' . $email);

        return redirect()->route('auth.sp.sign_in')->with('status', 'Password reset successful. Please log in.');
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

    public function spDashboard($viewName = 'service-partner/dashboard', $data = [])
    {
        //changes made by sanskar
        // if ($viewName === 'customer/track_project_report') {
        //     $projects = Project::all();
        //     $data['projects'] = $projects;
        // }

        // if ($viewName === 'customer/ticket') {

        //     if (isset($data['ticket'])) {
        //         $data['readonly'] = true;
        //     } else {
        //         $data['readonly'] = false;
        //     }

        // }

        // if ($viewName === 'customer/project_upload_form') {
        //     if (isset($data['project_upload_form'])) {
        //         $data['readonly'] = true;
        //         $data['project'] = $data['project'] ?? null;
        //     } else {
        //         $data['readonly'] = false;
        //         $data['project'] = $data['project'] ?? null;
        //     }
        // }

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
            ->redirectToRoute('home')
            ->with('success_logout', 'You have been logged out.');

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


    public function appLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)
            ->where('user_type', 'customer')
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Credentials'
            ], 401);
        }

        $projectOwner = ProjectOwners::where('pown_email', $request->email)->first();

        if (
            !$projectOwner ||
            !Hash::check($request->password, $projectOwner->pown_password)
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Credentials'
            ], 401);
        }

        Auth::login($user);

        $user->tokens()->delete();

        // $token = $user->createToken('auth-token')->plainTextToken;

        $token = $user->createToken('auth-token', [
            'customer_id' => $projectOwner->pown_id
        ])->plainTextToken;

        $customerId = $projectOwner->pown_id;

        $NOT_STARTED = ['No SP Assigned', 'Not Started'];

        $notificationCount = Notification::where('ntfn_forUserId', $customerId)
            ->where('ntfn_readflag', 0)
            ->whereNot('ntfn_type', 'pt')
            ->count();

        $baseProjects = Project::where('plist_customer_id', $customerId);

        $notStartedCount = (clone $baseProjects)
            ->whereIn('plist_status', $NOT_STARTED)
            ->count();

        $inProgressCount = (clone $baseProjects)
            ->where('plist_status', 'In Progress')
            ->count();

        $deliveredCount = (clone $baseProjects)
            ->where('plist_status', 'Delivered')
            ->count();

        $overdueCount = (clone $baseProjects)
            ->where('plist_status', '!=', 'Delivered')
            ->whereRaw(
                "STR_TO_DATE(plist_enddate, '%d-%m-%Y') < CURDATE()"
            )
            ->count();


        $recentProjects = (clone $baseProjects)
            ->orderByDesc('plist_id')
            ->limit(5)
            ->get()
            ->map(function ($project) {

                return [
                    'id' => $project->plist_id,
                    'title' => $project->plist_name,
                    'status' => $project->plist_status,
                    'progress' => $this->calculateProjectProgress($project->plist_id),
                ];
            });

        $statusBlocks = [

            'not_started' => $this->getProjectBlock(
                $customerId,
                $NOT_STARTED
            ),

            'in_progress' => $this->getProjectBlock(
                $customerId,
                'In Progress'
            ),

            'overdue' => $this->getProjectBlock(
                $customerId,
                null,
                true
            ),

            'delivered' => $this->getProjectBlock(
                $customerId,
                'Delivered'
            ),
        ];

        $progressOverview = [
        'not_started' => $notStartedCount,
        'in_progress' => $inProgressCount,
        'at_risk' => $overdueCount,
        'completed' => $deliveredCount,
    ];
        return response()->json([

            'success' => true,

            'token' => $token,

            'user' => [
                'id' => $projectOwner->pown_id,
                'name' => $projectOwner->pown_name,
                'email' => $projectOwner->pown_email,
            ],

            'dashboard' => [

                'notification_count' => $notificationCount,

                'critical_project_count' => $overdueCount,

                'summary' => [
                    'not_started' => $notStartedCount,
                    'in_progress' => $inProgressCount,
                    'overdue' => $overdueCount,
                    'delivered' => $deliveredCount,
                ],

                'top_recent_projects' => $recentProjects,

                'status_blocks' => $statusBlocks,
                'progress_overview' => $progressOverview,
            ]

        ], 200);
    }

    private function getProjectBlock($customerId, $statuses = null, $overdue = false)
    {
        $query = Project::where('plist_customer_id', $customerId);

        if ($overdue) {

            $query->where('plist_status', '!=', 'Delivered')
                ->whereRaw(
                    "STR_TO_DATE(plist_enddate, '%d-%m-%Y') < CURDATE()"
                );
        } elseif (is_array($statuses)) {

            $query->whereIn('plist_status', $statuses);
        } elseif ($statuses) {

            $query->where('plist_status', $statuses);
        }


        $count = $query->count();

        $latest = $query->orderByDesc('plist_id')->first();


        return [

            'count' => $count,

            'project' => $latest ? [

                'id' => $latest->plist_id,
                'title' => $latest->plist_title,
                'status' => $latest->plist_status,
                'progress' => $this->calculateProjectProgress($latest->plist_id),

            ] : null
        ];
    }

    // public function appChangePassword(Request $request)
    // {
    //     $user = auth()->user();

    //     if (!$user) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Unauthorized'
    //         ], 401);
    //     }

    //     \Log::info('Request' , [$request]);

    //     $data = $request->validate([
    //         'current_password' => 'required',
    //         'new_password' => 'required|min:6|different:old_password',
    //         'new_password_confirmation' => 'required|same:new_password',
    //     ]);

    //     // $ownerQuery = DB::table('project_owners')->where('pown_id', $user->id);

    //     $ownerQuery = ProjectOwners::where('pown_id', $user->Pown_id)->first();

    //     $currentPassword = $ownerQuery->value('pown_password');

    //     if (!Hash::check($data['current_password'], $currentPassword)) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Old password is incorrect'
    //         ], 400);
    //     }

    //     $ownerQuery->update([
    //         'pown_password' => Hash::make($data['new_password']),
    //         'updated_at' => now()
    //     ]);

    //     \Log::info('working till here!');

    //     $user->tokens()->delete();

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Password changed successfully'
    //     ]);
    // }

    public function appChangePassword(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        \Log::info('Request', [$request->all()]);

        $data = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|different:current_password',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $owner = ProjectOwners::where('pown_email', $user->email)->first();

        if (!$owner) {
            return response()->json([
                'status' => false,
                'message' => 'Owner record not found'
            ], 404);
        }

        if (!Hash::check($data['current_password'], $owner->pown_password)) {
            return response()->json([
                'status' => false,
                'message' => 'Old password is incorrect'
            ], 400);
        }

        $owner->update([
            'pown_password' => Hash::make($data['new_password']),
            'updated_at' => now()
        ]);

        \Log::info('Password updated successfully');

        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Password changed successfully'
        ]);
    }

    // private function calculateProjectProgress($projectId): float
    // {
    //     \Log::info("Progress calc started → Project: {$projectId}");

    //     $projectScopes = ProjectScope::where('pscope_project_id', $projectId)->get();

    //     if ($projectScopes->isEmpty()) {

    //         \Log::warning("No scopes → Project: {$projectId}");

    //         return 0.0;
    //     }


    //     $totalProjectProgress = 0.0;


    //     foreach ($projectScopes as $scope) {

    //         $locationId = $scope->pscope_id;

    //         $locationWeight = $scope->pscope_weightage ?? 0;


    //         $milestones = ProjectPlanner::where('pplnr_scope_id', $locationId)->get();

    //         if ($milestones->isEmpty()) {
    //             continue;
    //         }


    //         $locationProgress = 0.0;


    //         foreach ($milestones as $milestone) {

    //             $milestoneWeight = $milestone->pplnr_weightage ?? 0;


    //             $tasks = ProjectPlannerTask::where(
    //                 'pptasks_planner_id',
    //                 $milestone->pplnr_id
    //             )->get();


    //             $totalTaskWeight = $tasks->sum('pptasks_weightage');

    //             if ($totalTaskWeight <= 0) {
    //                 $totalTaskWeight = 100;
    //             }


    //             $milestoneProgress = 0.0;


    //             foreach ($tasks as $task) {

    //                 $taskWeight = $task->pptasks_weightage ?? 0;

    //                 $normalizedTaskWeight =
    //                     ($taskWeight / $totalTaskWeight) * 100;


    //                 $status = strtolower(trim($task->pptasks_pt_status ?? ''));


    //                 $taskProgress =
    //                     ($status === 'fulfilled' || $status === 'fullfilled')
    //                     ? 100
    //                     : 0;


    //                 $milestoneProgress +=
    //                     ($normalizedTaskWeight * $taskProgress) / 100;
    //             }


    //             $milestoneProgress = round($milestoneProgress, 2);


    //             $weightedMilestone =
    //                 ($milestoneProgress * $milestoneWeight) / 100;


    //             $locationProgress += $weightedMilestone;
    //         }


    //         $locationProgress = round($locationProgress, 2);


    //         $locationWeighted =
    //             ($locationProgress * $locationWeight) / 100;


    //         $totalProjectProgress += $locationWeighted;
    //     }


    //     $final = round($totalProjectProgress, 2);

    //     \Log::info("Progress finished → {$projectId} = {$final}%");

    //     return (float) $final;
    // }

    public function appOwnerProfile()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }

        $cust = ProjectOwners::where('pown_email', $user->email)->first();

        if (!$cust) {
            return response()->json([
                'status' => false,
                'message' => 'Customer Not Found!'
            ], 401);
        }


        // $owner = DB::table('project_owners')
        //     ->where('pown_id', $user->id)
        //     ->select('pown_name', 'pown_organisation_name')
        //     ->first();

        \Log::info('user id', [$user->id]);
        \Log::info('custId id', [$cust->pown_id]);

        $owner = ProjectOwners::where('pown_id', $cust->pown_id)->first();

        if (!$owner) {
            return response()->json([
                'status' => false,
                'message' => 'Owner not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $owner
        ]);
    }

    public function appDashboard(Request $request)
    {
        $user = auth()->user();

        $projectOwner = ProjectOwners::where('pown_email', $user->email)->first();

        if (!$projectOwner) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found'
            ], 404);
        }

        $customerId = $projectOwner->pown_id;

        $NOT_STARTED = ['No SP Assigned', 'Not Started'];

        $notificationCount = Notification::where('ntfn_forUserId', $customerId)
            ->where('ntfn_readflag', 0)
            ->whereNot('ntfn_type', 'pt')
            ->count();

        $baseProjects = Project::where('plist_customer_id', $customerId);

        $notStartedCount = (clone $baseProjects)
            ->whereIn('plist_status', $NOT_STARTED)
            ->count();

        $inProgressCount = (clone $baseProjects)
            ->where('plist_status', 'In Progress')
            ->count();

        $deliveredCount = (clone $baseProjects)
            ->where('plist_status', 'Delivered')
            ->count();

        $overdueCount = (clone $baseProjects)
            ->where('plist_status', '!=', 'Delivered')
            ->whereRaw("STR_TO_DATE(plist_enddate, '%d-%m-%Y') < CURDATE()")
            ->count();

        $recentProjects = (clone $baseProjects)
            ->orderByDesc('plist_id')
            ->limit(5)
            ->get()
            ->map(function ($project) {
                return [
                    'id' => $project->plist_projectid,
                    'title' => $project->plist_title,
                    'status' => $project->plist_status,
                    'progress' => $this->calculateProjectProgress($project->plist_id),
                ];
            });

        $statusBlocks = [

            'not_started' => $this->getProjectBlock(
                $customerId,
                $NOT_STARTED
            ),

            'in_progress' => $this->getProjectBlock(
                $customerId,
                'In Progress'
            ),

            'overdue' => $this->getProjectBlock(
                $customerId,
                null,
                true
            ),

            'delivered' => $this->getProjectBlock(
                $customerId,
                'Delivered'
            ),
        ];

        $progressOverview = [
    'not_started' => $notStartedCount,
    'in_progress' => $inProgressCount,
    'at_risk' => $overdueCount,
    'completed' => $deliveredCount,
];

        return response()->json([
            'success' => true,

            'user' => [
                'id' => $projectOwner->pown_id,
                'name' => $projectOwner->pown_name,
                'email' => $projectOwner->pown_email,
            ],

            'dashboard' => [

                'notification_count' => $notificationCount,

                'critical_project_count' => $overdueCount,

                'summary' => [
                    'not_started' => $notStartedCount,
                    'in_progress' => $inProgressCount,
                    'overdue' => $overdueCount,
                    'delivered' => $deliveredCount,
                ],

                'top_recent_projects' => $recentProjects,

                'status_blocks' => $statusBlocks,
                'progress_overview' => $progressOverview,
            ]
        ], 200);
    }


















    //Auto Service Partner Onboarding API

    public function onboard(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | 1. API Authentication
        |--------------------------------------------------------------------------
        */

        // $apiKey = $request->header('X-Partner-API-Key');

        // if (!$apiKey || !hash_equals(
        //     config('services.partner_registration.api_key'),
        //     $apiKey
        // )) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Unauthorized API request.'
        //     ], 401);
        // }


        /*
        |--------------------------------------------------------------------------
        | 2. Validate Request
        |--------------------------------------------------------------------------
        */

        $validator = Validator::make($request->all(), [
            'source' => 'required|string|max:50',
            'source_id' => 'required|integer',

            'org_type' => 'nullable|string|max:100',
            'org_name' => 'required|string|max:400',

            'reg_office' => 'nullable|string|max:255',
            'branch_office' => 'nullable|string|max:255',

            'phone' => 'required|string|max:255',
            'fax' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',

            'premises' => 'nullable|string|max:100',
            'premises_years' => 'nullable|integer',
            'area_sqft' => 'nullable|integer',

            'gst' => 'nullable|string|max:255',
            'pan' => 'nullable|string|max:255',
            'service_tax' => 'nullable|string|max:255',

            'owner1' => 'nullable|string|max:255',
            'owner2' => 'nullable|string|max:255',
            'owner_phone' => 'nullable|string|max:255',

            'years_it' => 'nullable|integer',
            'years_non_it' => 'nullable|integer',

            'personnel' => 'nullable|string',

            'internal_location' => 'nullable|string|max:255',
            'internal_code' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();


        /*
        |--------------------------------------------------------------------------
        | 3. Check Existing User
        |--------------------------------------------------------------------------
        */

        $existingUser = User::where('email', $data['email'])
            ->first();

        if ($existingUser) {
            return response()->json([
                'success' => false,
                'code' => 'USER_EXISTS',
                'message' => 'A user with this email already exists.',
                'user_id' => $existingUser->id
            ], 409);
        }


        /*
        |--------------------------------------------------------------------------
        | 4. Create User + Service Provider
        |--------------------------------------------------------------------------
        */

        try {

            $result = DB::transaction(function () use ($data) {

                /*
                |--------------------------------------------------------------------------
                | Create User
                |--------------------------------------------------------------------------
                */

                $user = User::create([
                    'name' => $data['owner1'] ?? $data['org_name'],
                    'email' => $data['email'],
                    'password' => Hash::make(
                        $this->generatePassword()
                    ),
                    'user_type' => 'SP',
                ]);


                /*
                |--------------------------------------------------------------------------
                | Verify User Insert
                |--------------------------------------------------------------------------
                */

                if (!$user || !$user->exists || !$user->id) {
                    throw new \Exception(
                        'User creation failed.'
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | Create Service Provider
                |--------------------------------------------------------------------------
                */

                $serviceProvider = ServiceProvider::create([

                    'sprov_name' =>
                        $data['owner1'] ?? $data['org_name'],

                    'sprov_email' =>
                        $data['email'],

                    'sprov_contact' =>
                        $data['phone'],

                    'sprov_organisation_name' =>
                        $data['org_name'],

                    /*
                     * Your DB enum is:
                     *
                     * Organization
                     * Individual
                     *
                     * Partner Registration has values such as:
                     *
                     * Proprietor
                     * Partnership
                     * Private Ltd
                     * Public Ltd
                     *
                     */

                    'sprov_body' =>
                        $this->mapBodyType(
                            $data['org_type'] ?? null
                        ),

                    'sprov_address' =>
                        $data['reg_office'] ?? null,

                    'sprov_gstpin' =>
                        $data['gst'] ?? null,

                    /*
                     * Don't map PAN to sprov_adhaar.
                     *
                     * Add a dedicated PAN column later.
                     */

                    'sprov_total_experience' =>
                        $data['years_it'] ?? null,

                    'sprov_refered_by' =>
                        $data['internal_code'] ?? null,

                    'sprov_login_flag' => 1,

                    'sprov_profile_completion_flag' => 0,

                    'sprov_verified_flag' => 0,

                    'sprov_verified' => 1,

                    'created_at' => now()->format('Y-m-d H:i:s'),

                    'updated_at' => now()->format('Y-m-d H:i:s'),
                ]);


                /*
                |--------------------------------------------------------------------------
                | Verify Service Provider Insert
                |--------------------------------------------------------------------------
                */

                if (
                    !$serviceProvider ||
                    !$serviceProvider->exists ||
                    !$serviceProvider->sprov_id
                ) {
                    throw new \Exception(
                        'Service provider creation failed.'
                    );
                }


                return [
                    'user_id' => $user->id,
                    'service_provider_id' =>
                        $serviceProvider->sprov_id,
                ];
            });


            /*
            |--------------------------------------------------------------------------
            | Success
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'success' => true,
                'message' =>
                    'Partner onboarded successfully.',

                'user_id' =>
                    $result['user_id'],

                'service_provider_id' =>
                    $result['service_provider_id'],
            ], 201);


        } catch (Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | Transaction automatically rolls back
            |--------------------------------------------------------------------------
            */

            report($e);

            return response()->json([
                'success' => false,
                'message' =>
                    'Partner onboarding failed.',

                'error' =>
                    config('app.debug')
                    ? $e->getMessage()
                    : 'Unable to onboard partner.'
            ], 500);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Organization / Individual Mapping
    |--------------------------------------------------------------------------
    */

    private function mapBodyType(?string $orgType): string
    {
        if (!$orgType) {
            return 'Organization';
        }

        return strtolower(trim($orgType)) === 'proprietor'
            ? 'Individual'
            : 'Organization';
    }


    /*
    |--------------------------------------------------------------------------
    | Temporary Password Generator
    |--------------------------------------------------------------------------
    */

    private function generatePassword(): string
    {
        return bin2hex(random_bytes(5));
    }
}