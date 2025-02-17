<?php

namespace App\Http\Controllers;

use App\Mail\ProjectUploadedMail;
use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Mail;

//Implemented by sanskar

class ProjectController extends Controller
{
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plist_title' => 'required|string|max:255',
            'plist_description' => 'required|string',
            'plist_sow' => 'nullable|file|mimes:pdf,docx,doc|max:2048',
            'plist_type' => 'required|string',
            'plist_startdate' => 'required|date',
            'plist_enddate' => 'required|date',
            'plist_currency' => 'required|string',
            'plist_budget' => 'required|numeric',
            'plist_checkrcv' => 'nullable|boolean', 
            'plist_name' => 'required|string|max:255',
            'plist_email' => 'required|email|max:255',
            'plist_contact' => 'required|string|max:255',
            'plist_ongnew' => 'required|string',
            'plist_category' => 'required|string',
            'plist_coupon' => 'nullable|string',
        ]);

        $currentTime = Carbon::now();

        $startDate = Carbon::parse($validated['plist_startdate'])->format('d-m-Y');
        $endDate = Carbon::parse($validated['plist_enddate'])->format('d-m-Y');

        $createdAt = $currentTime->format('d-m-Y H:i:s');
        $updatedAt = $currentTime->format('d-m-Y H:i:s');

        $sowData = null;
        if ($request->hasFile('plist_sow')) {
          
            $sowFile = $request->file('plist_sow');
        
            $sowData = file_get_contents($sowFile->getRealPath());
        }

        $projectId = 'Pseudo'. '-' . $currentTime->format('Y-mdHis');

        $status = 'No SP Assigned';
        $projectStatus = 'Live';
        $checkrcv = $request->has('plist_checkrcv') ? 'True' : 'False';

        $email = $validated['plist_email'];

        try {
            Project::create([
                'plist_customer_id' => 'custid',  
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

            $data = [
                'plist_projectid' => $projectId,
                'plist_title' => $request->plist_title,
            ];

           // Mail::to($request->email)->send(new ProjectUploadedMail($data));

            return redirect()->back()->with('success', 'Project has been uploaded successfully.');
        } catch (\Exception $e) {
            \Log::error('Error storing project: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an error creating the project.');
        }
    }
}
