<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Hardware;
use App\Models\OrderPlaced;
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

        $hardware = Hardware::where('hrdws_id' , $cartHwId)->first();

        if($hardware)
        {
            $hardware->hrdws_qty -= $cartQty;
            $hardware->save();
        }

        $customerId = session('user_id');

        if (!$customerId) {

            return redirect()->back()->with('error', 'Customer id not found!');
        }


        $cart = session()->get('cart', []);

        // $orderNo = \DB::table('cart')->max('cart_id') + 1;
        // $orderNo = 'Order-' . $orderNo;

        try {

            $addedItem = Cart::where('cart_hw_id' , $cartHwId)->first();

            if($addedItem)
            {
                $addedItem->cart_qty += $cartQty;
                $addedItem->save();

                // session()->put('cartCount', session('cartCount', 0) + 1);

                return redirect()->back()->with('success', 'Item added to cart!');
            }
            
            Cart::create([
                // 'cart_order_no' => $orderNo,
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

        if ($cartItems->isNotEmpty()) {

            $hardwareDetails = [];

            foreach ($cartItems as $cartItem) {
                $hardware = Hardware::where('hrdws_id' , $cartItem->cart_hw_id)->first(); 
                if ($hardware) {
                    // $hardwareDetails[] = $hardware; 

                    $hardwareDetails[] = [
                        'hardware' => $hardware,
                        'quantity' => $cartItem->cart_qty
                    ];

                }
            }

            return view('customer.cart', compact('hardwareDetails'));
        }

        return back()->with('error', 'Problem while fetching hardwares');
    }

    public function removeFromCart($id)
    {

        $customerId = session('user_id');

        $cartItem = Cart::where('cart_customer_id', $customerId)->where('cart_hw_id', $id)->first();

        if ($cartItem) {

            $hardware = Hardware::where('hrdws_id' , $id)->first();

            $cartItemQty = $cartItem->cart_qty;

            if($hardware)
            {
                $hardware->hrdws_qty += $cartItemQty;
                $hardware->save();
            }

            $cartItem->delete();

            session()->put('cartCount', session('cartCount', 0) - 1);

            return response()->json([
                'success' => true,
                'cartCount' => session('cartCount', 0)
            ]);

            // return response()->json(['success' => true]);
        }

        \Log::info('If not working!');
        return response()->json(['success' => false, 'message' => 'Item not found']);
    }

    // public function placeOrder(Request $request)
    // {
    //     $customerId = session('customer_id');
        
    //     $cartItems = Cart::where('cart_customer_id', $customerId)->get();

    //     if ($cartItems->isEmpty()) {
    //         return response()->json(['message' => 'Your cart is empty.'], 400);
    //     }

    //     $hardwareDetails = [];
    //     $totalPrice = 0;

    //     foreach ($cartItems as $cartItem) {
    //         $hardware = Hardware::where('hrdws_id', $cartItem->cart_hw_id)->first();

    //         if ($hardware) {
    //             $hardwareDetails[] = $hardware;

    //             $totalPrice += $hardware->hrdws_price * $cartItem->cart_qty;
    //         }
    //     }

    //     $deliveryAddress = $request->input('delivery_address');
    //     if (!$deliveryAddress || $deliveryAddress == 'Select delivery address') {
    //         return response()->json(['message' => 'Please select a delivery address.'], 400);
    //     }

    //     $order = OrderPlaced::create([
    //         'ordplcd_hw_id' => 
    //         'user_id' => $customerId,
    //         'cart_items' => json_encode($hardwareDetails), 
    //         'total_price' => $totalPrice,
    //         'delivery_address' => $deliveryAddress,
    //     ]);

    //     Cart::where('cart_customer_id', $customerId)->delete();

    //     return response()->json([
    //         'message' => 'Order placed successfully!',
    //         'order_id' => $order->id,
    //         'total_price' => $totalPrice
    //     ]);
    // }

}
