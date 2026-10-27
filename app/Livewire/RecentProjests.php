<?php

namespace App\Livewire;

use App\Http\Controllers\AuthController;
use App\Models\Project;
use Livewire\Component;

class RecentProjests extends Component
{
    // public function render()
    // {
    //     $projects = Project::orderBy('plist_id', 'desc')->where('plist_customer_id', session('user_id'))->take(5)->get();
    //     return view('livewire.recent-projests' , compact('projects'));
    // }

      public function render()
    {
        // $projects = Project::orderBy('plist_id', 'desc')
        //     ->where('plist_customer_id', session('user_id'))
        //     ->take(5)
        //     ->get();

        $projects = Project::orderBy('plist_id', 'desc')
    ->where('plist_customer_id', session('user_id'))
    ->where('plist_status', '!=', 'Delivered')  // exclude delivered
    ->take(5)
    ->get();


        // Resolve controller and call the public method
        $controller = app(AuthController::class);

        foreach ($projects as $project) {
            // Ensure progress is a float and between 0 and 100
            $progress = (float) $controller->calculateProjectProgress($project->plist_id);
            $project->progress = max(0, min(100, round($progress, 2)));
        }

        return view('livewire.recent-projests', compact('projects'));
    }
}
