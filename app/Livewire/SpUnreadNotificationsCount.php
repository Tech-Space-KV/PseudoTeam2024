<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;

class SpUnreadNotificationsCount extends Component
{
    public function render()
    {
        $unreadCount = Notification::where('ntfn_readflag', false)
        ->where('ntfn_forUserId', session('sp_user_id'))
        ->where('ntfn_type', 'sp')->count();
        return view('livewire.sp-unread-notifications-count' , compact('unreadCount'));
    }
}
