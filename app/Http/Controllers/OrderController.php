<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlacedMail;
use App\Mail\OrderReceivedMail;
use App\Models\Cart;
use App\Models\Hardware;
use App\Models\OrderAddress;
use App\Models\OrderPlaced;
use App\Models\ProjectOwner;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Log;
use Mail;

class OrderController extends Controller
{

    public function placeOrder(Request $request)
    {

        Log::info('Request data:', $request->all());

        try {

            $customerId = session('user_id');

            $ordplcd_addressId = $request->input('selected_address_id');

            if($ordplcd_addressId)
            {

                $deliveryAddress = OrderAddress::where('ordradrs_id' , $ordplcd_addressId)->first();

            }

            $cartItems = Cart::where('cart_customer_id', $customerId)->get();
            $totalAmount = 0;

            $orderDate = $orderDate = Carbon::now()->format('d-m-Y');

            $orderNo = 'Order-' . Carbon::now()->format('YmdHis');

            foreach ($cartItems as $cartItem) {

                $hardware = Hardware::find($cartItem->cart_hw_id);
                if ($hardware) {

                    $order = new OrderPlaced();
                    $order->ordplcd_customer_id = $customerId;
                    $order->ordplcd_order_no = $orderNo;
                    $order->ordplcd_qty_placed = $cartItem->cart_qty;
                    $order->ordplcd_no_of_items = $cartItems->count();
                    $order->ordplcd_hw_id = $cartItem->cart_hw_id;
                    $order->ordplcd_amt = $hardware->hrdws_price * $cartItem->cart_qty;
                    $order->ordplcd_status = 'Pending';
                    $order->ordplcd_order_date = $orderDate;
                    $order->ordplcd_address = $deliveryAddress ? $deliveryAddress->ordradrs_address : null;
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

            $name = ProjectOwner::where('pown_id', $customerId)->value('pown_name');
            $email = ProjectOwner::where('pown_email', $customerId)->value('pown_email');

            Mail::to($email)->send(new OrderPlacedMail($orderNo, $name, $orderDate));
            Mail::to('info@pseudoteam.com')->send(new OrderReceivedMail($name, $email,$orderNo, $orderDate));

            return response()->json([
                'status' => 'success',
                'message' => 'Order placed successfully!',
                'total_amount' => $totalAmount,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while placing the order.',
            ], 500);
        }
    }

    public function fetchOrderHistory()
    {
        $customerId = session('user_id');

        $orderHistory = OrderPlaced::where('ordplcd_customer_id', $customerId)
            ->select('ordplcd_order_no', DB::raw('ordplcd_no_of_items as total_qty'), 'ordplcd_order_date')
            ->groupBy('ordplcd_order_no', 'ordplcd_order_date' , 'ordplcd_no_of_items')->orderBy('ordplcd_id', 'desc') 
            ->get();

        return view('customer.marketplace_hardwares_orders', compact('orderHistory'));
    }

    public function fetchOrderHistoryDetails($ordplcd_order_no)
    {
        $placedOrders = OrderPlaced::where('ordplcd_order_no', $ordplcd_order_no)
            ->orderBy('ordplcd_id', 'desc')
            ->get();

        $hardwareDetails = [];
        foreach ($placedOrders as $order) {

            $hardware = Hardware::find($order->ordplcd_hw_id);

            $hardwareDetails[] = [
                'hardware' => $hardware,
                'address' => $order->ordplcd_address,
                'status' => $order->ordplcd_status,
                'delivery_date' => $order->ordplcd_delivery_date,
                'quantity' => $order->ordplcd_qty_placed,
                'quantity_approved' => $order->ordplcd_final_qty,
            ];
        }

        return view('customer.marketplace_hardwares_order_details', compact('hardwareDetails', 'ordplcd_order_no'));
    }

}

