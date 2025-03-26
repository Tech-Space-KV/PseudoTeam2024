<?php

namespace App\Http\Controllers;

use App\Models\Project;
use DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    // Render the view
    public function index()
    {
        return view('/customer/reports');
    }

    // Provide data for the chart
    public function getData()
    {

        $noSPAssignedCount = Project::where('plist_status', 'No SP Assigned')->count();
        $deliveredCount = Project::where('plist_status', 'Delivered')->count();
        $inProgressCount = Project::where('plist_status', 'In Progress')->count();
        //$overdueCount = Project::where('plist_enddate' ,'<', now())->count();
        $overdueCount = DB::table('project_list')
            ->whereRaw("STR_TO_DATE(plist_enddate, '%d-%m-%Y') < CURDATE()")
            ->where('plist_status', 'No SP Assigned')
            ->count();

        \Log::info($overdueCount);

        $statuses = [
            'pending' => $noSPAssignedCount,
            'delivered' => $deliveredCount,
            'in_progress' => $inProgressCount,
            'overdue' => $overdueCount,
        ];

        return response()->json($statuses);
    }
}
