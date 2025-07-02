<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function uploadProfilePicture(Request $request)
    {
        $pown_id = session('user_id');

        if (!$pown_id) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        if ($request->hasFile('profilePicture')) {
            $file = $request->file('profilePicture');

            // Optional validation
            $request->validate([
                'profilePicture' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);

            // Save binary image
            $imageData = file_get_contents($file);

            // \Log::info('Profile picture uploaded for user ID: ' . $pown_id);
            // \Log::info('Image data size: ' . strlen($imageData) . ' bytes');

            DB::table('project_owners')  // table name should be lowercase and plural if you followed Laravel convention
                ->where('pown_id', $pown_id)
                ->update(['pown_dp' => $imageData]);

            return response()->json(['success' => 'Profile picture updated successfully']);
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
    }

    public function spUploadProfilePicture(Request $request)
    {

        // \Log::info('Profile picture upload request received for service provider.');

        $sprov_id = session('sp_user_id');

        if (!$sprov_id) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        if ($request->hasFile('profilePicture')) {
            $file = $request->file('profilePicture');

            // Optional validation
            $request->validate([
                'profilePicture' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);

            \Log::info('Profile picture upload.');

            // Save binary image
            $imageData = file_get_contents($file);

            \Log::info('Profile picture uploaded for user ID: ' . $sprov_id);
            \Log::info('Image data size: ' . strlen($imageData) . ' bytes');

            DB::table('service_providers')  // table name should be lowercase and plural if you followed Laravel convention
                ->where('sprov_id', $sprov_id)
                ->update(['sprov_dp' => $imageData]);


            \Log::info('Profile picture updated successfully for service provider ID: ' . $sprov_id);

            return response()->json(['success' => 'Profile picture updated successfully']);
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
    }

    public function getProfilePicture()
    {
        $pown_id = session('user_id'); // or session('user_id'), depending what you store

        if (!$pown_id) {
            abort(404); // or return a default image
        }

        $user = DB::table('project_owners')->where('pown_id', $pown_id)->first();

        if (!$user || !$user->pown_dp) {
            // If no DP found, you can return a default image
            $path = public_path('images/logo_icon.png'); // default image
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return response()->redirectTo($base64);
        }

        $response = Response::make($user->pown_dp);
        $response->header('Content-Type', 'image/jpeg'); // assuming your blob is jpeg

        return $response;
    }

    public function spGetProfilePicture()
    {
        $sprov_id = session('sp_user_id'); // or session('user_id'), depending what you store

        if (!$sprov_id) {
            abort(404); // or return a default image
        }

        $user = DB::table('service_providers')->where('sprov_id', $sprov_id)->first();

        if (!$user || !$user->sprov_dp) {
            // If no DP found, you can return a default image
            $path = public_path('images/logo_icon.png'); // default image
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return response()->redirectTo($base64);
        }

        $response = Response::make($user->sprov_dp);
        $response->header('Content-Type', 'image/jpeg'); // assuming your blob is jpeg

        return $response;
    }

    public function getLocation()
    {
        $pown_id = session('user_id');

        if (!$pown_id) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $user = DB::table('project_owners')->where('pown_id', $pown_id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'country' => $user->pown_country ?? 'India',
            'city' => $user->pown_state ?? '',
            'pincode' => $user->pown_pincode ?? '',
            'address' => $user->pown_address ?? '',
        ]);
    }

    public function spGetLocation()
    {
        $sprov_id = session('sp_user_id');

        if (!$sprov_id) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $user = DB::table('service_providers')->where('sprov_id', $sprov_id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'country' => $user->sprov_country ?? 'India',
            'city' => $user->sprov_state ?? '',
            'pincode' => $user->sprov_pincode ?? '',
            'address' => $user->sprov_address ?? '',
        ]);
    }

    public function updateLocation(Request $request)
    {
        $pown_id = session('user_id');

        if (!$pown_id) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $validated = $request->validate([
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'address' => 'required|string|max:255',
        ]);

        DB::table('project_owners')
            ->where('pown_id', $pown_id)
            ->update([
                'pown_country' => $validated['country'],
                'pown_state' => $validated['city'],
                'pown_pincode' => $validated['pincode'],
                'pown_address' => $validated['address'],
            ]);

        return response()->json(['success' => 'Location updated successfully']);
    }


    public function spUpdateLocation(Request $request)
    {
        $sprov_id = session('sp_user_id');

        if (!$sprov_id) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $validated = $request->validate([
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'address' => 'required|string|max:255',
        ]);

        DB::table('service_providers')
            ->where('sprov_id', $sprov_id)
            ->update([
                'sprov_country' => $validated['country'],
                'sprov_state' => $validated['city'],
                'sprov_pincode' => $validated['pincode'],
                'sprov_address' => $validated['address'],
            ]);

        return response()->json(['success' => 'Location updated successfully']);
    }


    public function updateCinId(Request $request)
    {
        $pown_id = session('user_id');

        if (!$pown_id) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $validated = $request->validate([
            'about' => 'required|string|max:5000',
            'orgName' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:100',
            'gst' => 'nullable|string|max:100',
            'govtID' => 'nullable|image|max:2048',
        ]);

        $dataToUpdate = [
            'pown_about' => $validated['about'],
            'pown_organisation_name' => $validated['orgName'] ?? null,
            'pown_cin' => $validated['cin'] ?? null,
            'pown_gstpin' => $validated['gst'] ?? null,
        ];

        if ($request->hasFile('govtID')) {
            $fileData = file_get_contents($request->file('govtID'));
            $dataToUpdate['pown_adhaarfile'] = $fileData; // storing blob directly
        }

        DB::table('project_owners')
            ->where('pown_id', $pown_id)
            ->update($dataToUpdate);

        return response()->json(['success' => 'Details updated successfully!']);
    }


    public function spUpdateCinId(Request $request)
    {

     \Log::info('Update CIN ID request received for service provider.' , [$request->all()]);

        $sprov_id = session('sp_user_id');

        if (!$sprov_id) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $validated = $request->validate([
            'about' => 'required|string|max:5000',
            'orgName' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:100',
            'gst' => 'nullable|string|max:100',
            'govtID' => 'nullable|image|max:2048',
            'skill1' => 'nullable|string|max:100',
            'skill2' => 'nullable|string|max:100',
            'skill3' => 'nullable|string|max:100',
        ]);

        $dataToUpdate = [
            'sprov_about' => $validated['about'],
            'sprov_organisation_name' => $validated['orgName'] ?? null,
            'sprov_cin' => $validated['cin'] ?? null,
            'sprov_gstpin' => $validated['gst'] ?? null,
            'sprov_skill1' => $validated['skill1'] ?? null,
            'sprov_skill2' => $validated['skill2'] ?? null,
            'sprov_skill3' => $validated['skill3'] ?? null,
        ];

        if ($request->hasFile('govtID')) {
            $fileData = file_get_contents($request->file('govtID'));
            $dataToUpdate['pown_adhaarfile'] = $fileData; // storing blob directly
        }

        DB::table('service_providers')
            ->where('sprov_id', $sprov_id)
            ->update($dataToUpdate);

        return response()->json(['success' => 'Details updated successfully!']);
    }

    public function getCinGovId()
    {
        $pown_id = session('user_id');

        if (!$pown_id) {
            return response()->json([
                'about' => '',
                'type' => 'Organization',  // Default
                'orgName' => '',
                'cin' => '',
                'gst' => '',
                'govtIdUrl' => '',          // Important to add this
            ]);
        }

        // Fetch from project_owners table
        $userData = DB::table('project_owners')->where('pown_id', $pown_id)->first();

        if (!$userData) {
            return response()->json([
                'about' => '',
                'type' => 'Organization',
                'orgName' => '',
                'cin' => '',
                'gst' => '',
                'govtIdUrl' => '',
            ]);
        }

        $response = [
            'about' => $userData->pown_about ?? '',
            'type' => $userData->pown_type ?? 'Organization', // Now dynamic
            'orgName' => $userData->pown_organisation_name ?? '',
            'cin' => $userData->pown_cin ?? '',
            'gst' => $userData->pown_gstpin ?? '',
            'sprov_skill1' => $userData->sprov_skill1 ?? '',
            'sprov_skill2' => $userData->sprov_skill2 ?? '',
            'sprov_skill3' => $userData->sprov_skill3 ?? '',
            'govtIdUrl' => '',
        ];

        // If user is Individual, check if govt id exists
        if (($userData->pown_type ?? 'Organization') === 'Individual' && !empty($userData->pown_govt_id)) {
            // Generate URL to access government ID
            $response['govtIdUrl'] = route('profileController.get.govtid');
        }

        return response()->json($response);
    }

    public function spGetCinGovId()
    {
        $sprov_id = session('sp_user_id');

        if (!$sprov_id) {
            return response()->json([
                'about' => '',
                'type' => 'Organization',  // Default
                'orgName' => '',
                'cin' => '',
                'gst' => '',
                'govtIdUrl' => '',          // Important to add this
            ]);
        }

        // Fetch from service_providers table
        $userData = DB::table('service_providers')->where('sprov_id', $sprov_id)->first();

        if (!$userData) {
            return response()->json([
                'about' => '',
                'type' => 'Organization',
                'orgName' => '',
                'cin' => '',
                'gst' => '',
                'govtIdUrl' => '',
            ]);
        }

        $response = [
            'about' => $userData->sprov_about ?? '',
            'type' => $userData->sprov_type ?? 'Organization', // Now dynamic
            'orgName' => $userData->sprov_organisation_name ?? '',
            'cin' => $userData->sprov_cin ?? '',
            'gst' => $userData->sprov_gstpin ?? '',
            'govtIdUrl' => '',
        ];

        // If user is Individual, check if govt id exists
        if (($userData->sprov_type ?? 'Organization') === 'Individual' && !empty($userData->sprov_govt_id)) {
            // Generate URL to access government ID
            $response['govtIdUrl'] = route('profileController.get.govtid');
        }

        return response()->json($response);
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $pown_id = session('user_id');

        if (!$pown_id) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        // Fetch user manually from project_owners table
        $user = DB::table('project_owners')->where('pown_id', $pown_id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        // Check current password
        if (!Hash::check($request->input('current_password'), $user->pown_password)) {
            return response()->json(['error' => 'Current password is incorrect.'], 400);
        }

        // Update new password
        DB::table('project_owners')
            ->where('pown_id', $pown_id)
            ->update([
                'pown_password' => Hash::make($request->input('new_password'))
            ]);

        // return response()->json(['success' => 'Password changed successfully.']);

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully.',
            'redirect_url' => route('auth.customer.sign_in')
        ]);
    }

    public function spChangePassword(Request $request)
    {

        \Log::info('Change password request received for service provider.');

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $sprov_id = session('sp_user_id');

        if (!$sprov_id) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        \Log::info('Service provider ID: ' . $sprov_id);

        // Fetch user manually from project_owners table
        $user = DB::table('service_providers')->where('sprov_id', $sprov_id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        // Check current password
        if (!Hash::check($request->input('current_password'), $user->sprov_password)) {
            return response()->json(['error' => 'Current password is incorrect.'], 400);
        }

        \Log::info('Current password verified for service provider ID: ' . $sprov_id);

        // Update new password
        DB::table('service_providers')
            ->where('sprov_id', $sprov_id)
            ->update([
                'sprov_password' => Hash::make($request->input('new_password'))
            ]);


        \Log::info('Password changed successfully for service provider ID: ' . $sprov_id);

        // return response()->json(['success' => 'Password changed successfully.']);

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully.',
            'redirect_url' => route('auth.sp.sign_in')
        ]);
    }

    public function profileOptions()
    {
        $pown_id = session('user_id');

        if (!$pown_id) {
            return redirect()->route('login');
        }

        $user = DB::table('project_owners')->where('pown_id', $pown_id)->first();

        if (!$user) {
            return redirect()->route('login');
        }

        \Log::info('Profile options accessed for user ID: ', [$user]);

        return view('customer.profileoptions', ['user' => $user]);
    }

    public function spProfileOptions()
    {
        $sp_user_id = session('sp_user_id');

        if (!$sp_user_id) {
            return redirect()->route('login');
        }

        $user = DB::table('service_providers')->where('sprov_id', $sp_user_id)->first();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('service-partner.profileoptions', ['user' => $user]);
    }
}
