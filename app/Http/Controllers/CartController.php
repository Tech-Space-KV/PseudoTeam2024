<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Hardware;
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

        $customerId = session('customer_id');

        if (!$customerId) {

            return redirect()->back()->with('error', 'Customer id not found!');
        }

        $orderNo = \DB::table('cart')->max('cart_id') + 1;
        $orderNo = 'Order-' . $orderNo;

        try {

            Cart::create([
                'cart_order_no' => $orderNo,
                'cart_hw_id' => $cartHwId,
                'cart_qty' => $cartQty,
                'cart_customer_id' => $customerId,
            ]);

            \Log::info('Cart count before updating ' . session('cartCount'));

            session()->put('cartCount', session('cartCount', 0) + 1);


            \Log::info('Cart count after updating ' . session('cartCount'));

            return redirect()->back()->with('success', 'Added to cart!');

        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }

    }

    public function viewCart()
    {

        $customerId = session('customer_id');

        $cartItems = Cart::where('cart_customer_id', $customerId)->get();

        if ($cartItems->isNotEmpty()) {

            $hardwareDetails = [];

            foreach ($cartItems as $cartItem) {
                $hardware = Hardware::where('hrdws_id' , $cartItem->cart_hw_id)->first(); 
                if ($hardware) {
                    $hardwareDetails[] = $hardware; 
                }
            }

            return view('customer.cart', compact('hardwareDetails'));
        }

        return back()->with('error', 'Problem while fetching hardwares');
    }

    public function removeFromCart($id)
    {

        $customerId = session('customer_id');

        $cartItem = Cart::where('cart_customer_id', $customerId)->where('cart_hw_id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found']);
    }

}
