<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class ProjectsNotStartedCount extends Component
{
    public function render()
    {
        $projects = Project::where('plist_status', 'No SP Assigned')->where('plist_customer_id', session('user_id'))->count();
        return view('livewire.projects-not-started-count',compact('projects'));
    }
}
