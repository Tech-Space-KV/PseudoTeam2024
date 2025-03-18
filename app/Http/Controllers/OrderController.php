<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Hardware;
use App\Models\OrderPlaced;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;

class OrderController extends Controller
{

    public function placeOrder(Request $request)
    {
        try {

            $customerId = session('customer_id');
            // $deliveryAddress = $request->input('delivery_address');

            $cartItems = Cart::where('cart_customer_id', $customerId)->get();
            $totalAmount = 0;

            $orderDate = $orderDate = Carbon::now()->format('d-m-Y');

            foreach ($cartItems as $cartItem) {
                $hardware = Hardware::find($cartItem->cart_hw_id);
                if ($hardware) {

                    $order = new OrderPlaced();
                    $order->ordplcd_customer_id = $customerId;
                    $order->ordplcd_order_no = $cartItem->cart_order_no;
                    $order->ordplcd_qty_placed = $cartItem->cart_qty;
                    $order->ordplcd_hw_id = $cartItem->cart_hw_id;
                    $order->ordplcd_amt = $hardware->hrdws_price * $cartItem->cart_qty;
                    $order->ordplcd_status = 'Pending';
                    $order->ordplcd_order_date = $orderDate;
                    $order->save();
                    $totalAmount += $order->ordplcd_amt;

                    if ($cartItem) {

                        $cartItem->delete();

                        $cartCount = session('cartCount', 0);
                        if ($cartCount > 0) {
                            session(['cartCount' => $cartCount - 1]);
                        }

                        session()->save();
                    }
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Order placed successfully!',
                'total_amount' => $totalAmount,
            ]);

        } catch (\Exception $e) {

            Log::error('Error placing order: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while placing the order.',
            ], 500);
        }
    }

    public function fetchOrderHistory() 
    {
        $customerId = session('customer_id');
        
        $orderHistory = OrderPlaced::where('ordplcd_customer_id' , $customerId)->get();

        return view('customer.marketplace_hardwares_orders' , compact('orderHistory'));
    }

}
