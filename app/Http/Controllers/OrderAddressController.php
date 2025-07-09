<?php

namespace App\Http\Controllers;

use App\Models\OrderAddress;
use Illuminate\Http\Request;

class OrderAddressController extends Controller
{
    public function saveAddress(Request $request)
    {

        $validated = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zipcode' => 'required|string|max:20',
        ]);

        $fullAddress = $validated['street'] . ', ' . $validated['city'] . ', ' . $validated['state'] . ', ' . $validated['zipcode'];

        $address = OrderAddress::create([
            'ordradrs_address' => $fullAddress,
            'ordradrs_projectowner_id' => session('user_id')
        ]);

        if ($address) {
            return response()->json([
                'success' => true,
                'message' => 'Address saved successfully!',
            ]);
        } else {
            \Log::error('Failed to create address via mass assignment.');
            return response()->json([
                'success' => false,
                'message' => 'Failed to save address.',
            ]);
        }

    }

    public function saveExistingAddress(Request $request)
    {
        try {

            $request->validate([
                'address_id' => 'required|exists:order_addresses,ordradrs_id',
            ]);

            $original = OrderAddress::where('ordradrs_id' , $request->address_id)->first();

            $newAddress = OrderAddress::create([
                'ordradrs_address' => $original->ordradrs_address,
                'ordradrs_projectowner_id' => session('user_id'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Address selected and saved successfully!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }


}
