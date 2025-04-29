<?php

namespace App\Livewire;

use App\Models\ProjectPlannerTask;
use Livewire\Component;
use Str;

class SpJobSuccessRate extends Component
{
    public function render()
    {
        $totalAssignedProjects = ProjectPlannerTask::where('pptasks_sp_id', session('sp_user_id'))->count();

        $totalFullfilledProjects = ProjectPlannerTask::where('pptasks_sp_id', session('sp_user_id'))
            ->get()
            ->filter(function ($task) {
                return Str::lower($task->pptasks_pt_status) === 'fullfilled';
            })
            ->count();

        $jobSuccessRate = $totalAssignedProjects > 0
            ? round(($totalFullfilledProjects / $totalAssignedProjects) * 100, 2)
            : 0;

        return view('livewire.sp-job-success-rate' , compact('jobSuccessRate'));
    }
}
