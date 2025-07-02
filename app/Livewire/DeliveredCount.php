<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class DeliveredCount extends Component
{
    public function render()
    {
        $projects = Project::where('plist_status', 'Delivered')->where('plist_customer_id', session('user_id'))->count();
        return view('livewire.delivered-count', compact('projects'));
    }
}
