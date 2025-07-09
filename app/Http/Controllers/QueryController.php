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

        Mail::to('info@pseudoteam.com')->send(new SupportQueryReceived($query));

        return redirect()->back()->with('success', 'Your query has been submitted.');
    }
}
