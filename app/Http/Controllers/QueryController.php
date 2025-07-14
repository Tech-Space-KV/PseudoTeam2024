<?php

namespace App\Http\Controllers;

use App\Mail\InquiryMail;
use App\Mail\SendQueryMailCopy;
use App\Mail\SupportQueryReceived;
use App\Models\Project;
use App\Models\ProjectOwner;
use Illuminate\Http\Request;
use App\Mail\SendQueryMail; 
use Mail;

//Implemented by sanskar

class QueryController extends Controller
{
    public function submitQuery(Request $request)
    {

        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'query' => 'required',
            'contact' => 'nullable'
        ]);

        $queryRefId = $request->firstName. '-' . time();

        $data = [
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'query' => $request->address,
            'contact' => $request->address2,
            'queryRefId' => $queryRefId
        ];

        Mail::to($request->email)->send(new SendQueryMail($data));

        Mail::to('info@pseudoteam.com')->send(new SendQueryMailCopy($data));

        return redirect()->back()->with('success', 'Your query has been submitted successfully!');
    }

    public function submitSupportQuery(Request $request)
    {

        $request->validate([
            'query' => 'required|string|max:1000',
        ]);

        $query = [ 
           'query' => $request->input('query')
        ];

        $user = ProjectOwner::where('pown_id', session('user_id'))->first();

        Mail::to($user->pown_email)->send(new SupportQueryReceived($user->pown_name, $user->pown_email, $query['query']));

        return redirect()->back()->with('success', 'Your query has been submitted.');
    }

    public function submitInquery(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact' => 'nullable|string|max:15',
            'message' => 'required|string|max:1000',
        ]);

        $data = [
            'name' => $request->input('name'),
            'contact' => $request->input('contact'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ];

        \Log::info('Inquiry Data: ', $data);    

        Mail::to('sanskarsharma0119@gmail.com')->send(new InquiryMail($data));

        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully!');
    
    }
}
