<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        // Fetch only projects where plist_status is 'No SP Assigned'
        $projects = Project::where('plist_status', 'No SP Assigned')->get();
        return view('/service-partner/find_project', compact('projects'));
    }
    public function showProjectDetails(Request $request)
{
    // Get the project ID from the query parameter
    $projectId = $request->query('project_id');

    // Fetch the project details from the database
    $project = Project::where('plist_projectid', $projectId)->first();

    // Pass the project details to the view
    return view('/service-partner/find_project_details', compact('project'));
}

}

