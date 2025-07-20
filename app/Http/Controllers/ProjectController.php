<?php

namespace App\Http\Controllers;

use App\Exports\ProjectsExport;
use App\Mail\ProjectUploadedMail;
use App\Mail\ProjectUploadedMailCopy;
use App\Mail\SPInterestMail;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\ProjectOwners;
use App\Models\ProjectPlanner;
use App\Models\ProjectPlannerTask;
use App\Models\ProjectScope;
use App\Models\ServiceProvider;
use App\Models\SpComment;
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

        ini_set('upload_max_filesize', '100M');
        ini_set('post_max_size', '100M');
        ini_set('memory_limit', '256M');
        ini_set('max_execution_time', '300');
        ini_set('max_input_time', '300');

        $plistId = $request->input('plist_id');

        if ($request->has('plist_id') && $request->input('readonly') === 'true') {
            return redirect()->back()->with('success', 'Project is already saved and no changes were made.');
        }

        $validated = $request->validate([
            'plist_title' => 'required|string|max:255',
            'plist_description' => 'required|string',
            'plist_sow' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,csv|max:5120',
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

                $recentProjects = Project::orderBy('plist_id', 'desc')->where('plist_customer_id', session('user_id'))->take(5)->get();

                session(['recentProjects' => $recentProjects]);

                return redirect()->back()->with('success', 'Project has been updated successfully.');

            } else {
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

                session(['recentProjects' => $recentProjects]);

                $unreadNotificationsCount = Notification::where('ntfn_readflag', false)
                    ->where('ntfn_forUserId', session('user_id'))
                    ->where('ntfn_type', 'cust')->count();

                session(['unreadNotificationsCount' => $unreadNotificationsCount]);


                $data = [
                    'plist_title' => $validated['plist_title'],
                    'plist_projectid' => $projectId,
                ];

                $name = ProjectOwners::where('pown_id', session('user_id'))->value('pown_name');


                $email = ProjectOwners::where('pown_id' , session('user_id'))->value('pown_email');

                \Log::info('Email' . $email);

                mail::to($email)->send(new ProjectUploadedMail($data, $name, $validated['plist_title']));
                mail::to('info@pseudoteam.com')->send(new ProjectUploadedMailCopy($validated['plist_title'], $name, $validated['plist_email']));

                return redirect()->back()->with('success', 'Project has been uploaded successfully.');
            }
        } catch (\Exception $e) {

            \Log::info('Testing sow error.  ' . $e);

            return redirect()->back()->with('error', 'There was an error creating or updating the project.');
        }
    }

    public function trackProjects()
    {

        $customerId = session('user_id');

        if ($customerId) {

            $projects = Project::orderBy('plist_id', 'desc')->where('plist_customer_id', $customerId)->get();

        } else {

            return redirect()->back()->with('error', 'Customer ID did not exists!');

        }

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

        $projectScope = ProjectScope::where('pscope_id', $projectid)->first();

        if (!$project_planner) {
            return redirect()->route('customer.dashboard')->with('error', 'Project not found.');
        }

        $totalProjects = ProjectPlanner::where('pplnr_scope_id', $projectid)->whereNot('pplnr_status', 'Fullfilled')->count();

        $fullfilledProjects = ProjectPlanner::where('pplnr_scope_id', $projectid)->where('pplnr_status', 'Fullfilled')->count();

        $average = $totalProjects > 0 ? ($fullfilledProjects) / $totalProjects * 100 : 0;

        $average = number_format($average, 2);

        $comments = Comment::where('pconv_scope_id', $projectid)->get();

        return view('customer.track_project_report_details', compact('project_planner', 'average', 'projectScope', 'comments'));
    }

    public function trackProjectPending()
    {

        $customerId = session('user_id');

        $projects = Project::where('plist_status', 'No SP Assigned')->where('plist_customer_id', $customerId)->get();

        return view('customer.track_project_report', compact('projects'));
    }

    public function trackProjectInProgress()
    {

        $customerId = session('user_id');

        $projects = Project::where('plist_status', 'In Progress')->where('plist_customer_id', $customerId)->get();

        return view('customer.track_project_report', compact('projects'));
    }

    public function trackProjectDelivered()
    {

        $customerId = session('user_id');

        $projects = Project::where('plist_status', 'Delivered')->where('plist_customer_id', $customerId)->get();

        return view('customer.track_project_report', compact('projects'));
    }

    public function trackProjectOverdue()
    {

        $customerId = session('user_id');

        $currentDate = Carbon::now()->toDateString();

        $projects = DB::table('project_list')
            ->whereRaw("STR_TO_DATE(plist_enddate, '%d-%m-%Y') < CURDATE()")
            ->where('plist_status', 'No SP Assigned')
            ->where('plist_customer_id', $customerId)
            ->get();

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

            $projects = Project::where('plist_projectid', 'like', '%' . $query . '%')->where('plist_customer_id', $customerId)
                ->orWhere('plist_title', 'like', '%' . $query . '%')->where('plist_customer_id', $customerId)
                ->paginate(10);

        } else {
            $projects = Project::paginate(10);
        }

        return view('customer.search_project', compact('projects'));
    }

    public function spSearchProject(Request $request)
    {

        $serviceProviderId = session('sp_user_id');
        $query = $request->input('query', '');

        $tasks = ProjectPlannerTask::with([
            'projectPlanner.projectScope.project'
        ])
            ->where('pptasks_sp_id', $serviceProviderId)
            ->get();

        $relatedProjects = $tasks
            ->map(function ($task) {
                return optional(optional($task->projectPlanner)->projectScope)->project;
            })
            ->filter()
            ->unique('plist_id')
            ->values();


        $projectIds = $relatedProjects->pluck('plist_id');
        $projectsQuery = Project::whereIn('plist_id', $projectIds);

        if (!empty($query)) {

            $projectsQuery->where(function ($q) use ($query) {
                $q->where('plist_projectid', 'like', '%' . $query . '%')
                    ->orWhere('plist_title', 'like', '%' . $query . '%');
            });
        }

        $projects = $projectsQuery->paginate(10);

        return view('service-partner/search_project', compact('projects', 'query'));
    }


    public function fetchProject($plist_id)
    {
        $project = Project::where('plist_id', $plist_id)->first();

        $readonly = ($project->plist_status !== 'No SP Assigned') ? true : false;

        return view('customer.project_upload_form', ['project' => $project, 'readonly' => $readonly]);
    }

    public function exportCSV()
    {
        $customerId = session('user_id');

        return Excel::download(new ProjectsExport($customerId), 'projects.csv');
    }

    public function exportPDF()
    {
        $projects = Project::where('plist_customer_id', session('user_id'))->get();
        $pdf = Pdf::loadView('customer.projectspdf', compact('projects'));
        return $pdf->download('projects.pdf');
    }

    public function reports()
    {
        $cusomerId = session('user_id');

        $projects = Project::where('plist_customer_id', $cusomerId)->get();
    }

    public function manageProject()
    {

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

        if ($projects) {

            return view('/service-partner/manage_project', compact('projects'));

        }

        return redirect()->back()->with('error', 'Project not found!');

    }

    public function manageprojectLocation($projectId)
    {

        $project_scope = ProjectScope::where('pscope_project_id', $projectId)->get();

        \Log::info('log : ' . print_r($project_scope->toArray(), true));

        if (!$project_scope) {
            return redirect()->route('service-partner.dashboard')->with('error', 'Project not found.');
        }

        return view('service-partner.manage_project_location', compact('project_scope'));

    }

    public function manageProjectdetails($pscopeId)
    {

        $projectPlanner = ProjectPlanner::where('pplnr_scope_id', $pscopeId)->get();

        if (!$projectPlanner) {

            return redirect()->back()->with('error', 'Not found!');

        }

        \Log::info('pplnr' . $projectPlanner);

        return view('/service-partner/manage_project_details', compact('projectPlanner'));

    }

    public function manageProjectViewTasks($plannerId)
    {

        $projectPlannerTasks = ProjectPlannerTask::where('pptasks_planner_id', $plannerId)->get();

        if (!$projectPlannerTasks) {

            return redirect()->back()->with('error', 'Project Planner Tasks Not Found!');

        }

        return view('service-partner/manage_project_view_tasks', compact('projectPlannerTasks'));

    }

    public function manageProjectEditTasks($ppTaskId)
    {

        $task = ProjectPlannerTask::with([
            'projectPlanner.projectScope.project'
        ])
            ->where('pptasks_id', $ppTaskId)
            ->first();

        $projectPlannerTasks = optional(optional($task->projectPlanner)->projectScope)->project;

        $currentDate = Carbon::now()->format('d-m-Y');

        if (!$projectPlannerTasks) {

            return redirect()->back()->with('error', 'Project Planner Tasks Not Found!');

        }

        $SpComments = SpComment::where('tconv_task_id', $ppTaskId)
            ->orderBy('tconv_comment_date_time', 'desc')
            ->get();

        if ($SpComments->isNotEmpty()) {
            $sp_id = $SpComments->first()->tconv_comment_by_sp_id;
        }

        return view('service-partner/manage_project_edit_task', compact('projectPlannerTasks', 'task', 'currentDate', 'SpComments'));

    }

    public function updateTask(Request $request)
    {

        $request->validate([
            'pptasks_id' => 'required|exists:project_planner_tasks,pptasks_id',
            'pptasks_sp_status' => 'required|string',
            'pptasks_proof_of_completion' => 'nullable|file|mimes:pdf,csv,xlsx|max:20480',
        ]);

        $task = ProjectPlannerTask::find($request->pptasks_id);
        $task->pptasks_sp_status = $request->pptasks_sp_status;

        if ($request->hasFile('pptasks_proof_of_completion')) {

            $file = $request->file('pptasks_proof_of_completion');
            $task->pptasks_proof_of_completion = file_get_contents($file->getRealPath());

        }

        $currentTime = Carbon::now('Asia/Kolkata');

        $up = $currentTime->format('d-m-Y H:i:s'); // 20-07-2025 15:17:03

        // $task->pptasks_date_of_completion = $currentTime->format('d-m-y'); // e.g., 20-07-25
        $task->updated_at = $up; 

        $task->save();

        return redirect()->back()->with('success', 'Task updated successfully!');
    }

    public function listOfProjects()
    {

        $serviceProviderId = session('sp_user_id');

        $projects = ProjectPlannerTask::with([
            'projectPlanner.projectScope.project.manager',
            'projectPlanner',
            'projectPlanner.projectScope'
        ])
            ->where('pptasks_sp_id', $serviceProviderId)
            ->get()
            ->map(function ($task) {
                $project = optional(optional(optional($task->projectPlanner)->projectScope)->project);

                return [
                    'plist_projectid' => $project->plist_projectid ?? null,
                    'pscope_country' => $task->projectPlanner->projectScope->pscope_country ?? null,
                    'pscope_state' => $task->projectPlanner->projectScope->pscope_state ?? null,
                    'pscope_pincode' => $task->projectPlanner->projectScope->pscope_pincode ?? null,
                    'pplnr_milestone' => $task->projectPlanner->pplnr_milestone ?? null,
                    'pptasks_task_title' => $task->pptasks_task_title,
                    'pptasks_sp_status' => $task->pptasks_sp_status,
                    'pptasks_pt_status' => $task->pptasks_pt_status,
                    'manager_email' => optional($project->manager)->email ?? null,
                    'pptasks_planner_id' => $task->pptasks_planner_id,
                ];
            })
            ->filter(fn($item) => $item['plist_projectid'] !== null)
            ->unique('plist_projectid')
            ->values();


        if ($projects) {

            return view('/service-partner/all_projects', compact('projects'));

        }

        return redirect()->back()->with('error', 'Project not found!');

    }

    public function spTrackProjectDelivered()
    {

        $serviceProvider = session('sp_user_id');

        return view('service-partner/project_reports');

    }

    public function projectNotStartedReports()
    {

        $serviceProviderId = session('sp_user_id');

        $projects = ProjectPlannerTask::with([
            'projectPlanner.projectScope.project.manager',
            'projectPlanner',
            'projectPlanner.projectScope'
        ])
            ->where('pptasks_sp_id', $serviceProviderId)
            ->where('pptasks_sp_status', 'Not Started')
            ->get()
            ->map(function ($task) {
                $project = optional(optional(optional($task->projectPlanner)->projectScope)->project);

                return [
                    'plist_projectid' => $project->plist_projectid ?? null,
                    'pscope_country' => $task->projectPlanner->projectScope->pscope_country ?? null,
                    'pscope_state' => $task->projectPlanner->projectScope->pscope_state ?? null,
                    'pscope_pincode' => $task->projectPlanner->projectScope->pscope_pincode ?? null,
                    'pplnr_milestone' => $task->projectPlanner->pplnr_milestone ?? null,
                    'pptasks_task_title' => $task->pptasks_task_title,
                    'pptasks_sp_status' => $task->pptasks_sp_status,
                    'pptasks_pt_status' => $task->pptasks_pt_status,
                    'manager_email' => optional($project->manager)->email ?? null,
                    'pptasks_planner_id' => $task->pptasks_planner_id,
                ];
            })
            ->filter(fn($item) => $item['plist_projectid'] !== null)
            ->unique('plist_projectid')
            ->values();

        return view('service-partner/project_reports', compact('projects'));
    }

    public function projectFullfilledreports()
    {

        $serviceProviderId = session('sp_user_id');

        $projects = ProjectPlannerTask::with([
            'projectPlanner.projectScope.project.manager',
            'projectPlanner',
            'projectPlanner.projectScope'
        ])
            ->where('pptasks_sp_id', $serviceProviderId)
            ->where('pptasks_sp_status', 'Fullfilled')
            ->get()
            ->map(function ($task) {
                $project = optional(optional(optional($task->projectPlanner)->projectScope)->project);

                return [
                    'plist_projectid' => $project->plist_projectid ?? null,
                    'pscope_country' => $task->projectPlanner->projectScope->pscope_country ?? null,
                    'pscope_state' => $task->projectPlanner->projectScope->pscope_state ?? null,
                    'pscope_pincode' => $task->projectPlanner->projectScope->pscope_pincode ?? null,
                    'pplnr_milestone' => $task->projectPlanner->pplnr_milestone ?? null,
                    'pptasks_task_title' => $task->pptasks_task_title,
                    'pptasks_sp_status' => $task->pptasks_sp_status,
                    'pptasks_pt_status' => $task->pptasks_pt_status,
                    'manager_email' => optional($project->manager)->email ?? null,
                    'pptasks_planner_id' => $task->pptasks_planner_id,
                ];
            })
            ->filter(fn($item) => $item['plist_projectid'] !== null)
            ->unique('plist_projectid')
            ->values();

        return view('service-partner/project_reports', compact('projects'));

    }

    public function projectOnGoingReports()
    {

        $serviceProviderId = session('sp_user_id');

        $projects = ProjectPlannerTask::with([
            'projectPlanner.projectScope.project.manager',
            'projectPlanner',
            'projectPlanner.projectScope'
        ])
            ->where('pptasks_sp_id', $serviceProviderId)
            ->where('pptasks_sp_status', 'On Going')
            ->get()
            ->map(function ($task) {
                $project = optional(optional(optional($task->projectPlanner)->projectScope)->project);

                return [
                    'plist_projectid' => $project->plist_projectid ?? null,
                    'pscope_country' => $task->projectPlanner->projectScope->pscope_country ?? null,
                    'pscope_state' => $task->projectPlanner->projectScope->pscope_state ?? null,
                    'pscope_pincode' => $task->projectPlanner->projectScope->pscope_pincode ?? null,
                    'pplnr_milestone' => $task->projectPlanner->pplnr_milestone ?? null,
                    'pptasks_task_title' => $task->pptasks_task_title,
                    'pptasks_sp_status' => $task->pptasks_sp_status,
                    'pptasks_pt_status' => $task->pptasks_pt_status,
                    'manager_email' => optional($project->manager)->email ?? null,
                    'pptasks_planner_id' => $task->pptasks_planner_id,
                ];
            })
            ->filter(fn($item) => $item['plist_projectid'] !== null)
            ->unique('plist_projectid')
            ->values();

        return view('service-partner/project_reports', compact('projects'));
    }

    public function projectScrappedReports()
    {

        $serviceProviderId = session('sp_user_id');

        $projects = ProjectPlannerTask::with([
            'projectPlanner.projectScope.project.manager',
            'projectPlanner',
            'projectPlanner.projectScope'
        ])
            ->where('pptasks_sp_id', $serviceProviderId)
            ->where('pptasks_sp_status', 'Scrapped')
            ->get()
            ->map(function ($task) {
                $project = optional(optional(optional($task->projectPlanner)->projectScope)->project);

                return [
                    'plist_projectid' => $project->plist_projectid ?? null,
                    'pscope_country' => $task->projectPlanner->projectScope->pscope_country ?? null,
                    'pscope_state' => $task->projectPlanner->projectScope->pscope_state ?? null,
                    'pscope_pincode' => $task->projectPlanner->projectScope->pscope_pincode ?? null,
                    'pplnr_milestone' => $task->projectPlanner->pplnr_milestone ?? null,
                    'pptasks_task_title' => $task->pptasks_task_title,
                    'pptasks_sp_status' => $task->pptasks_sp_status,
                    'pptasks_pt_status' => $task->pptasks_pt_status,
                    'manager_email' => optional($project->manager)->email ?? null,
                    'pptasks_planner_id' => $task->pptasks_planner_id,
                ];
            })
            ->filter(fn($item) => $item['plist_projectid'] !== null)
            ->unique('plist_projectid')
            ->values();

        return view('service-partner/project_reports', compact('projects'));

    }

    public function viewSow($id)
    {

        $project = Project::findOrFail($id);

        if (!$project->plist_sow) {
            abort(404, 'No attachment found.');
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_buffer($finfo, $project->plist_sow);
        finfo_close($finfo);

        return response($project->plist_sow)
            ->header('Content-Type', $mime ?? 'application/octet-stream')
            ->header('Content-Disposition', 'inline; filename="attachment"');
    }

    public function findProjects()
    {
        $projects = Project::where('plist_status', 'No SP Assigned')->get();

        return view('service-partner/find_project', compact('projects'));
    }

    public function showProjectDetails($id)
    {
        $project = Project::where('plist_id', $id)
            ->where('plist_status', 'No SP Assigned')
            ->first();

        return view('service-partner/find_project_details', compact('project'));
    }

    public function showInterest($id, Request $request)
    {
        $serviceProvider = ServiceProvider::where('sprov_id', session('sp_user_id'))->first();

        $project = Project::where('plist_id', $id)
            ->where('plist_status', 'No SP Assigned')
            ->first();

        if ($project && $serviceProvider) {

            $request->validate([
                'sp_interest_reason' => 'required|string|max:255',
            ]);

            $reason = $request->input('sp_interest_reason');

            Mail::to('info@pseudoteam.com')->send(new SPInterestMail($serviceProvider, $project, $reason));
            return back()->with('success', 'Your interest has been sent to the project manager.');
        }

        return back()->with('error', 'Project not found or already assigned.');
    }
}