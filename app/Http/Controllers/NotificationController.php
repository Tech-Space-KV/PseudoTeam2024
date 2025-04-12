<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function fetchNotification()
    {
        // $notifications = Notification::all();

        $customerId = session('user_id');

        // $notifications = Notification::where('ntfn_forUserId' , $customerId)
        // ->where('ntfn_type' , 'cust')->get();

        $notifications = Notification::orderBy('ntfn_id' , 'desc')->where('ntfn_forUserId' , $customerId)
        ->where('ntfn_type' , 'cust')->get();

        if ($notifications) {
            return view('customer.notifications', compact('notifications'));
        }

        return back()->with('error', 'No notification found!');
    }

    public function fetchNotificationDetails($notificationId)
    {
        $notification = Notification::where('ntfn_id', $notificationId)->first();

        if (!$notification->ntfn_readflag) {
            $notification->ntfn_readflag = true;
            $notification->save();

            $unreadNotificationsCount = session('unreadNotificationsCount', 0);

            if ($unreadNotificationsCount > 0) {
                session(['unreadNotificationsCount' => $unreadNotificationsCount - 1]);
            }
        }

        if ($notification) {
            return view('customer.notification-details', compact('notification'));
        }

        return back()->with('error', 'No notification found!');
    }
}
