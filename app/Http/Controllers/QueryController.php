<?php

namespace App\Http\Controllers;

use App\Mail\SendQueryMailCopy;
use App\Mail\SupportQueryReceived;
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

        $data = [
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'query' => $request->address,
            'contact' => $request->address2
        ];

        Mail::to($request->email)->send(new SendQueryMail($data));

        Mail::to('sanskarsharma0119@gmail.com')->send(new SendQueryMailCopy($data));

        return redirect()->back()->with('success', 'Your query has been submitted successfully!');
    }

    public function submitSupportQuery(Request $request)
    {

        \Log::info('Working SubmitSupportQuery method working!');

        $request->validate([
            'query' => 'required|string|max:1000',
        ]);

        \Log::info('Working');

        $query = $request->input('query');
        Mail::to('sanskarsharma0119@gmail.com')->send(new SupportQueryReceived($query));

        return redirect()->back()->with('success', 'Your query has been submitted.');
    }
}
