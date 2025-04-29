<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;

class UnreadNotificationsCount extends Component
{
    public function render()
    {
        $unreadCount = Notification::where('ntfn_readflag', false)->where('ntfn_forUserId', session('user_id'))->where('ntfn_type', 'cust')->count();
        return view('livewire.unread-notifications-count' , compact('unreadCount'));
    }
}
