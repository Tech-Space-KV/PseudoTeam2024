<?php

namespace App\Livewire;

use App\Models\ProjectPlannerTask;
use Livewire\Component;

class SpRecentProjects extends Component
{
    public function render()
    {
        $projects = ProjectPlannerTask::with([
            'projectPlanner.projectScope.project.manager' 
        ])
            ->where('pptasks_sp_id', session('sp_user_id'))
            ->get()
            ->map(function ($task) {
                return optional(optional($task->projectPlanner)->projectScope)->project;
            })
            ->filter()
            ->unique('plist_id')
            ->values();

        return view('livewire.sp-recent-projects' , compact('projects'));
    }
}
