<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function fetchNotification()
    {
        $customerId = session('user_id');

        $notifications = Notification::orderBy('ntfn_id', 'desc')->where('ntfn_forUserId', $customerId)
            ->where('ntfn_type', 'cust')->get();

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

    public function fetchSpNotification()
    {
        $spId = session('sp_user_id');

        $notifications = Notification::orderBy('ntfn_id', 'desc')->where('ntfn_forUserId', $spId)
            ->where('ntfn_type', 'sp')->get();

        if ($notifications) {
            return view('service-partner.notifications', compact('notifications'));
        }

        return back()->with('error', 'No notification found!');
    }

    public function destroyNotification($id)
    {
        \Log::info("Delete request received for notification ID: {$id}");

        $notification = Notification::find($id);

        if (!$notification) {
            Log::warning("Notification ID {$id} not found.");
            return response()->json(['success' => false, 'error' => 'Notification not found'], 404);
        }

        // Optional: Check user ownership
        // if ($notification->user_id !== auth()->id()) {
        //     Log::warning("Unauthorized attempt to delete notification ID: {$id}");
        //     return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
        // }

        $notification->delete();

        \Log::info("Notification ID {$id} deleted successfully.");
        return response()->json(['success' => true]);
    }


}
