<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {

        \Log::info("Log in working!");

        $validated = $request->validate([
            "cart_hw_id" => "required",
            "cart_qty" => "required|integer|min:1",
        ]);


        \Log::info("Log1 is working!");

        $cartHwId = $validated['cart_hw_id'];
        $cartQty = $validated['cart_qty'];

        $customerId = session('customer_id');

        if (!$customerId) {
            \Log::info('if condition is working!');
           return redirect()->back()->with('error','Customer id not found!');
        }

        $orderNo = \DB::table('cart')->max('cart_id') + 1; 
        $orderNo = 'Order-'.$orderNo ;

        try {

            Cart::create([
                'cart_order_no'=> $orderNo,
                'cart_hw_id'=> $cartHwId,
                'cart_qty'=> $cartQty,
                'cart_customer_id'=> $customerId,
            ]);

            return redirect()->back()->with('success','Added to cart!');

        } catch (\Throwable $th) {
            \Log::info($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }

    }
}
