<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class InProgressProjectsCount extends Component
{
    public function render()
    {
        $projects = Project::where('plist_status', 'In Progress')->where('plist_customer_id', session('user_id'))->count();
        return view('livewire.in-progress-projects-count', compact('projects'));
    }
}
