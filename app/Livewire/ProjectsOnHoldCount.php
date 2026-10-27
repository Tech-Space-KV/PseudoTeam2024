<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class ProjectsOnHoldCount extends Component
{
    // public function render()
    // {
    //     $projects = Project::where('plist_project_status', 'Hold')->where('plist_customer_id', session('user_id'))->count();
    //     return view('livewire.projects-on-hold-count', compact('projects'));
    // }

    public function render()
    {
        $today = now()->format('Y-m-d');

        // $projects = Project::where('plist_customer_id', session('user_id'))
        //     ->where(function ($q) use ($today) {
        //         $q->where('plist_project_status', 'Hold')
        //             ->orWhereRaw("STR_TO_DATE(TRIM(plist_enddate), '%d-%m-%Y') < ?", [$today]);
        //     })
        //     ->count();

        $projects = Project::where('plist_customer_id', session('user_id'))
            ->where('plist_status', '!=', 'Delivered')
            ->where(function ($q) use ($today) {
                $q->where('plist_project_status', 'Hold')
                    ->orWhereRaw(
                        "STR_TO_DATE(TRIM(plist_enddate), '%d-%m-%Y') < ?",
                        [$today]
                    );
            })
            ->count();

        return view('livewire.projects-on-hold-count', compact('projects'));
    }


}
