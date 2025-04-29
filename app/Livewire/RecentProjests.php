<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class RecentProjests extends Component
{
    public function render()
    {
        $projects = Project::orderBy('plist_id', 'desc')->where('plist_customer_id', session('user_id'))->take(5)->get();
        return view('livewire.recent-projests' , compact('projects'));
    }
}
