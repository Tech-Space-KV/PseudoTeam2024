<?php

namespace App\Http\Controllers;

use App\Exports\ProjectsExport;
use App\Mail\ProjectUploadedMail;
use App\Models\ProjectPlanner;
use App\Models\ProjectPlannerTask;
use App\Models\ProjectScope;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Mail;

//Implemented by sanskar

class ProjectController extends Controller
{
    public function store(Request $request)
    {

        $plistId = $request->input('plist_id');

        if ($request->has('plist_id') && $request->input('readonly') === 'true') {
            return redirect()->back()->with('success', 'Project is already saved and no changes were made.');
        }

        $validated = $request->validate([
            'plist_title' => 'required|string|max:255',
            'plist_description' => 'required|string',
            'plist_sow' => 'nullable|file|mimes:pdf,docx,doc|max:2048',
            'plist_type' => 'required|string',
            'plist_startdate' => 'required|string',
            'plist_enddate' => 'required|string',
            'plist_currency' => 'required|string',
            'plist_budget' => 'required|numeric',
            'plist_checkrcv' => 'nullable|string',
            'plist_name' => 'required|string|max:255',
            'plist_email' => 'required|email|max:255',
            'plist_contact' => 'required|string|max:255',
            'plist_ongnew' => 'required|string',
            'plist_category' => 'required|string',
            'plist_coupon' => 'nullable|string',
            'plist_customeremail' => 'nullable|string',
        ]);

        $currentTime = Carbon::now('Asia/Kolkata');

        $startDate = Carbon::createFromFormat('Y-m-d', $validated['plist_startdate'])->format('d-m-Y');
        $endDate = Carbon::createFromFormat('Y-m-d', $validated['plist_enddate'])->format('d-m-Y');

        $createdAt = $currentTime->format('d-m-Y H:i:s');
        $updatedAt = $currentTime->format('d-m-Y H:i:s');

        $sowData = null;
        if ($request->hasFile('plist_sow')) {
            $sowFile = $request->file('plist_sow');
            $sowData = file_get_contents($sowFile->getRealPath());
        }

        $projectId = 'Pseudo' . '-' . $currentTime->format('Y-mdHis');
        $status = 'No SP Assigned';
        $projectStatus = 'Live';
        $checkrcv = $request->has('plist_checkrcv') ? 'True' : 'False';

        $custId = session('user_id');

        try {

            $existingProject = Project::where('plist_id', $plistId)->first();

            if ($existingProject) {
                // If the project exists, update it
                $existingProject->update([
                    'plist_title' => $validated['plist_title'],
                    'plist_description' => $validated['plist_description'],
                    'plist_sow' => $sowData,
                    'plist_type' => $validated['plist_type'],
                    'plist_startdate' => $startDate,
                    'plist_enddate' => $endDate,
                    'plist_currency' => $validated['plist_currency'],
                    'plist_budget' => $validated['plist_budget'],
                    'plist_checkrcv' => $checkrcv,
                    'plist_customeremail' => $validated['plist_customeremail'],
                    'plist_name' => $validated['plist_name'],
                    'plist_email' => $validated['plist_email'],
                    'plist_contact' => $validated['plist_contact'],
                    'plist_status' => $status,
                    'plist_project_status' => $projectStatus,
                    'plist_ongnew' => $validated['plist_ongnew'],
                    'plist_category' => $validated['plist_category'],
                    'plist_coupon' => $validated['plist_coupon'],
                    'updated_at' => $updatedAt,
                ]);

                //session code updated by sanskar sharma on 05-04-2024

                $recentProjects = Project::orderBy('plist_id', 'desc')->where('plist_customer_id' ,     session('user_id'))->take(5)->get();

                session(['recentProjects' => $recentProjects]);

                return redirect()->back()->with('success', 'Project has been updated successfully.');
            } else {
                // If the project does not exist, create it
                Project::create([
                    'plist_customer_id' => $custId,
                    'plist_projectid' => $projectId,
                    'plist_title' => $validated['plist_title'],
                    'plist_description' => $validated['plist_description'],
                    'plist_sow' => $sowData,
                    'plist_type' => $validated['plist_type'],
                    'plist_startdate' => $startDate,
                    'plist_enddate' => $endDate,
                    'plist_currency' => $validated['plist_currency'],
                    'plist_budget' => $validated['plist_budget'],
                    'plist_checkrcv' => $checkrcv,
                    'plist_customeremail' => $validated['plist_customeremail'],
                    'plist_name' => $validated['plist_name'],
                    'plist_email' => $validated['plist_email'],
                    'plist_contact' => $validated['plist_contact'],
                    'plist_status' => $status,
                    'plist_project_status' => $projectStatus,
                    'plist_ongnew' => $validated['plist_ongnew'],
                    'plist_category' => $validated['plist_category'],
                    'plist_coupon' => $validated['plist_coupon'],
                    'created_at' => $createdAt,
                    'updated_at' => $updatedAt,
                ]);

                $recentProjects = Project::orderBy('plist_id', 'desc')
                    ->where('plist_customer_id', session('user_id'))
                    ->take(5)
                    ->get();

                // Updating the session with the latest projects
                session(['recentProjects' => $recentProjects]);

                return redirect()->back()->with('success', 'Project has been uploaded successfully.');
            }
        } catch (\Exception $e) {
            \Log::error('Error storing or updating project: ' . $e->getMessage(), [
                'exception' => [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                ]
            ]);
            return redirect()->back()->with('error', 'There was an error creating or updating the project.');
        }
    }

    public function trackProjects()
    {

        $customerId = session('user_id');

        if ($customerId) {

            $projects = Project::orderBy('plist_id' , 'desc')->where('plist_customer_id', $customerId)->get();

        } else {

            return redirect()->back()->with('error', 'Customer ID did not exists!');

        }

        // $projects = Project::all();

        if ($projects) {
            return view('customer.track_project_report', compact('projects'));
        }

        return redirect()->back()->with('error', 'No Projects Found!');
    }

    public function trackProjectReportLocation($projectid)
    {

        $project_scope = ProjectScope::where('pscope_project_id', $projectid)->get();

        if (!$project_scope) {
            return redirect()->route('customer.dashboard')->with('error', 'Project not found.');
        }

        return view('customer.track_project_report_location', compact('project_scope'));
    }

    public function trackProjectReportDetails($projectid)
    {
        $project_planner = ProjectPlanner::where('pplnr_scope_id', $projectid)->get();

        if (!$project_planner) {
            return redirect()->route('customer.dashboard')->with('error', 'Project not found.');
        }

        $totalProjects = ProjectPlanner::where('pplnr_scope_id', $projectid)->whereNot('pplnr_status', 'Fullfilled')->count();

        $fullfilledProjects = ProjectPlanner::where('pplnr_scope_id', $projectid)->where('pplnr_status', 'Fullfilled')->count();

        //$nd = ProjectPlanner::where('pplnr_scope_id' , $projectid)->whereNot('pplnr_status' , 'ND')->count();

        $average = $totalProjects > 0 ? ($fullfilledProjects) / $totalProjects * 100 : 0;

        $average = number_format($average, 2);

        return view('customer.track_project_report_details', compact('project_planner', 'average'));
    }

    public function trackProjectPending()
    {

        $customerId = session('user_id');

        $projects = Project::where('plist_status', 'No SP Assigned')->where('plist_customer_id', $customerId)->get();

        if ($projects->isEmpty()) {
            return redirect()->route('customer.dashboard')->with('error', 'Project not found.');
        }

        return view('customer.track_project_report', compact('projects'));
    }

    public function trackProjectInProgress()
    {

        $customerId = session('user_id');

        $projects = Project::where('plist_status', 'In Progress')->where('plist_customer_id', $customerId)->get();

        if ($projects->isEmpty()) {
            return redirect()->route('customer.dashboard')->with('error', 'Project not found.');
        }

        return view('customer.track_project_report', compact('projects'));
    }

    public function trackProjectDelivered()
    {

        $customerId = session('user_id');

        $projects = Project::where('plist_status', 'Delivered')->where('plist_customer_id', $customerId)->get();

        if ($projects->isEmpty()) {
            return redirect()->route('customer.dashboard')->with('error', 'Project not found.');
        }

        return view('customer.track_project_report', compact('projects'));
    }

    public function trackProjectOverdue()
    {

        $customerId = session('user_id');

        $currentDate = Carbon::now()->toDateString();

        // $projects = Project::whereNotNull('plist_enddate')
        //     ->where('plist_enddate', '<=', now()->subDay()->format('d/m/Y'))
        //     ->get();

        $projects = DB::table('project_list')
            ->whereRaw("STR_TO_DATE(plist_enddate, '%d-%m-%Y') < CURDATE()")
            ->where('plist_status', 'No SP Assigned')
            ->where('plist_customer_id', $customerId)
            ->get();

        if ($projects->isEmpty()) {
            return redirect()->route('customer.dashboard')->with('error', 'Project not found.');
        }

        return view('customer.track_project_report', compact('projects'));
    }

    public function projectTimeline($pplnr_id)
    {
        $projectTimeline = ProjectPlannerTask::where('pptasks_planner_id', $pplnr_id)->get();

        if (!$projectTimeline) {
            return redirect()->back()->with('error', 'ProjectTimeline not found.');
        }

        return view('customer.project_timeline', compact('projectTimeline'));
    }

    public function searchProject(Request $request)
    {

        $customerId = session('user_id');

        $query = $request->input('query', '');

        if (!empty($query)) {
            // $projects = Project::where('plist_projectid', 'like', '%' . $query . '%')
            //     ->orWhere('plist_title', 'like', '%' . $query . '%')
            //     ->paginate(10);

            $projects = Project::where('plist_projectid', 'like', '%' . $query . '%')->where('plist_customer_id', $customerId)
                ->orWhere('plist_title', 'like', '%' . $query . '%')->where('plist_customer_id', $customerId)
                ->paginate(10);

        } else {
            $projects = Project::paginate(10);
        }

        return view('customer.search_project', compact('projects'));
    }

    public function fetchProject($plist_id)
    {
        $project = Project::where('plist_id', $plist_id)->first();

        $readonly = ($project->plist_status !== 'No SP Assigned') ? true : false;

        return view('customer.project_upload_form', ['project' => $project, 'readonly' => $readonly]);
    }

    public function exportCSV()
    {
        $customerId = session('customer_id');

        return Excel::download(new ProjectsExport($customerId), 'projects.csv');
    }

    public function exportPDF()
    {
        $projects = Project::all();
        $pdf = Pdf::loadView('customer.projectspdf', compact('projects'));
        return $pdf->download('projects.pdf');
    }

    public function reports()
    {
        $cusomerId = session('user_id');

        $projects = Project::where('plist_customer_id', $cusomerId)->get();
    }

    public function manageProject(){
        
        $serviceProviderId = session('sp_user_id');

        $projects = ProjectPlannerTask::with([
            'projectPlanner.projectScope.project'
        ])
        ->where('pptasks_sp_id', $serviceProviderId)
        ->get()
        ->map(function ($task) {
            return optional(optional($task->projectPlanner)->projectScope)->project;
        })
        ->filter()
        ->unique('plist_id')
        ->values();

        if($projects) {

            return view('/service-partner/manage_project' , compact('projects'));

        }

        return redirect()->back()->with('error' , 'Project not found!');

    }

    public function manageprojectLocation($projectId){
        
        $project_scope = ProjectScope::where('pscope_project_id', $projectId)->get();

        \Log::info('log : ' . print_r($project_scope->toArray(), true));

        if (!$project_scope) {
            return redirect()->route('service-partner.dashboard')->with('error', 'Project not found.');
        }

        return view('service-partner.manage_project_location', compact('project_scope'));

    }

    public function manageProjectdetails($pscopeId) {
        
        $projectPlanner = ProjectPlanner::where('pplnr_scope_id' , $pscopeId)->get(); 
        
        if(!$projectPlanner) {

            return redirect()->back()->with('error' , 'Not found!');

        }

        \Log::info('pplnr' . $projectPlanner);
        
        return view('/service-partner/manage_project_details' , compact('projectPlanner'));

    }

    public function manageProjectViewTasks($plannerId) {
        
        $projectPlannerTasks = ProjectPlannerTask::where('pptasks_planner_id' , $plannerId)->get();

        if(!$projectPlannerTasks)
        {

            return redirect()->back()->with('error' , 'Project Planner Tasks Not Found!');

        }

        return view('service-partner/manage_project_view_tasks' , compact('projectPlannerTasks'));

    }

    public function manageProjectEditTasks($ppTaskId) {
        
        $projectPlannerTasks = ProjectPlannerTask::where('pptasks_id' , $ppTaskId)->first();

        if(!$projectPlannerTasks) {

            return redirect()->back()->with('error' , 'Project Planner Tasks Not Found!');

        }

        return view('service-partner/manage_project_edit_task' , compact('projectPlannerTasks'));

    }

    public function listOfProjects(){
        
        $serviceProviderId = session('sp_user_id');

        $projects = ProjectPlannerTask::with([
            'projectPlanner.projectScope.project'
        ])
        ->where('pptasks_sp_id', $serviceProviderId)
        ->get()
        ->map(function ($task) {
            return optional(optional($task->projectPlanner)->projectScope)->project;
        })
        ->filter()
        ->unique('plist_id')
        ->values();

        if($projects) {

            return view('/service-partner/all_projects' , compact('projects'));

        }

        return redirect()->back()->with('error' , 'Project not found!');

    }
}