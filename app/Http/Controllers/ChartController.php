<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPlannerTask;
use DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    // Render the view
    public function index()
    {
        return view('/customer/reports');
    }

    public function spIndex(){
        
        return view('/service-partner/reports');

    }

    // Provide data for the chart
    public function getData()
    {

        $customerId = session('user_id');

        $noSPAssignedCount = Project::where('plist_status', 'No SP Assigned')->where('plist_customer_id' , $customerId)->count();
        $deliveredCount = Project::where('plist_status', 'Delivered')->where('plist_customer_id' , $customerId)->count();
        $inProgressCount = Project::where('plist_status', 'In Progress')->where('plist_customer_id' , $customerId)->count();
        //$overdueCount = Project::where('plist_enddate' ,'<', now())->count();
        $overdueCount = DB::table('project_list')
            ->whereRaw("STR_TO_DATE(plist_enddate, '%d-%m-%Y') < CURDATE()")
            ->where('plist_status', 'No SP Assigned')
            ->where('plist_customer_id' , $customerId)
            ->count();

        $statuses = [
            'pending' => $noSPAssignedCount,
            'delivered' => $deliveredCount,
            'in_progress' => $inProgressCount,
            'overdue' => $overdueCount,
        ];

        return response()->json($statuses);
    }

    public function getSPData()
    {

        $serviceProviderId = session('sp_user_id');

        $notStartedCount = Project::where('plist_status', 'No SP Assigned')->where('plist_customer_id' , $serviceProviderId)->count();
        $fullfilledCount = Project::where('plist_status', 'Delivered')->where('plist_customer_id' , $serviceProviderId)->count();
        $onGoingCount = Project::where('plist_status', 'In Progress')->where('plist_customer_id' , $serviceProviderId)->count();
        //$overdueCount = Project::where('plist_enddate' ,'<', now())->count();
        $scrappedCount = DB::table('project_list')
            ->whereRaw("STR_TO_DATE(plist_enddate, '%d-%m-%Y') < CURDATE()")
            ->where('plist_status', 'No SP Assigned')
            ->where('plist_customer_id' , $serviceProviderId)
            ->count();

        $statuses = [
            'pending' => $notStartedCount,
            'delivered' => $fullfilledCount,
            'in_progress' => $onGoingCount,
            'overdue' => $scrappedCount,
        ];

        return response()->json($statuses);
    
    }

}


