<?php

namespace App\Http\Controllers;

use App\Exports\ProjectsExport;
use App\Imports\ProjectHierarchyImport;
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
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
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

        try {
            $validated = $request->validate([
                'plist_title' => 'required|string|max:255',
                'plist_description' => 'required|string',
                'plist_sow' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,csv|max:20420',
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
        } catch (ValidationException $e) {
            // Log the validation errors
            Log::error('Validation failed', [
                'errors' => $e->errors(),
                'input' => $request->all(),
            ]);

            // Optionally re-throw to let Laravel handle it as usual (redirect back with errors)
            throw $e;
        }

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
                    // 'plist_customeremail' => $validated['plist_customeremail'],
                    'plist_customeremail' => $validated['plist_customeremail'] ?? null,
                    'plist_name' => $validated['plist_name'],
                    'plist_email' => $validated['plist_email'],
                    'plist_contact' => $validated['plist_contact'],
                    'plist_status' => $status,
                    'plist_project_status' => $projectStatus,
                    'plist_ongnew' => $validated['plist_ongnew'],
                    'plist_category' => $validated['plist_category'],
                    'plist_coupon' => $validated['plist_coupon'] ?? null,
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
                    // 'plist_customeremail' => $validated['plist_customeremail'],
                    'plist_customeremail' => $validated['plist_customeremail'] ?? null,
                    'plist_name' => $validated['plist_name'],
                    'plist_email' => $validated['plist_email'],
                    'plist_contact' => $validated['plist_contact'],
                    'plist_status' => $status,
                    'plist_project_status' => $projectStatus,
                    'plist_ongnew' => $validated['plist_ongnew'],
                    'plist_category' => $validated['plist_category'],
                    'plist_coupon' => $validated['plist_coupon'] ?? null,
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


                $email = ProjectOwners::where('pown_id', session('user_id'))->value('pown_email');

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

        if (!$customerId) {
            return redirect()->back()->with('error', 'Customer ID does not exist!');
        }

        $projects = Project::orderBy('plist_id', 'desc')
            ->where('plist_customer_id', $customerId)
            ->where('plist_status', '!=', 'Delivered')  // ← EXCLUDE delivered projects
            ->get();


        if ($projects->isEmpty()) {
            return view('customer.track_project_report', [
                'projects' => collect(),
                'totalProjects' => 0,
                'overallAverage' => 0
            ]);
        }

        Log::info("Starting bulk project progress calculation for Customer ID: {$customerId}");

        $totalProgress = 0.0;
        $projectCount = $projects->count();

        foreach ($projects as $project) {
            // compute the real project progress using the reusable function
            $projectProgress = $this->calculateProjectProgress($project->plist_id);

            // store on the model instance for the view
            $project->average_completion = $projectProgress;

            $totalProgress += $projectProgress;

            Log::info("Project ID {$project->plist_id} → Calculated progress: {$projectProgress}%");
        }

        // overall average across all fetched projects (includes zeros)
        $overallAverage = $projectCount > 0 ? ($totalProgress / $projectCount) : 0;

        return view('customer.track_project_report', [
            'projects' => $projects,
            'totalProjects' => $projectCount,
            'overallAverage' => number_format($overallAverage, 2)
        ]);
    }

    private function calculateProjectProgress($projectId): float
    {
        Log::info("calculateProjectProgress() started for Project ID: {$projectId}");

        $project_scope = ProjectScope::where('pscope_project_id', $projectId)->get();

        if ($project_scope->isEmpty()) {
            Log::warning("Project ID {$projectId} has no scopes/locations.");
            return 0.0;
        }

        $totalProjectLocationProgress = 0.0;

        foreach ($project_scope as $scope) {
            $locationId = $scope->pscope_id;
            $locationWeightage = $scope->pscope_weightage ?? 0; // percent of project
            Log::info("Location ID {$locationId} → Weightage: {$locationWeightage}%");

            $milestones = ProjectPlanner::where('pplnr_scope_id', $locationId)->get();

            if ($milestones->isEmpty()) {
                Log::info("Location ID {$locationId} has no milestones.");
                continue;
            }

            $locationMilestoneProgress = 0.0;

            // log total milestone weight (we don't normalize them)
            $totalMilestoneWeightage = $milestones->sum('pplnr_weightage');
            Log::info("Total raw milestone weight for Location ID {$locationId}: {$totalMilestoneWeightage}");

            foreach ($milestones as $milestone) {
                $milestoneWeight = $milestone->pplnr_weightage ?? 0;
                $normalizedMilestoneWeight = $milestoneWeight; // treated as absolute percent

                // tasks for this milestone
                $tasks = ProjectPlannerTask::where('pptasks_planner_id', $milestone->pplnr_id)->get();

                $totalDefinedWeightage = $tasks->sum('pptasks_weightage');
                if ($totalDefinedWeightage <= 0) {
                    // fallback to equal distribution (sum = 100)
                    $totalDefinedWeightage = 100;
                }

                $milestoneTaskProgress = 0.0;

                foreach ($tasks as $task) {
                    $taskWeight = $task->pptasks_weightage ?? 0;
                    $normalizedTaskWeight = ($taskWeight / $totalDefinedWeightage) * 100;

                    $status = strtolower(trim($task->pptasks_pt_status ?? ''));

                    // your rule: 'fullfilled'/'fulfilled' => 100, 'ongoing' => 0, default => 0
                    $taskProgress = ($status === 'fullfilled' || $status === 'fulfilled') ? 100 : 0;

                    $milestoneTaskProgress += ($normalizedTaskWeight * $taskProgress) / 100;
                }

                $milestoneProgress = round($milestoneTaskProgress, 2); // percent of milestone completed

                // weighted contribution of milestone to the location (or project depending on semantics)
                $weightedMilestoneProgress = ($milestoneProgress * $normalizedMilestoneWeight) / 100;

                $locationMilestoneProgress += $weightedMilestoneProgress;

                Log::info("Milestone ID {$milestone->pplnr_id} → Milestone Progress: {$milestoneProgress}%, Milestone Weight: {$milestoneWeight}%, WeightedContribution: " . round($weightedMilestoneProgress, 2) . "%");
            }

            // scope progress (percent)
            $scopeProgress = round($locationMilestoneProgress, 2);

            // weighted contribution of this location to the project
            $scopeWeighted = round(($scopeProgress * $locationWeightage) / 100, 2);

            $totalProjectLocationProgress += $scopeWeighted;

            Log::info("Location ID {$locationId} → Scope Progress: {$scopeProgress}%, WeightedToProject: {$scopeWeighted}%");
        }

        $final = round($totalProjectLocationProgress, 2);
        Log::info("calculateProjectProgress() finished for Project ID: {$projectId} → Final: {$final}%");

        return (float) $final;
    }

    public function trackProjectReportLocation($projectid)
    {
        // Step 1: Fetch all locations (scopes) for the given project
        $project_scope = ProjectScope::where('pscope_project_id', $projectid)->get();

        if ($project_scope->isEmpty()) {
            \Log::warning("Project ID $projectid has no locations.");
            return view('customer.track_project_report_location', [
                'project_scope' => collect(),
                'average' => 0
            ]);
        }

        \Log::info("Starting Location Progress Calculation for Project ID: $projectid");

        $totalProjectLocationProgress = 0; // final overall progress accumulator

        // Step 2: Loop through each location
        foreach ($project_scope as $scope) {
            $locationId = $scope->pscope_id;
            $locationWeightage = $scope->pscope_weightage ?? 0; // assume field for weightage exists
            \Log::info("Location ID {$locationId} → Weightage: {$locationWeightage}%");

            // Step 3: Fetch milestones under this location
            $milestones = ProjectPlanner::where('pplnr_scope_id', $locationId)->get();

            if ($milestones->isEmpty()) {
                $scope->progress = 0;
                $scope->weighted_progress = 0;
                \Log::info("Location ID {$locationId} has no milestones. Skipping progress calculation.");
                continue;
            }

            $locationMilestoneProgress = 0;

            // Log total raw milestone weight (for debugging). We do NOT normalize milestone weights.
            $totalMilestoneWeightage = $milestones->sum('pplnr_weightage');
            \Log::info("Total raw milestone weight for Location ID {$locationId}: {$totalMilestoneWeightage}");

            // Step 4: Calculate milestone-level progress for this location
            foreach ($milestones as $milestone) {
                $milestoneWeight = $milestone->pplnr_weightage ?? 0;

                // <<< IMPORTANT CHANGE >>>
                // Treat milestoneWeight as an absolute percentage (percent-of-project or percent-of-location depending on your model).
                // Do NOT normalize it by the sum of milestone weights here.
                $normalizedMilestoneWeight = $milestoneWeight;

                // Fetch tasks under this milestone to compute milestone progress
                $tasks = ProjectPlannerTask::where('pptasks_planner_id', $milestone->pplnr_id)->get();
                $totalDefinedWeightage = $tasks->sum('pptasks_weightage');
                if ($totalDefinedWeightage <= 0) {
                    $totalDefinedWeightage = 100; // fallback to equal distribution
                }

                $milestoneTaskProgress = 0;
                foreach ($tasks as $task) {
                    $taskWeight = $task->pptasks_weightage ?? 0;
                    $normalizedTaskWeight = ($taskWeight / $totalDefinedWeightage) * 100;

                    $taskProgress = match (strtolower($task->pptasks_pt_status)) {
                        'fullfilled', 'fulfilled' => 100,
                        'ongoing' => 0, //since wew are not calculating OnGoing Progress!
                        default => 0
                    };

                    $milestoneTaskProgress += ($normalizedTaskWeight * $taskProgress) / 100;
                }

                $milestoneProgress = round($milestoneTaskProgress, 2); // percent of milestone completed
                // weightedMilestoneProgress is percent contribution to the LOCATION (if milestoneWeight is percent-of-location)
                // or percent-of-project depending on how you interpret milestoneWeight. This follows your requested semantics:
                $weightedMilestoneProgress = ($milestoneProgress * $normalizedMilestoneWeight) / 100;

                $locationMilestoneProgress += $weightedMilestoneProgress;

                \Log::info(
                    "Milestone ID {$milestone->pplnr_id} → Milestone Progress: {$milestoneProgress}%," .
                    " Milestone Weight: {$milestoneWeight}%, Weighted Contribution to Location: " .
                    round($weightedMilestoneProgress, 2) . "%"
                );
            }

            // Step 5: Location’s own weighted progress
            $scope->progress = round($locationMilestoneProgress, 2); // percent (as aggregated above)
            $scope->weighted_progress = round(($scope->progress * $locationWeightage) / 100, 2); // percent contribution to project

            $totalProjectLocationProgress += $scope->weighted_progress;

            \Log::info("Location ID {$locationId} → Location Progress: {$scope->progress}%, "
                . "Weighted Contribution to Project: {$scope->weighted_progress}%");
        }

        // Step 6: Final overall location progress
        $average = round($totalProjectLocationProgress, 2);
        \Log::info("Final Project ID: $projectid → Overall Location Progress: {$average}%");

        return view('customer.track_project_report_location', compact('project_scope', 'average'));
    }
    public function trackProjectReportDetails($projectid)
    {
        // Fetch all milestones (planners) related to the project
        $project_planner = ProjectPlanner::where('pplnr_scope_id', $projectid)->get();
        $projectScope = ProjectScope::where('pscope_id', $projectid)->first();
        $comments = Comment::where('pconv_scope_id', $projectid)->get();

        if ($project_planner->isEmpty()) {
            \Log::info("Project ID $projectid has no milestones.");
            return view('customer.track_project_report_details', [
                'project_planner' => collect(),
                'project_scope' => collect(),
                'comments' => collect(),
                'average' => 0
            ]);
        }

        $totalProjectProgress = 0; // overall project progress accumulator
        \Log::info("Starting project progress calculation for Project ID: $projectid");

        foreach ($project_planner as $planner) {

            $milestoneWeightage = $planner->pplnr_weightage ?? 0;
            \Log::info("Milestone ID {$planner->pplnr_id} → Weightage: {$milestoneWeightage}%");

            $tasks = ProjectPlannerTask::where('pptasks_planner_id', $planner->pplnr_id)->get();
            $totalTasks = $tasks->count();
            \Log::info("Total tasks in Milestone {$planner->pplnr_id}: $totalTasks");

            if ($totalTasks === 0) {
                $planner->progress = 0;
                $planner->weighted_progress = 0;
                \Log::info("Milestone {$planner->pplnr_id} has no tasks. Skipping progress calculation.");
                continue;
            }

            // Step 1: Sum of user-defined task weightages
            $totalDefinedWeightage = $tasks->sum('pptasks_weightage');
            if ($totalDefinedWeightage <= 0)
                $totalDefinedWeightage = 100; // avoid divide by zero
            \Log::info("Milestone {$planner->pplnr_id} → Total defined task weightage: $totalDefinedWeightage");

            $milestoneTaskProgress = 0; // accumulator for milestone

            // Step 2: Calculate weighted task progress
            foreach ($tasks as $task) {
                $taskWeight = $task->pptasks_weightage ?? 0;
                $normalizedWeight = ($taskWeight / $totalDefinedWeightage) * 100;

                $taskProgress = match ($task->pptasks_pt_status) {
                    'Fullfilled', 'Fulfilled' => 100,
                    'Ongoing' => 0,
                    default => 0
                };

                $weightedContribution = ($normalizedWeight * $taskProgress) / 100;
                $milestoneTaskProgress += $weightedContribution;

                // Log every task calculation
                \Log::info("Task ID {$task->pptasks_id} → Status: {$task->pptasks_pt_status}, "
                    . "Original Weight: {$taskWeight}%, Normalized Weight: " . round($normalizedWeight, 2) . "%, "
                    . "Task Progress: $taskProgress%, Weighted Contribution: " . round($weightedContribution, 2) . "%");
            }

            // Step 3: Milestone progress
            $milestoneProgress = round($milestoneTaskProgress, 2);
            $weightedMilestoneProgress = ($milestoneProgress * $milestoneWeightage) / 100;
            $planner->progress = $milestoneProgress;
            $planner->weighted_progress = round($weightedMilestoneProgress, 2);

            $totalProjectProgress += $weightedMilestoneProgress;

            \Log::info("Milestone {$planner->pplnr_id} → Milestone Progress: {$milestoneProgress}%, "
                . "Weighted Contribution to Project: " . round($weightedMilestoneProgress, 2) . "%");
        }

        $average = round($totalProjectProgress, 2);
        \Log::info("Final Project ID: $projectid → Overall Progress: {$average}%");

        return view('customer.track_project_report_details', compact(
            'project_planner',
            'average',
            'projectScope',
            'comments'
        ));
    }

    public function trackProjectNotStarted()
    {
        \Log::info('track project not-started!');

        $customerId = session('user_id');

        if (!$customerId) {
            return redirect()->back()->with('error', 'Customer ID does not exist!');
        }

        // get projects with status "No SP Assigned" for this customer
        $projects = Project::where('plist_status', 'No SP Assigned')
            ->where('plist_customer_id', $customerId)
            ->orderBy('plist_id', 'desc')
            ->get();

        if ($projects->isEmpty()) {
            return view('customer.track_project_report', [
                'projects' => collect(),
                'totalProjects' => 0,
                'overallAverage' => 0
            ]);
        }

        \Log::info("Calculating progress for 'No SP Assigned' projects for Customer ID: {$customerId}");

        $totalProgress = 0.0;
        $projectCount = $projects->count();

        foreach ($projects as $project) {
            // optional logging of raw status
            $rawStatus = $project->plist_status;
            $normalizedStatus = strtolower(trim(preg_replace('/\s+/', ' ', $rawStatus)));
            \Log::info("Project ID {$project->plist_id} - Raw Status: [$rawStatus], Normalized: [$normalizedStatus]");

            // Calculate real progress using your location->milestone->task logic
            $projectProgress = $this->calculateProjectProgress($project->plist_id);

            // store on model instance for the view
            $project->average_completion = $projectProgress;

            \Log::info("Project ID {$project->plist_id} → Calculated progress: {$projectProgress}%");

            $totalProgress += $projectProgress;
        }

        // overall average across fetched projects (including zeros)
        $overallAverage = $projectCount > 0 ? ($totalProgress / $projectCount) : 0;

        $totalProjects = $projectCount;

        return view('customer.track_project_report', compact('projects', 'totalProjects', 'overallAverage'));
    }
    // public function trackProjectOnHold()
    // {
    //     \Log::info('trackProjectOnHold() started');

    //     $customerId = session('user_id');
    //     if (!$customerId) {
    //         return redirect()->back()->with('error', 'Customer ID does not exist!');
    //     }

    //     $today = now()->format('Y-m-d'); // YYYY-MM-DD for comparison

    //     $projects = Project::where('plist_customer_id', $customerId)
    //         ->where('plist_status', '!=', 'Delivered') // ← EXCLUDE delivered projects
    //         ->where(function ($q) use ($today) {
    //             $q->where('plist_project_status', 'Hold')
    //                 ->orWhereRaw("STR_TO_DATE(TRIM(plist_enddate), '%d-%m-%Y') < ?", [$today]);
    //         })
    //         ->orderBy('plist_id', 'desc')
    //         ->get();


    //     if ($projects->isEmpty()) {
    //         \Log::info("No ON HOLD / expired projects found for customer {$customerId}");
    //         return view('customer.track_project_report', [
    //             'projects' => collect(),
    //             'totalProjects' => 0,
    //             'overallAverage' => 0
    //         ]);
    //     }

    //     // Simple fallback mapping (used only when no scopes/milestones exist)
    //     $statusProgressMap = [
    //         'delivered' => 100,
    //         'in progress' => 50,
    //         'no sp assigned' => 0,
    //         // other statuses are treated as unknown and fallback to 0
    //     ];

    //     $totalProgress = 0.0;
    //     $projectCount = $projects->count();

    //     foreach ($projects as $project) {
    //         \Log::info("Processing Project ID {$project->plist_id} (raw status: {$project->plist_status})");

    //         // Primary: compute full project progress via locations->milestones->tasks
    //         $projectProgress = $this->calculateProjectProgress($project->plist_id);

    //         // Fallback: if the project has no scopes/milestones (progress is 0),
    //         // attempt to map by status (so "Hold" or other statuses can show something).
    //         if ($projectProgress <= 0) {
    //             $rawStatus = $project->plist_status ?? '';
    //             $normalizedStatus = strtolower(trim(preg_replace('/\s+/', ' ', $rawStatus)));

    //             if (isset($statusProgressMap[$normalizedStatus])) {
    //                 $projectProgress = $statusProgressMap[$normalizedStatus];
    //                 \Log::info("Project ID {$project->plist_id} — using status fallback: {$normalizedStatus} => {$projectProgress}%");
    //             } else {
    //                 \Log::info("Project ID {$project->plist_id} — no scopes and unknown status '{$rawStatus}', progress remains 0");
    //             }
    //         } else {
    //             \Log::info("Project ID {$project->plist_id} — calculated progress: {$projectProgress}%");
    //         }

    //         // Attach to model for the view
    //         $project->average_completion = round($projectProgress, 2);

    //         $totalProgress += $projectProgress;
    //     }

    //     // overall average across all fetched projects (includes zeros/fallbacks)
    //     $overallAverage = $projectCount > 0 ? ($totalProgress / $projectCount) : 0;
    //     $overallAverage = round($overallAverage, 2);

    //     \Log::info("Customer ID {$customerId} — OnHold/Expired Projects: {$projectCount} — Overall Average: {$overallAverage}%");

    //     return view('customer.track_project_report', [
    //         'projects' => $projects,
    //         'totalProjects' => $projectCount,
    //         'overallAverage' => number_format($overallAverage, 2)
    //     ]);
    // }

    public function trackProjectOnHold()
    {
        \Log::info('trackProjectOnHold() started');

        $customerId = session('user_id');

        if (!$customerId) {
            return redirect()->back()->with('error', 'Customer ID does not exist!');
        }

        $today = now()->format('Y-m-d');

        // Filter: ON HOLD or expired projects
        $projects = Project::where('plist_customer_id', $customerId)
            ->where('plist_status', '!=', 'Delivered')
            ->where(function ($q) use ($today) {
                $q->where('plist_project_status', 'Hold')
                    ->orWhereRaw("STR_TO_DATE(TRIM(plist_enddate), '%d-%m-%Y') < ?", [$today]);
            })
            ->orderBy('plist_id', 'desc')
            ->get();

        if ($projects->isEmpty()) {
            return view('customer.track_project_report', [
                'projects' => collect(),
                'totalProjects' => 0,
                'overallAverage' => 0
            ]);
        }

        \Log::info("Starting ON HOLD project calculation for Customer ID: {$customerId}");

        $totalProgress = 0.0;
        $projectCount = $projects->count();

        foreach ($projects as $project) {

            // SAME logic as trackProjects()
            $projectProgress = $this->calculateProjectProgress($project->plist_id);

            $project->average_completion = round($projectProgress, 2);

            $totalProgress += $projectProgress;

            \Log::info("Project ID {$project->plist_id} → Progress: {$projectProgress}%");
        }

        $overallAverage = $projectCount > 0 ? ($totalProgress / $projectCount) : 0;

        return view('customer.track_project_report', [
            'projects' => $projects,
            'totalProjects' => $projectCount,
            'overallAverage' => number_format($overallAverage, 2)
        ]);
    }

    // public function trackProjectInProgress()
    // {
    //     \Log::info('trackProjectInProgress() started');

    //     $customerId = session('user_id');
    //     if (!$customerId) {
    //         return redirect()->back()->with('error', 'Customer ID does not exist!');
    //     }

    //     // Fetch projects with status "In Progress" for this customer
    //     $projects = Project::where('plist_status', 'In Progress')
    //         ->where('plist_customer_id', $customerId)
    //         ->orderBy('plist_id', 'desc')
    //         ->get();

    //     if ($projects->isEmpty()) {
    //         \Log::info("No 'In Progress' projects found for customer {$customerId}");
    //         return view('customer.track_project_report', [
    //             'projects' => collect(),
    //             'totalProjects' => 0,
    //             'overallAverage' => 0
    //         ]);
    //     }

    //     // Fallback mapping (used only when no scopes/milestones exist)
    //     $statusProgressMap = [
    //         'delivered' => 100,
    //         'in progress' => 50,
    //         'no sp assigned' => 0,
    //     ];

    //     $totalProgress = 0.0;
    //     $projectCount = $projects->count();

    //     foreach ($projects as $project) {
    //         \Log::info("Processing Project ID {$project->plist_id} (raw status: {$project->plist_status})");

    //         // Primary: calculate full progress using scopes -> milestones -> tasks
    //         $projectProgress = $this->calculateProjectProgress($project->plist_id);

    //         // Fallback to status-based progress if calculateProjectProgress returned 0
    //         if ($projectProgress <= 0) {
    //             $rawStatus = $project->plist_status ?? '';
    //             $normalizedStatus = strtolower(trim(preg_replace('/\s+/', ' ', $rawStatus)));

    //             if (isset($statusProgressMap[$normalizedStatus])) {
    //                 $projectProgress = $statusProgressMap[$normalizedStatus];
    //                 \Log::info("Project ID {$project->plist_id} — using status fallback: {$normalizedStatus} => {$projectProgress}%");
    //             } else {
    //                 \Log::info("Project ID {$project->plist_id} — no scopes and unknown status '{$rawStatus}', progress remains 0");
    //             }
    //         } else {
    //             \Log::info("Project ID {$project->plist_id} — calculated progress: {$projectProgress}%");
    //         }

    //         // Attach to model instance for the view
    //         $project->average_completion = round($projectProgress, 2);

    //         $totalProgress += $projectProgress;
    //     }

    //     // overall average across all fetched projects (includes zeros/fallbacks)
    //     $overallAverage = $projectCount > 0 ? ($totalProgress / $projectCount) : 0;
    //     $overallAverage = round($overallAverage, 2);

    //     \Log::info("Customer ID {$customerId} — In Progress Projects: {$projectCount} — Overall Average: {$overallAverage}%");

    //     return view('customer.track_project_report', [
    //         'projects' => $projects,
    //         'totalProjects' => $projectCount,
    //         'overallAverage' => number_format($overallAverage, 2)
    //     ]);
    // }

    public function trackProjectInProgress()
    {
        \Log::info('trackProjectInProgress() started');

        $customerId = session('user_id');

        if (!$customerId) {
            return redirect()->back()->with('error', 'Customer ID does not exist!');
        }

        // Only "In Progress" projects
        $projects = Project::where('plist_customer_id', $customerId)
            ->where('plist_status', 'In Progress')
            ->orderBy('plist_id', 'desc')
            ->get();

        if ($projects->isEmpty()) {
            return view('customer.track_project_report', [
                'projects' => collect(),
                'totalProjects' => 0,
                'overallAverage' => 0
            ]);
        }

        \Log::info("Starting IN-PROGRESS project calculation for Customer ID: {$customerId}");

        $totalProgress = 0.0;
        $projectCount = $projects->count();

        foreach ($projects as $project) {

            // SAME logic as trackProjects()
            $projectProgress = $this->calculateProjectProgress($project->plist_id);

            // attach to model
            $project->average_completion = round($projectProgress, 2);

            $totalProgress += $projectProgress;

            \Log::info("Project ID {$project->plist_id} → Progress: {$projectProgress}%");
        }

        $overallAverage = $projectCount > 0 ? ($totalProgress / $projectCount) : 0;

        return view('customer.track_project_report', [
            'projects' => $projects,
            'totalProjects' => $projectCount,
            'overallAverage' => number_format($overallAverage, 2)
        ]);
    }

    public function trackProjectDelivered()
    {
        \Log::info('trackProjectDelivered() started');

        $customerId = session('user_id');
        if (!$customerId) {
            return redirect()->back()->with('error', 'Customer ID does not exist!');
        }

        // Fetch projects with status "Delivered" for this customer
        $projects = Project::where('plist_status', 'Delivered')
            ->where('plist_customer_id', $customerId)
            ->orderBy('plist_id', 'desc')
            ->get();

        // If no delivered projects -> return view with empty collection and flag=false
        if ($projects->isEmpty()) {
            \Log::info("No 'Delivered' projects found for customer {$customerId}");
            return view('customer.track_project_report', [
                'projects' => collect(),
                'totalProjects' => 0,
                'overallAverage' => 0,
                'showDeliveredColumn' => false,
            ]);
        }

        // Fallback mapping (used only when no scopes/milestones exist)
        $statusProgressMap = [
            'delivered' => 100,
            'in progress' => 50,
            'no sp assigned' => 0,
        ];

        $totalProgress = 0.0;
        $projectCount = $projects->count();

        foreach ($projects as $project) {
            \Log::info("Processing Project ID {$project->plist_id} (raw status: {$project->plist_status})");

            // Primary: calculate full project progress using scopes -> milestones -> tasks
            $projectProgress = $this->calculateProjectProgress($project->plist_id);

            // Fallback to status-based progress if calculateProjectProgress returned 0
            if ($projectProgress <= 0) {
                $rawStatus = $project->plist_status ?? '';
                $normalizedStatus = strtolower(trim(preg_replace('/\s+/', ' ', $rawStatus)));

                if (isset($statusProgressMap[$normalizedStatus])) {
                    $projectProgress = $statusProgressMap[$normalizedStatus];
                    \Log::info("Project ID {$project->plist_id} — using status fallback: {$normalizedStatus} => {$projectProgress}%");
                } else {
                    \Log::info("Project ID {$project->plist_id} — no scopes and unknown status '{$rawStatus}', progress remains 0");
                }
            } else {
                \Log::info("Project ID {$project->plist_id} — calculated progress: {$projectProgress}%");
            }

            // Attach to model instance for the view
            $project->average_completion = round($projectProgress, 2);

            // Normalize delivered-on field presence so Blade won't throw undefined property errors.
            // We expect your DB column name is `plist_delivered_on`.
            $project->plist_delivered_on = $project->plist_delivered_on ?? null;

            $totalProgress += $projectProgress;
        }

        // overall average across all fetched projects (includes zeros/fallbacks)
        $overallAverage = $projectCount > 0 ? ($totalProgress / $projectCount) : 0;
        $overallAverage = round($overallAverage, 2);

        \Log::info("Customer ID {$customerId} — Delivered Projects: {$projectCount} — Overall Average: {$overallAverage}%");

        return view('customer.track_project_report', [
            'projects' => $projects,
            'totalProjects' => $projectCount,
            'overallAverage' => number_format($overallAverage, 2),
            // show delivered-on column because this method returns the delivered view
            'showDeliveredColumn' => true,
        ]);
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

        if ($projects->isEmpty()) {
            // return redirect()->back()->with('error', 'No Projects Found!');
            return view('customer.track_project_report', [
                'projects' => collect(),              // Empty collection
                'totalProjects' => 0,
                'overallAverage' => 0
            ]);
        }

        // Define normalized status => progress
        $statusProgressMap = [
            'delivered' => 100,
            'in progress' => 50,
            'no sp assigned' => 0,
            // 'cancelled' and any others are excluded
        ];

        $totalProgress = 0;
        $validProjects = 0;

        foreach ($projects as $project) {
            // Normalize the status: lowercase, trimmed, single spaces
            $rawStatus = $project->plist_status;
            $normalizedStatus = strtolower(trim(preg_replace('/\s+/', ' ', $rawStatus)));

            \Log::info("Project ID {$project->plist_id} - Raw Status: [$rawStatus], Normalized: [$normalizedStatus]");

            if (!isset($statusProgressMap[$normalizedStatus])) {
                \Log::warning("Project ID {$project->plist_id} skipped — Unknown status: [$normalizedStatus]");
                continue;
            }

            $progress = $statusProgressMap[$normalizedStatus];
            $totalProgress += $progress;
            $validProjects++;
        }

        // Calculate average only if we have valid projects
        $overallAverage = $validProjects > 0 ? ($totalProgress / $validProjects) : 0;

        $totalProjects = $validProjects;

        return view('customer.track_project_report', compact('projects', 'totalProjects', 'overallAverage'));
    }

    // public function projectTimeline($pplnr_id)
    // {
    //     $projectTimeline = ProjectPlannerTask::where('pptasks_planner_id', $pplnr_id)->get();

    //     if ($projectTimeline->isEmpty()) {
    //         return redirect()->back()->with('error', 'ProjectTimeline not found.');
    //     }

    //     $totalProgress = 0;

    //     foreach ($projectTimeline as $task) {
    //         // Each task's weightage (default to 0 if not defined)
    //         $taskWeightage = $task->pptasks_weightage ?? 0;

    //         // Task progress
    //         $taskProgress = 0;
    //         if ($task->pptasks_pt_status === 'Fullfilled') {
    //             $taskProgress = 100;
    //         } elseif ($task->pptasks_pt_status === 'Ongoing') {
    //             $taskProgress = 0; //since we are not calculating ongoing points, We are only calculating fullfilled tasks progrerss!
    //         }

    //         // Weighted contribution
    //         $weightedProgress = ($taskProgress * $taskWeightage) / 100;

    //         // Add to total
    //         $totalProgress += $weightedProgress;

    //         // Optional: store for view
    //         $task->progress = $taskProgress;
    //         $task->weighted_progress = $weightedProgress;
    //     }

    //     $overallProgress = round($totalProgress, 2);

    //     return view('customer.project_timeline', compact('projectTimeline', 'overallProgress'));
    // }


    public function projectTimeline($pplnr_id)
    {
        $projectTimeline = ProjectPlannerTask::where(
            'pptasks_planner_id',
            $pplnr_id
        )->get();

        if ($projectTimeline->isEmpty()) {
            return redirect()
                ->back()
                ->with('error', 'Project Timeline not found.');
        }

        $totalProgress = 0;

        foreach ($projectTimeline as $task) {

            $taskWeightage = $task->pptasks_weightage ?? 0;

            $taskProgress = 0;

            if ($task->pptasks_pt_status === 'Fullfilled') {
                $taskProgress = 100;
            } elseif ($task->pptasks_pt_status === 'Ongoing') {
                $taskProgress = 0;
            }

            $weightedProgress =
                ($taskProgress * $taskWeightage) / 100;

            $totalProgress += $weightedProgress;

            $task->progress = $taskProgress;
            $task->weighted_progress = $weightedProgress;

            // APPROVED COMMENTS

            $task->approved_comments = DB::table('task_conversation')
                ->leftJoin(
                    'weusers',
                    'task_conversation.tconv_comment_by_pt_id',
                    '=',
                    'weusers.id'
                )
                ->leftJoin(
                    'service_providers',
                    'task_conversation.tconv_comment_by_sp_id',
                    '=',
                    'service_providers.sprov_id'
                )
                ->where(
                    'task_conversation.tconv_task_id',
                    $task->pptasks_id
                )
                ->where(
                    'task_conversation.tconv_approved',
                    1
                )
                ->select(
                    'task_conversation.*',
                    'weusers.username',
                    'service_providers.sprov_name'
                )
                ->orderBy(
                    'task_conversation.tconv_id',
                    'desc'
                )
                ->get();
        }

        $overallProgress = round($totalProgress, 2);

        return view(
            'customer.project_timeline',
            compact(
                'projectTimeline',
                'overallProgress'
            )
        );
    }

    public function downloadProofOfCompletion($pptasks_id)
{
    $task = ProjectPlannerTask::where(
        'pptasks_id',
        $pptasks_id
    )->first();

    // Task not found
    if (!$task) {
        abort(404, 'Task not found.');
    }

    // POC is not approved
    if ((int) $task->pptasks_proof_completion_approved !== 1) {
        abort(403, 'Proof of Completion has not been approved.');
    }

    // POC does not exist
    if (
        empty($task->pptasks_proof_of_completion)
    ) {
        abort(404, 'Proof of Completion not found.');
    }

    return response()->streamDownload(
        function () use ($task) {
            echo $task->pptasks_proof_of_completion;
        },
        'proof-of-completion-' . $task->pptasks_id,
        [
            'Content-Type' => 'application/octet-stream',
        ]
    );
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

    public function comprehensive()
    {

        $userId = session('user_id');

        // Fetch projects belonging to this user
        $projects = Project::where('plist_customer_id', $userId)->get();

        // Count projects by status for this user
        $notStarted = Project::where('plist_customer_id', $userId)
            ->where('plist_status', 'Not Started')
            ->count();

        $onHold = Project::where('plist_customer_id', $userId)
            ->where('plist_project_status', 'Hold')
            ->count();

        $progress = Project::where('plist_customer_id', $userId)
            ->where('plist_status', 'In Progress')
            ->count();

        $delivered = Project::where('plist_customer_id', $userId)
            ->where('plist_status', 'Delivered')
            ->count();

        // Load PDF view with filtered data
        $pdf = PDF::loadView('customer.comprehensive-report', compact(
            'projects',
            'notStarted',
            'onHold',
            'progress',
            'delivered'
        ));

        // Download PDF
        return $pdf->download("comprehensive-report-user-{$userId}.pdf");
    }

    public function individual(Request $request)
    {
        $request->validate([
            'project_id' => 'required|integer',
        ]);

        Log::info("==== FETCH PROJECT REPORT STARTED ====");
        Log::info("Request project_id: " . $request->project_id);

        // 1. FETCH PROJECT
        $project = DB::table('project_list')
            ->where('plist_id', $request->project_id)
            ->first();

        Log::info("Fetched project:", (array) $project);

        if (!$project) {
            Log::error("Project not found with ID: " . $request->project_id);
            abort(404, 'Project not found');
        }

        // 2. FETCH LOCATIONS
        $locations = DB::table('project_scope')
            ->where('pscope_project_id', $project->plist_id)
            ->get();

        Log::info("Fetched locations:", $locations->toArray());

        // 3. NEST: locations → milestones → tasks
        foreach ($locations as $location) {

            Log::info("Processing location:", (array) $location);

            // Fetch milestones under location
            $milestones = DB::table('project_planner')
                ->where('pplnr_scope_id', $location->pscope_id)
                ->get();

            Log::info("Fetched milestones for location {$location->pscope_id}:", $milestones->toArray());

            foreach ($milestones as $milestone) {

                Log::info("Processing milestone:", (array) $milestone);

                // Fetch tasks under milestone
                $tasks = DB::table('project_planner_tasks') // correct table name
                    ->where('pptasks_planner_id', $milestone->pplnr_id)
                    ->get();

                Log::info("Fetched tasks for milestone {$milestone->pplnr_id}:", $tasks->toArray());

                $milestone->tasks = $tasks;
            }

            $location->milestones = $milestones;
        }

        // Attach nested structure
        $project->locations = $locations;

        Log::info("Final nested project structure:", (array) $project);

        Log::info("==== FETCH PROJECT REPORT COMPLETED ====");

        // 4. LOAD PDF VIEW
        $pdf = Pdf::loadView('customer.project_report_pdf', [
            'project' => $project
        ]);

        $filename = 'project-report-' . $project->plist_id . '.pdf';

        return $pdf->download($filename);
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

    // public function manageprojectLocation($projectId)
    // {

    //     $project_scope = ProjectScope::where('pscope_project_id', $projectId)->get();

    //     \Log::info('log : ' . print_r($project_scope->toArray(), true));

    //     if (!$project_scope) {
    //         return redirect()->route('service-partner.dashboard')->with('error', 'Project not found.');
    //     }

    //     return view('service-partner.manage_project_location', compact('project_scope'));

    // }

    public function manageProjectLocation($projectId)
    {
        $serviceProviderId = session('sp_user_id');

        // Fetch tasks associated with the service provider
        $projectScopes = ProjectPlannerTask::with([
            'projectPlanner.projectScope' // get the projectScope linked through planner
        ])
            ->where('pptasks_sp_id', $serviceProviderId)
            ->get()
            // Map to the related projectScope
            ->map(function ($task) {
                return optional($task->projectPlanner)->projectScope;
            })
            // Filter out nulls
            ->filter()
            // Only keep scopes related to the requested project
            ->filter(function ($scope) use ($projectId) {
                return $scope && $scope->pscope_project_id == $projectId;
            })
            // Remove duplicates and reindex
            ->unique('pscope_id')
            ->values();

        if ($projectScopes->isEmpty()) {
            return redirect()->route('service-partner.dashboard')->with('error', 'Project not found or not accessible.');
        }

        return view('service-partner.manage_project_location', [
            'project_scope' => $projectScopes
        ]);
    }


    // public function manageProjectdetails($pscopeId)
    // {

    //     $projectPlanner = ProjectPlanner::where('pplnr_scope_id', $pscopeId)->get();

    //     if (!$projectPlanner) {

    //         return redirect()->back()->with('error', 'Not found!');

    //     }

    //     \Log::info('pplnr' . $projectPlanner);

    //     return view('/service-partner/manage_project_details', compact('projectPlanner'));

    // }

    public function manageProjectdetails($pscopeId)
    {
        $serviceProviderId = session('sp_user_id');

        // Start from ProjectPlannerTask and backtrack to ProjectPlanner
        $projectPlanners = ProjectPlannerTask::with('projectPlanner')
            ->where('pptasks_sp_id', $serviceProviderId)
            ->get()
            // Map to related projectPlanner
            ->map(function ($task) {
                return $task->projectPlanner;
            })
            // Filter out nulls
            ->filter()
            // Filter only planners matching the given scope ID
            ->filter(function ($planner) use ($pscopeId) {
                return $planner && $planner->pplnr_scope_id == $pscopeId;
            })
            // Remove duplicates and reindex
            ->unique('pplnr_id')
            ->values();

        if ($projectPlanners->isEmpty()) {
            return redirect()->back()->with('error', 'Project planner not found or not accessible.');
        }

        \Log::info('Filtered Project Planners: ' . print_r($projectPlanners->toArray(), true));

        return view('service-partner.manage_project_details', [
            'projectPlanner' => $projectPlanners
        ]);
    }


    // public function manageProjectViewTasks($plannerId)
    // {

    //     $projectPlannerTasks = ProjectPlannerTask::where('pptasks_planner_id', $plannerId)->get();

    //     if (!$projectPlannerTasks) {

    //         return redirect()->back()->with('error', 'Project Planner Tasks Not Found!');

    //     }

    //     return view('service-partner/manage_project_view_tasks', compact('projectPlannerTasks'));

    // }

    public function manageProjectViewTasks($plannerId)
    {
        $serviceProviderId = session('sp_user_id');

        // Fetch tasks that belong to the given planner AND the logged-in SP
        $projectPlannerTasks = ProjectPlannerTask::where('pptasks_sp_id', $serviceProviderId)
            ->where('pptasks_planner_id', $plannerId)
            ->get();

        \Log::info("projectPlannertask", [$projectPlannerTasks]);

        if ($projectPlannerTasks->isEmpty()) {
            return redirect()->back()->with('error', 'Project Planner Tasks Not Found or Not Accessible!');
        }

        return view('service-partner.manage_project_view_tasks', compact('projectPlannerTasks'));
    }


    // public function manageProjectEditTasks($ppTaskId)
    // {

    //     $task = ProjectPlannerTask::with([
    //         'projectPlanner.projectScope.project'
    //     ])
    //         ->where('pptasks_id', $ppTaskId)
    //         ->first();

    //     $projectPlannerTasks = optional(optional($task->projectPlanner)->projectScope)->project;

    //     $currentDate = Carbon::now()->format('d-m-Y');

    //     if (!$projectPlannerTasks) {

    //         return redirect()->back()->with('error', 'Project Planner Tasks Not Found!');

    //     }

    //     $SpComments = SpComment::where('tconv_task_id', $ppTaskId)
    //         ->orderBy('tconv_comment_date_time', 'desc')
    //         ->get();

    //     if ($SpComments->isNotEmpty()) {
    //         $sp_id = $SpComments->first()->tconv_comment_by_sp_id;
    //     }

    //     return view('service-partner/manage_project_edit_task', compact('projectPlannerTasks', 'task', 'currentDate', 'SpComments'));

    // }

public function manageProjectEditTasks($ppTaskId)
{
    $task = ProjectPlannerTask::with([
        'projectPlanner.projectScope.project'
    ])
        ->where('pptasks_id', $ppTaskId)
        ->first();

    $projectPlannerTasks = optional(
        optional($task?->projectPlanner)->projectScope
    )->project;

    $currentDate = Carbon::now()->format('d-m-Y');

    if (!$projectPlannerTasks) {
        return redirect()->back()->with(
            'error',
            'Project Planner Tasks Not Found!'
        );
    }

    // Get all comments for this task
    $SpComments = SpComment::where('tconv_task_id', $ppTaskId)
        ->orderBy('tconv_comment_date_time', 'desc')
        ->get();

    // Get SP IDs from the comments
    $spIds = $SpComments
        ->pluck('tconv_comment_by_sp_id')
        ->filter()
        ->unique()
        ->values();

    // Get SP names from service_provider table
    $spNames = DB::table('service_providers')
        ->whereIn('sprov_id', $spIds)
        ->pluck('sprov_name', 'sprov_id');

    // Add SP name to each comment
    foreach ($SpComments as $comment) {

        $comment->sp_name = $spNames[
            $comment->tconv_comment_by_sp_id
        ] ?? 'Unknown User';

    }

    return view(
        'service-partner/manage_project_edit_task',
        compact(
            'projectPlannerTasks',
            'task',
            'currentDate',
            'SpComments'
        )
    );
}


    // public function updateTask(Request $request)
    // {

    //     \Log::info('Request Data: ' . print_r($request->all(), true));

    //     ini_set('upload_max_filesize', '100M');
    //     ini_set('post_max_size', '100M');
    //     ini_set('memory_limit', '256M');
    //     ini_set('max_execution_time', '300');
    //     ini_set('max_input_time', '300');

    //     $request->validate([
    //         'pptasks_id' => 'required|exists:project_planner_tasks,pptasks_id',
    //         'pptasks_sp_status' => 'required|string',
    //         // 'pptasks_proof_of_completion' => 'nullable|file|mimes:pdf,csv,xlsx|max:20480',
    //         'pptasks_proof_of_completion' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,csv|max:20480',
    //     ]);

    //     $task = ProjectPlannerTask::find($request->pptasks_id);
    //     $task->pptasks_sp_status = $request->pptasks_sp_status;

    //     if ($request->hasFile('pptasks_proof_of_completion')) {

    //         $file = $request->file('pptasks_proof_of_completion');
    //         $task->pptasks_proof_of_completion = file_get_contents($file->getRealPath());

    //     }

    //     \Log::info('Request Data: ' . print_r($request->all(), true));

    //     $currentTime = Carbon::now('Asia/Kolkata');

    //     $up = $currentTime->format('d-m-Y H:i:s'); // 20-07-2025 15:17:03

    //     // $task->pptasks_date_of_completion = $currentTime->format('d-m-y'); // e.g., 20-07-25
    //     $task->updated_at = $up;

    //     $task->save();

    //     return redirect()->back()->with('success', 'Task updated successfully!');
    // }

    public function updateTask(Request $request)
    {
        // Log request data except file to avoid large logs
        Log::info('Request Data: ' . print_r($request->except('pptasks_proof_of_completion'), true));

        // Increase PHP limits for large uploads (make sure php.ini matches these as well)
        ini_set('upload_max_filesize', '100M');
        ini_set('post_max_size', '100M');
        ini_set('memory_limit', '256M');
        ini_set('max_execution_time', '300');
        ini_set('max_input_time', '300');

        // Validate inputs and file
        $request->validate([
            'pptasks_id' => 'required|exists:project_planner_tasks,pptasks_id',
            'pptasks_sp_status' => 'required|string',
            'pptasks_proof_of_completion' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,csv|max:20480', // max 20MB
        ]);

        // Find task
        $task = ProjectPlannerTask::find($request->pptasks_id);

        // Update status
        $task->pptasks_sp_status = $request->pptasks_sp_status;

        // If file uploaded, read contents as binary and save in BLOB column
        if ($request->hasFile('pptasks_proof_of_completion')) {
            $file = $request->file('pptasks_proof_of_completion');

            // Read file content
            $fileContent = file_get_contents($file->getRealPath());

            // Log file content size for debugging
            Log::info('File content size in bytes: ' . strlen($fileContent));

            // Save raw binary data to DB
            $task->pptasks_proof_of_completion = $fileContent;
        }

        // Save task, Laravel handles timestamps automatically
        $task->save();

        Log::info('Task updated successfully with ID: ' . $task->pptasks_id);

        return redirect()->back()->with('success', 'Task updated successfully!');
    }

    // public function listOfProjects()
    // {

    //     $serviceProviderId = session('sp_user_id');

    //     $projects = ProjectPlannerTask::with([
    //         'projectPlanner.projectScope.project.manager',
    //         'projectPlanner',
    //         'projectPlanner.projectScope'
    //     ])
    //         ->where('pptasks_sp_id', $serviceProviderId)
    //         ->get()
    //         ->map(function ($task) {
    //             $project = optional(optional(optional($task->projectPlanner)->projectScope)->project);

    //             return [
    //                 'plist_projectid' => $project->plist_projectid ?? null,
    //                 'pscope_country' => $task->projectPlanner->projectScope->pscope_country ?? null,
    //                 'pscope_state' => $task->projectPlanner->projectScope->pscope_state ?? null,
    //                 'pscope_pincode' => $task->projectPlanner->projectScope->pscope_pincode ?? null,
    //                 'pplnr_milestone' => $task->projectPlanner->pplnr_milestone ?? null,
    //                 'pptasks_task_title' => $task->pptasks_task_title,
    //                 'pptasks_sp_status' => $task->pptasks_sp_status,
    //                 'pptasks_pt_status' => $task->pptasks_pt_status,
    //                 'manager_email' => optional($project->manager)->email ?? null,
    //                 'pptasks_planner_id' => $task->pptasks_planner_id,
    //             ];
    //         })
    //         ->filter(fn($item) => $item['plist_projectid'] !== null)
    //         ->unique('plist_projectid')
    //         ->values();


    //     if ($projects) {

    //         return view('/service-partner/all_projects', compact('projects'));

    //     }

    //     return redirect()->back()->with('error', 'Project not found!');

    // }

    // public function listOfProjects()
    // {
    //     $serviceProviderId = session('sp_user_id');

    //     $projects = ProjectPlannerTask::with([
    //         'projectPlanner.projectScope.project.manager'
    //     ])
    //         ->where('pptasks_sp_id', $serviceProviderId)
    //         ->get()
    //         ->map(function ($task) {

    //             $planner = $task->projectPlanner;
    //             $scope = $planner?->projectScope;
    //             $project = $scope?->project;
    //             $manager = $project?->manager;

    //             return [
    //                 'project_id' => $project?->plist_projectid,
    //                 'project_title' => $project?->plist_title,

    //                 'location' => implode(', ', array_filter([
    //                     $scope?->pscope_country,
    //                     $scope?->pscope_state,
    //                     $scope?->pscope_city,
    //                     $scope?->pscope_pincode,
    //                 ])),

    //                 'milestone' => $planner?->pplnr_milestone,
    //                 'sp_status' => $task->pptasks_sp_status,
    //                 'pt_status' => $task->pptasks_pt_status,
    //                 'manager_email' => $manager?->email,
    //             ];
    //         })
    //         ->filter(function ($item) {
    //             return $item['project_id'] !== null;
    //         })
    //         // ->unique('project_id')
    //         ->values();

    //     return view('/service-partner/all_projects', compact('projects'));
    // }


public function listOfProjects()
{
    $serviceProviderId = session('sp_user_id');

    $projects = ProjectPlannerTask::with([
        'projectPlanner.projectScope.project.manager'
    ])
    ->where('pptasks_sp_id', $serviceProviderId)
    ->get()
    ->map(function ($task) {

        $planner = $task->projectPlanner;
        $scope = $planner?->projectScope;
        $project = $scope?->project;
        $manager = $project?->manager;

        return [
            // Project information
            'project_id' => $project?->plist_projectid,
            'project_title' => $project?->plist_title,

            // Location
            'location' => implode(', ', array_filter([
                $scope?->pscope_country,
                $scope?->pscope_state,
                $scope?->pscope_city,
                $scope?->pscope_pincode,
            ])),

            // Planner information
            'milestone' => $planner?->pplnr_milestone,

            // Task status
            'sp_status' => $task->pptasks_sp_status,
            'pt_status' => $task->pptasks_pt_status,

            // Manager
            'manager_email' => $manager?->email,

            // IMPORTANT: keep planner ID for each row
            'pptasks_planner_id' => $task->pptasks_planner_id,
        ];
    })
    ->filter(function ($item) {
        return $item['project_id'] !== null;
    })
    ->values();

    return view('/service-partner/all_projects', compact('projects'));
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


    // public function downloadSow($id)
    // {
    //     $project = Project::findOrFail($id);

    //     if (empty($project->plist_sow)) {
    //         abort(404, 'Scope of Work file not found.');
    //     }

    //     return response($project->plist_sow)
    //         ->header('Content-Type', 'application/octet-stream') // Generic file type
    //         ->header('Content-Disposition', 'attachment; filename="scope_of_work.pdf"') // Set a default filename
    //         ->header('Content-Length', strlen($project->plist_sow));
    // }

    // public function downloadSow($id)
    // {
    //     $project = Project::findOrFail($id);

    //     if (empty($project->plist_sow)) {
    //         abort(404, 'Scope of Work file not found.');
    //     }

    //     // Try to guess MIME type
    //     $finfo = finfo_open(FILEINFO_MIME_TYPE);
    //     $mime = finfo_buffer($finfo, $project->plist_sow);
    //     finfo_close($finfo);

    //     return response($project->plist_sow)
    //         ->header('Content-Type', $mime ?: 'application/octet-stream')
    //         ->header('Content-Disposition', 'attachment; filename="scope_of_work"')
    //         ->header('Content-Length', strlen($project->plist_sow));
    // }

    public function downloadSow($id)
    {
        $project = Project::findOrFail($id);

        if (empty($project->plist_sow)) {
            abort(404, 'Scope of Work file not found.');
        }

        // Guess MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_buffer($finfo, $project->plist_sow);
        finfo_close($finfo);

        // Map MIME to file extension
        $mimeToExt = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'application/pdf' => 'pdf',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'text/csv' => 'csv',
        ];

        $extension = $mimeToExt[$mime] ?? 'bin'; // fallback to .bin if unknown
        $downloadFilename = 'scope_of_work.' . $extension;

        return response($project->plist_sow)
            ->header('Content-Type', $mime ?: 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="' . $downloadFilename . '"')
            ->header('Content-Length', strlen($project->plist_sow));
    }

    public function getProofOfCompletion($taskId)
    {
        $task = ProjectPlannerTask::findOrFail($taskId);

        if (!$task->pptasks_proof_of_completion) {
            return response('No file found', 404);
        }

        // Detect MIME using finfo
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->buffer($task->pptasks_proof_of_completion) ?? 'application/octet-stream';

        return response($task->pptasks_proof_of_completion)
            ->header('Content-Type', $mime);
    }


    public function appTrackProjects()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized. Please login again.'
            ], 401);
        }

        $customerId = ProjectOwners::where('pown_email', $user->email)
            ->value('pown_id');

        \Log::info('Customer ID: ' . $customerId);

        if (!$customerId) {
            return response()->json([
                'status' => false,
                'message' => 'Customer ID does not exist!'
            ], 401);
        }

        // $projects = Project::where('plist_customer_id', $customerId)
        //     ->where('plist_status', '!=', 'Delivered')
        //     ->orderByDesc('plist_id')
        //     ->get();


        $projects = Project::where('plist_customer_id', $customerId)
            ->orderByDesc('plist_id')
            ->get();

        if ($projects->isEmpty()) {
            return response()->json([
                'status' => true,
                'projects' => [],
                'totalProjects' => 0,
                'overallAverage' => 0
            ]);
        }

        $totalProgress = 0;
        $count = $projects->count();

        foreach ($projects as $project) {

            $progress = $this->calculateProjectProgress($project->plist_id);

            $project->average_completion = $progress;

            $totalProgress += $progress;
        }

        // return response()->json([
        //     'status' => true,
        //     'projects' => $projects,
        //     'totalProjects' => $count,
        //     'overallAverage' => number_format($totalProgress / $count, 2)
        // ]);

        return response()->json([
            'status' => true,
            'projects' => $projects,
            'totalProjects' => $count,
            'overallAverage' => number_format($totalProgress / $count, 2)
        ], 200, [], JSON_INVALID_UTF8_SUBSTITUTE);
    }

    public function appTrackProjectReportLocation(Request $request)
    {
        $customerId = auth()->id();

        if (!$customerId) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }

        $projectid = $request->project_id;

        if (!$projectid) {
            return response()->json([
                'status' => false,
                'message' => 'Project ID is required'
            ], 400);
        }


        // Step 1: Fetch all locations (scopes) for the given project
        $project_scope = ProjectScope::where('pscope_project_id', $projectid)->get();

        if ($project_scope->isEmpty()) {
            \Log::warning("Project ID $projectid has no locations.");
            return response()->json([
                'status' => false,
                'project_scope' => "No Projects Found!",
                'average' => 0
            ]);
        }

        \Log::info("Starting Location Progress Calculation for Project ID: $projectid");

        $totalProjectLocationProgress = 0; // final overall progress accumulator

        // Step 2: Loop through each location
        foreach ($project_scope as $scope) {
            $locationId = $scope->pscope_id;
            $locationWeightage = $scope->pscope_weightage ?? 0; // assume field for weightage exists
            \Log::info("Location ID {$locationId} → Weightage: {$locationWeightage}%");

            // Step 3: Fetch milestones under this location
            $milestones = ProjectPlanner::where('pplnr_scope_id', $locationId)->get();

            if ($milestones->isEmpty()) {
                $scope->progress = 0;
                $scope->weighted_progress = 0;
                \Log::info("Location ID {$locationId} has no milestones. Skipping progress calculation.");
                continue;
            }

            $locationMilestoneProgress = 0;

            // Log total raw milestone weight (for debugging). We do NOT normalize milestone weights.
            $totalMilestoneWeightage = $milestones->sum('pplnr_weightage');
            \Log::info("Total raw milestone weight for Location ID {$locationId}: {$totalMilestoneWeightage}");

            // Step 4: Calculate milestone-level progress for this location
            foreach ($milestones as $milestone) {
                $milestoneWeight = $milestone->pplnr_weightage ?? 0;

                // <<< IMPORTANT CHANGE >>>
                // Treat milestoneWeight as an absolute percentage (percent-of-project or percent-of-location depending on your model).
                // Do NOT normalize it by the sum of milestone weights here.
                $normalizedMilestoneWeight = $milestoneWeight;

                // Fetch tasks under this milestone to compute milestone progress
                $tasks = ProjectPlannerTask::where('pptasks_planner_id', $milestone->pplnr_id)->get();
                $totalDefinedWeightage = $tasks->sum('pptasks_weightage');
                if ($totalDefinedWeightage <= 0) {
                    $totalDefinedWeightage = 100; // fallback to equal distribution
                }

                $milestoneTaskProgress = 0;
                foreach ($tasks as $task) {
                    $taskWeight = $task->pptasks_weightage ?? 0;
                    $normalizedTaskWeight = ($taskWeight / $totalDefinedWeightage) * 100;

                    $taskProgress = match (strtolower($task->pptasks_pt_status)) {
                        'fullfilled', 'fulfilled' => 100,
                        'ongoing' => 0, //since wew are not calculating OnGoing Progress!
                        default => 0
                    };

                    $milestoneTaskProgress += ($normalizedTaskWeight * $taskProgress) / 100;
                }

                $milestoneProgress = round($milestoneTaskProgress, 2); // percent of milestone completed
                // weightedMilestoneProgress is percent contribution to the LOCATION (if milestoneWeight is percent-of-location)
                // or percent-of-project depending on how you interpret milestoneWeight. This follows your requested semantics:
                $weightedMilestoneProgress = ($milestoneProgress * $normalizedMilestoneWeight) / 100;

                $locationMilestoneProgress += $weightedMilestoneProgress;

                \Log::info(
                    "Milestone ID {$milestone->pplnr_id} → Milestone Progress: {$milestoneProgress}%," .
                    " Milestone Weight: {$milestoneWeight}%, Weighted Contribution to Location: " .
                    round($weightedMilestoneProgress, 2) . "%"
                );
            }

            // Step 5: Location’s own weighted progress
            $scope->progress = round($locationMilestoneProgress, 2); // percent (as aggregated above)
            $scope->weighted_progress = round(($scope->progress * $locationWeightage) / 100, 2); // percent contribution to project

            $totalProjectLocationProgress += $scope->weighted_progress;

            \Log::info("Location ID {$locationId} → Location Progress: {$scope->progress}%, "
                . "Weighted Contribution to Project: {$scope->weighted_progress}%");
        }

        // Step 6: Final overall location progress
        $average = round($totalProjectLocationProgress, 2);
        \Log::info("Final Project ID: $projectid → Overall Location Progress: {$average}%");

        return response()->json([
            'status' => true,
            'project_scope' => $project_scope,
            'average' => $average
        ]);
    }

    public function appTrackProjectReportDetails($projectid)
    {

        $projectScope = ProjectScope::where('pscope_id', $projectid)->first();
        // Fetch all milestones (planners) related to the project
        $project = Project::where('plist_id', $projectScope->pscope_project_id)->first();

        \Log::info('Projectid ' . $projectScope->pscope_project_id);
        \Log::info('ProjectName ' . $project->plist_title);

        $project_planner = ProjectPlanner::where('pplnr_scope_id', $projectid)->get();
        $comments = Comment::where('pconv_scope_id', $projectid)->get();

        if ($project_planner->isEmpty()) {
            \Log::info("Project ID $projectid has no milestones.");

            return response()->json([
                'status' => true,
                'project_planner' => [],
                'project_scope' => $projectScope,
                'comments' => [],
                'average' => 0
            ]);
        }

        $totalProjectProgress = 0;

        \Log::info("Starting project progress calculation for Project ID: $projectid");

        foreach ($project_planner as $planner) {

            $milestoneWeightage = $planner->pplnr_weightage ?? 0;

            $tasks = ProjectPlannerTask::where('pptasks_planner_id', $planner->pplnr_id)->get();
            $totalTasks = $tasks->count();

            if ($totalTasks === 0) {
                $planner->progress = 0;
                $planner->weighted_progress = 0;
                continue;
            }

            $totalDefinedWeightage = $tasks->sum('pptasks_weightage');
            if ($totalDefinedWeightage <= 0)
                $totalDefinedWeightage = 100;

            $milestoneTaskProgress = 0;

            foreach ($tasks as $task) {

                $taskWeight = $task->pptasks_weightage ?? 0;
                $normalizedWeight = ($taskWeight / $totalDefinedWeightage) * 100;

                $taskProgress = match ($task->pptasks_pt_status) {
                    'Fullfilled', 'Fulfilled' => 100,
                    'Ongoing' => 0,
                    default => 0
                };

                $weightedContribution = ($normalizedWeight * $taskProgress) / 100;
                $milestoneTaskProgress += $weightedContribution;
            }

            $milestoneProgress = round($milestoneTaskProgress, 2);
            $weightedMilestoneProgress = ($milestoneProgress * $milestoneWeightage) / 100;

            $planner->progress = $milestoneProgress;
            $planner->weighted_progress = round($weightedMilestoneProgress, 2);

            $totalProjectProgress += $weightedMilestoneProgress;

            // Optional: attach tasks in API response
            $planner->tasks = $tasks;
        }

        $average = round($totalProjectProgress, 2);

        \Log::info("Final Project ID: $projectid → Overall Progress: {$average}%");

        return response()->json([
            'status' => true,
            'project_name' => $project->plist_title,
            'project_id' => $project->plist_projectid,
            'location' => $projectScope->pscope_state,

            'project_scope' => $projectScope,
            'project_planner' => $project_planner,
            'comments' => $comments,
            'average' => $average
        ]);
    }

    public function appProjectTimeline($pplnr_id)
    {
        $projectTimeline = ProjectPlannerTask::where('pptasks_planner_id', $pplnr_id)->get();

        if ($projectTimeline->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'ProjectTimeline not found.',
                'data' => []
            ], 404);
        }

        $totalProgress = 0;

        foreach ($projectTimeline as $task) {

            // Each task's weightage
            $taskWeightage = $task->pptasks_weightage ?? 0;

            // Task progress
            $taskProgress = 0;

            if ($task->pptasks_pt_status === 'Fullfilled') {
                $taskProgress = 100;
            } elseif ($task->pptasks_pt_status === 'Ongoing') {
                $taskProgress = 0;
            }

            // Weighted contribution
            $weightedProgress = ($taskProgress * $taskWeightage) / 100;

            // Add to total
            $totalProgress += $weightedProgress;

            // Attach values in API response
            $task->progress = $taskProgress;
            $task->weighted_progress = round($weightedProgress, 2);
        }

        $overallProgress = round($totalProgress, 2);

        return response()->json([
            'status' => true,
            'planner_id' => $pplnr_id,
            'overall_progress' => $overallProgress,
            'tasks' => $projectTimeline
        ]);
    }

    // public function appStore(Request $request)
    // {
    //     ini_set('upload_max_filesize', '100M');
    //     ini_set('post_max_size', '100M');
    //     ini_set('memory_limit', '256M');
    //     ini_set('max_execution_time', '300');
    //     ini_set('max_input_time', '300');

    // \Log::info('working till days');

    //     try {

    //         // Validation
    //         $validated = $request->validate([
    //             'plist_id' => 'nullable',
    //             'plist_title' => 'required|string|max:255',
    //             'plist_description' => 'required|string',
    //             'plist_sow' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,csv|max:20420',
    //             'plist_type' => 'required|string',
    //             'plist_startdate' => 'required|string',
    //             'plist_enddate' => 'required|string',
    //             'plist_currency' => 'required|string',
    //             'plist_budget' => 'required|numeric',
    //             'plist_checkrcv' => 'nullable|string',
    //             'plist_name' => 'required|string|max:255',
    //             'plist_email' => 'required|email|max:255',
    //             'plist_contact' => 'required|string|max:255',
    //             'plist_ongnew' => 'required|string',
    //             'plist_category' => 'required|string',
    //             'plist_coupon' => 'nullable|string',
    //             'plist_customeremail' => 'nullable|string',
    //             'cust_id' => 'required'
    //         ]);

    //     } catch (ValidationException $e) {

    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Validation Failed',
    //             'errors' => $e->errors()
    //         ], 422);
    //     }

    //     \Log::info('appStore working!');

    //     try {

    //         $currentTime = Carbon::now('Asia/Kolkata');

    //         $startDate = Carbon::createFromFormat('Y-m-d', $validated['plist_startdate'])->format('d-m-Y');
    //         $endDate = Carbon::createFromFormat('Y-m-d', $validated['plist_enddate'])->format('d-m-Y');

    //         $createdAt = $currentTime->format('d-m-Y H:i:s');
    //         $updatedAt = $currentTime->format('d-m-Y H:i:s');

    //         // File Upload
    //         $sowData = null;

    //         if ($request->hasFile('plist_sow')) {
    //             $sowFile = $request->file('plist_sow');
    //             $sowData = file_get_contents($sowFile->getRealPath());
    //         }

    //         $projectId = 'Pseudo-' . $currentTime->format('YmdHis');

    //         $status = 'No SP Assigned';
    //         $projectStatus = 'Live';

    //         $checkrcv = $request->has('plist_checkrcv') ? 'True' : 'False';

    //         $custId = $validated['cust_id'];

    //         $plistId = $validated['plist_id'] ?? null;


    //         // =======================
    //         // UPDATE PROJECT
    //         // =======================

    //         if ($plistId) {

    //             $existingProject = Project::where('plist_id', $plistId)->first();

    //             if (!$existingProject) {
    //                 return response()->json([
    //                     'status' => false,
    //                     'message' => 'Project not found'
    //                 ], 404);
    //             }

    //             $existingProject->update([
    //                 'plist_title' => $validated['plist_title'],
    //                 'plist_description' => $validated['plist_description'],
    //                 'plist_sow' => $sowData,
    //                 'plist_type' => $validated['plist_type'],
    //                 'plist_startdate' => $startDate,
    //                 'plist_enddate' => $endDate,
    //                 'plist_currency' => $validated['plist_currency'],
    //                 'plist_budget' => $validated['plist_budget'],
    //                 'plist_checkrcv' => $checkrcv,
    //                 'plist_customeremail' => $validated['plist_customeremail'],
    //                 'plist_name' => $validated['plist_name'],
    //                 'plist_email' => $validated['plist_email'],
    //                 'plist_contact' => $validated['plist_contact'],
    //                 'plist_status' => $status,
    //                 'plist_project_status' => $projectStatus,
    //                 'plist_ongnew' => $validated['plist_ongnew'],
    //                 'plist_category' => $validated['plist_category'],
    //                 'plist_coupon' => $validated['plist_coupon'],
    //                 'updated_at' => $updatedAt,
    //             ]);

    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'Project updated successfully',
    //                 'project_id' => $existingProject->plist_projectid
    //             ]);
    //         }


    //         // =======================
    //         // CREATE PROJECT
    //         // =======================

    //         $project = Project::create([

    //             'plist_customer_id' => $custId,
    //             'plist_projectid' => $projectId,
    //             'plist_title' => $validated['plist_title'],
    //             'plist_description' => $validated['plist_description'],
    //             'plist_sow' => $sowData,
    //             'plist_type' => $validated['plist_type'],
    //             'plist_startdate' => $startDate,
    //             'plist_enddate' => $endDate,
    //             'plist_currency' => $validated['plist_currency'],
    //             'plist_budget' => $validated['plist_budget'],
    //             'plist_checkrcv' => $checkrcv,
    //             'plist_customeremail' => $validated['plist_customeremail'],
    //             'plist_name' => $validated['plist_name'],
    //             'plist_email' => $validated['plist_email'],
    //             'plist_contact' => $validated['plist_contact'],
    //             'plist_status' => $status,
    //             'plist_project_status' => $projectStatus,
    //             'plist_ongnew' => $validated['plist_ongnew'],
    //             'plist_category' => $validated['plist_category'],
    //             'plist_coupon' => $validated['plist_coupon'],
    //             'created_at' => $createdAt,
    //             'updated_at' => $updatedAt,
    //         ]);


    //         // =======================
    //         // SEND MAIL (Optional)
    //         // =======================

    //         $name = ProjectOwners::where('pown_id', $custId)->value('pown_name');
    //         $email = ProjectOwners::where('pown_id', $custId)->value('pown_email');

    //         if ($email) {

    //             mail::to($email)->send(
    //                 new ProjectUploadedMail(
    //                     ['plist_title' => $validated['plist_title'], 'plist_projectid' => $projectId],
    //                     $name,
    //                     $validated['plist_title']
    //                 )
    //             );
    //         }


    //         \Log::info('1 appStore working!');

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Project created successfully',
    //             'project_id' => $projectId,
    //             'data' => $project
    //         ]);


    //     } catch (\Exception $e) {

    //         \Log::error('Store API Error: ' . $e->getMessage());

    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Server error',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function appStore(Request $request)
    {
        ini_set('upload_max_filesize', '100M');
        ini_set('post_max_size', '100M');
        ini_set('memory_limit', '256M');
        ini_set('max_execution_time', '300');
        ini_set('max_input_time', '300');

        \Log::info('working till days');

        try {

            $validated = $request->validate([
                'plist_id' => 'nullable',
                'plist_title' => 'required|string|max:255',
                'plist_description' => 'required|string',
                'plist_sow' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,csv|max:20420',

                // DROPDOWNS
                'plist_type' => 'required|string',        // On Site / On Remote
                'plist_ongnew' => 'required|string',      // New / Ongoing
                'plist_category' => 'required|string',    // Category

                'plist_startdate' => 'required|string',
                'plist_enddate' => 'required|string',
                'plist_currency' => 'required|string',
                'plist_budget' => 'required|numeric',
                'plist_checkrcv' => 'nullable|string',

                'plist_name' => 'required|string|max:255',
                'plist_email' => 'required|email|max:255',
                'plist_contact' => 'required|string|max:255',

                'plist_coupon' => 'nullable|string',
                'plist_customeremail' => 'nullable|string',
                'cust_id' => 'required'
            ]);

        } catch (ValidationException $e) {

            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'errors' => $e->errors()
            ], 422);
        }

        \Log::info('appStore working!');

        try {

            $currentTime = Carbon::now('Asia/Kolkata');

            $startDate = Carbon::createFromFormat('Y-m-d', $validated['plist_startdate'])->format('d-m-Y');
            $endDate = Carbon::createFromFormat('Y-m-d', $validated['plist_enddate'])->format('d-m-Y');

            $createdAt = $currentTime->format('d-m-Y H:i:s');
            $updatedAt = $currentTime->format('d-m-Y H:i:s');

            // ======================
            // FILE UPLOAD (SOW)
            // ======================

            $sowData = null;

            if ($request->hasFile('plist_sow')) {

                $sowFile = $request->file('plist_sow');

                $sowData = file_get_contents($sowFile->getRealPath());

            }

            $projectId = 'Pseudo-' . $currentTime->format('YmdHis');

            $status = 'No SP Assigned';
            $projectStatus = 'Live';

            $checkrcv = $request->has('plist_checkrcv') ? 'True' : 'False';

            $custId = $validated['cust_id'];

            $plistId = $validated['plist_id'] ?? null;

            // =======================
            // UPDATE PROJECT
            // =======================

            if ($plistId) {

                $existingProject = Project::where('plist_id', $plistId)->first();

                if (!$existingProject) {

                    return response()->json([
                        'status' => false,
                        'message' => 'Project not found'
                    ], 404);
                }

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

                    // 'plist_customeremail' => $validated['plist_customeremail'],
                    'plist_customeremail' => $validated['plist_customeremail'] ?? null,

                    'plist_name' => $validated['plist_name'],
                    'plist_email' => $validated['plist_email'],
                    'plist_contact' => $validated['plist_contact'],

                    'plist_status' => $status,
                    'plist_project_status' => $projectStatus,

                    // DROPDOWNS
                    'plist_ongnew' => $validated['plist_ongnew'],
                    'plist_category' => $validated['plist_category'],

                    'plist_coupon' => $validated['plist_coupon'] ?? null,

                    'updated_at' => $updatedAt,
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Project updated successfully',
                    'project_id' => $existingProject->plist_projectid
                ]);
            }

            // =======================
            // CREATE PROJECT
            // =======================

            $project = Project::create([

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

                // 'plist_customeremail' => $validated['plist_customeremail'],
                'plist_customeremail' => $validated['plist_customeremail'] ?? null,

                'plist_name' => $validated['plist_name'],
                'plist_email' => $validated['plist_email'],
                'plist_contact' => $validated['plist_contact'],

                'plist_status' => $status,
                'plist_project_status' => $projectStatus,

                // DROPDOWNS
                'plist_ongnew' => $validated['plist_ongnew'],
                'plist_category' => $validated['plist_category'],

                
                'plist_coupon' => $validated['plist_coupon'] ?? null,

                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);

            // =======================
            // SEND MAIL
            // =======================

            $name = ProjectOwners::where('pown_id', $custId)->value('pown_name');
            $email = ProjectOwners::where('pown_id', $custId)->value('pown_email');

            if ($email) {

                mail::to($email)->send(

                    new ProjectUploadedMail(
                        [
                            'plist_title' => $validated['plist_title'],
                            'plist_projectid' => $projectId
                        ],
                        $name,
                        $validated['plist_title']
                    )

                );
            }

            \Log::info('1 appStore working!');

            return response()->json([
                'status' => true,
                'message' => 'Project created successfully',
                'project_id' => $projectId,
                'data' => $project
            ]);

        } catch (\Exception $e) {

            \Log::error('Store API Error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // public function appProjectReport()
    // {

    //     $user = auth()->user();

    //     if (!$user) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Unauthorized. Please login again.'
    //         ], 401);
    //     }

    //     $customerId = ProjectOwners::where('pown_email', $user->email)
    //         ->value('pown_id');

    //     \Log::info('Customer ID: ' . $customerId);

    //     if (!$customerId) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Customer ID does not exist!'
    //         ], 401);
    //     }

    //     $totalProjects = Project::where('plist_customer_id', $customerId)->get()->count();

    //     \Log::info('total projects counts!', [$totalProjects]);

    //     \Log::info('customer Id: ', [$customerId]);

    //     $stats = DB::table('project_list')
    //         ->selectRaw("
    //         COUNT(CASE WHEN plist_status = 'No SP Assigned' THEN 1 END) as not_started,
    //         COUNT(CASE WHEN plist_status = 'In Progress' THEN 1 END) as in_progress,
    //         COUNT(CASE WHEN plist_status = 'Delivered' THEN 1 END) as delivered,
    //         COUNT(CASE 
    //             WHEN STR_TO_DATE(plist_enddate, '%d-%m-%Y') < CURDATE()
    //             AND plist_status != 'Delivered'
    //             THEN 1 
    //         END) as overdue
    //     ")
    //         ->where('plist_customer_id', $customerId)
    //         ->first();

    //     \Log::info('stats', [$stats]);

    //     $onTime = DB::table('project_list')
    //         ->selectRaw("
    //     IFNULL(
    //         ROUND(
    //             (
    //                 SUM(
    //                     CASE 
    //                         WHEN plist_status = 'Delivered'
    //                          AND STR_TO_DATE(plist_delivered_on,'%d-%m-%Y') 
    //                              <= STR_TO_DATE(plist_enddate,'%d-%m-%Y')
    //                         THEN 1 
    //                         ELSE 0 
    //                     END
    //                 )
    //                 /
    //                 NULLIF(
    //                     SUM(
    //                         CASE 
    //                             WHEN plist_status = 'Delivered' 
    //                             THEN 1 
    //                             ELSE 0 
    //                         END
    //                     ),
    //                     0
    //                 )
    //             ) * 100,
    //         1),
    //     0)
    //     AS on_time_delivery_percentage
    // ")
    //         ->where('plist_customer_id', $customerId)
    //         ->value('on_time_delivery_percentage');

    //     $avgDuration = DB::table('project_list')
    //         ->selectRaw("
    //         IFNULL(
    //             ROUND(
    //                 AVG(
    //                     DATEDIFF(
    //                         STR_TO_DATE(plist_delivered_on,'%d-%m-%Y'),
    //                         STR_TO_DATE(plist_startdate,'%d-%m-%Y')
    //                     )
    //                 )
    //             , 1),
    //         0) AS avg_days_duration
    //     ")
    //         ->where('plist_customer_id', $customerId)
    //         ->where('plist_status', 'Delivered')
    //         ->value('avg_days_duration');

    //     \Log::info('Total Projects Count' . $totalProjects);

    //     return response()->json([
    //         'total_projects' => (int) $totalProjects,
    //         'on_time_delivery_percentage' => (float) $onTime,
    //         'avg_days_duration' => (float) $avgDuration,
    //         'not_started' => (int) $stats->not_started,
    //         'in_progress' => (int) $stats->in_progress,
    //         'delivered' => (int) $stats->delivered,
    //         'overdue' => (int) $stats->overdue,
    //     ]);
    // }

    public function appProjectReport()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized. Please login again.'
            ], 401);
        }

        $customerId = ProjectOwners::where('pown_email', $user->email)
            ->value('pown_id');

        \Log::info('Customer ID: ' . $customerId);

        if (!$customerId) {
            return response()->json([
                'status' => false,
                'message' => 'Customer ID does not exist!'
            ], 401);
        }

        /*
        |--------------------------------------------------------------------------
        | Total Projects
        |--------------------------------------------------------------------------
        */

        $totalProjects = DB::table('project_list')
            ->where('plist_customer_id', $customerId)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Status Counts
        |--------------------------------------------------------------------------
        */

        $stats = DB::table('project_list')
            ->selectRaw("
            COUNT(CASE WHEN plist_status = 'No SP Assigned' THEN 1 END) as not_started,
            COUNT(CASE WHEN plist_status = 'In Progress' THEN 1 END) as in_progress,
            COUNT(CASE WHEN plist_status = 'Delivered' THEN 1 END) as delivered,
            COUNT(
                CASE 
                    WHEN STR_TO_DATE(plist_enddate,'%d-%m-%Y') < CURDATE()
                    AND plist_status != 'Delivered'
                    THEN 1 
                END
            ) as overdue
        ")
            ->where('plist_customer_id', $customerId)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | On Time Delivery %
        |--------------------------------------------------------------------------
        */

        $onTime = DB::table('project_list')
            ->selectRaw("
            IFNULL(
                ROUND(
                    (
                        SUM(
                            CASE 
                                WHEN plist_status = 'Delivered'
                                AND STR_TO_DATE(plist_delivered_on,'%d-%m-%Y')
                                    <= STR_TO_DATE(plist_enddate,'%d-%m-%Y')
                                THEN 1
                                ELSE 0
                            END
                        )
                        /
                        NULLIF(
                            SUM(
                                CASE 
                                    WHEN plist_status = 'Delivered'
                                    THEN 1
                                    ELSE 0
                                END
                            ),
                        0)
                    ) * 100,
                1),
            0)
            AS on_time_delivery_percentage
        ")
            ->where('plist_customer_id', $customerId)
            ->value('on_time_delivery_percentage');

        /*
        |--------------------------------------------------------------------------
        | Average Duration (Fixed negative values)
        |--------------------------------------------------------------------------
        */

        $avgDuration = DB::table('project_list')
            ->selectRaw("
            IFNULL(
                ROUND(
                    AVG(
                        DATEDIFF(
                            STR_TO_DATE(plist_delivered_on,'%d-%m-%Y'),
                            STR_TO_DATE(plist_startdate,'%d-%m-%Y')
                        )
                    ),
                1),
            0)
            AS avg_days_duration
        ")
            ->where('plist_customer_id', $customerId)
            ->where('plist_status', 'Delivered')
            ->whereNotNull('plist_startdate')
            ->whereNotNull('plist_delivered_on')
            ->where('plist_startdate', '!=', '')
            ->where('plist_delivered_on', '!=', '')
            ->whereRaw("
            STR_TO_DATE(plist_delivered_on,'%d-%m-%Y') 
            >= STR_TO_DATE(plist_startdate,'%d-%m-%Y')
        ")
            ->value('avg_days_duration');

        /*
        |--------------------------------------------------------------------------
        | Final Response
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'total_projects' => (int) $totalProjects,
            'on_time_delivery_percentage' => (float) $onTime,
            'avg_days_duration' => (float) $avgDuration,
            'not_started' => (int) ($stats->not_started ?? 0),
            'in_progress' => (int) ($stats->in_progress ?? 0),
            'delivered' => (int) ($stats->delivered ?? 0),
            'overdue' => (int) ($stats->overdue ?? 0),
        ]);
    }

    public function importProject(Request $request)
    {
        try {

            if (!$request->hasFile('file')) {
                return response()->json([
                    'status' => false,
                    'message' => 'File not found'
                ], 400);
            }

            $projectId = $request->project_id;

            if (!$projectId) {
                return response()->json([
                    'status' => false,
                    'message' => 'Project ID required'
                ], 400);
            }

            Excel::import(new ProjectHierarchyImport($projectId), $request->file('file'));

            return response()->json([
                'status' => true,
                'message' => 'Import successful'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}