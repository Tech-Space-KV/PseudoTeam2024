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
                'profilePicture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Save binary image
            $imageData = file_get_contents($file);

            DB::table('project_owners')  // table name should be lowercase and plural if you followed Laravel convention
                ->where('pown_id', $pown_id)
                ->update(['pown_dp' => $imageData]);

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
            'govtIdUrl' => '',
        ];

        // If user is Individual, check if govt id exists
        if (($userData->pown_type ?? 'Organization') === 'Individual' && !empty($userData->pown_govt_id)) {
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

        return response()->json(['success' => 'Password changed successfully.']);
    }
}
