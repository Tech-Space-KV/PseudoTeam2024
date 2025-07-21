<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Hardware;
use App\Models\OrderAddress;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {

        $validated = $request->validate([
            "cart_hw_id" => "required",
            "cart_qty" => "required|integer|min:1",
        ]);

        $cartHwId = $validated['cart_hw_id'];
        $cartQty = $validated['cart_qty'];

        $hardware = Hardware::where('hrdws_id', $cartHwId)->first();

        if ($hardware) {
            $hardware->hrdws_qty -= $cartQty;
            $hardware->save();
        }

        $customerId = session('user_id');

        if (!$customerId) {

            return redirect()->back()->with('error', 'Customer id not found!');
        }


        $cart = session()->get('cart', []);

        try {

            $addedItem = Cart::where('cart_hw_id', $cartHwId)->first();

            if ($addedItem) {
                $addedItem->cart_qty += $cartQty;
                $addedItem->save();

                return redirect()->back()->with('success', 'Item added to cart!');
            }

            Cart::create([
                'cart_hw_id' => $cartHwId,
                'cart_qty' => $cartQty,
                'cart_customer_id' => $customerId,
            ]);

            session()->put('cartCount', session('cartCount', 0) + 1);

            return redirect()->back()->with('success', 'Item added to cart!');

        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }

    }

    public function viewCart()
    {

        $customerId = session('user_id');

        $cartItems = Cart::where('cart_customer_id', $customerId)->get();

        $hardwareDetails = [];

        $userAddresses = [];

        if ($cartItems->isNotEmpty()) {

            // $hardwareDetails = [];

            foreach ($cartItems as $cartItem) {
                $hardware = Hardware::where('hrdws_id', $cartItem->cart_hw_id)->first();
                if ($hardware) {

                    $hardwareDetails[] = [
                        'hardware' => $hardware,
                        'quantity' => $cartItem->cart_qty
                    ];

                }
            }

            $userAddresses = OrderAddress::where('ordradrs_projectowner_id', $customerId)->get();

            return view('customer.cart', compact('hardwareDetails', 'userAddresses'));
        }

        // return back()->with('error', 'Problem while fetching hardwares');

        return view('customer.cart', compact('hardwareDetails', 'userAddresses'));

    }

    public function removeFromCart($id)
    {


        \Log::info('Working till here!');
        $customerId = session('user_id');

        $cartItem = Cart::where('cart_customer_id', $customerId)->where('cart_hw_id', $id)->first();

        if ($cartItem) {

            $hardware = Hardware::where('hrdws_id', $id)->first();

            $cartItemQty = $cartItem->cart_qty;

            if ($hardware) {
                $hardware->hrdws_qty += $cartItemQty;
                $hardware->save();
            }

            $cartItem->delete();

            session()->put('cartCount', session('cartCount', 0) - 1);

            return response()->json([
                'success' => true,
                'cartCount' => session('cartCount', 0)
            ]);

        }

        return response()->json(['success' => false, 'message' => 'Item not found']);
    }

}
