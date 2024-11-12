<?php

namespace App\Http\Controllers;

use App\Mail\SendQueryMailCopy;
use Illuminate\Http\Request;
use App\Mail\SendQueryMail; 
use Mail;

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

        // Send email to the user
        Mail::to($request->email)->send(new SendQueryMail($data));

        // Send a copy to yourself
        Mail::to('sanskarsharma0119@gmail.com')->send(new SendQueryMailCopy($data));

        return redirect()->back()->with('success', 'Your query has been submitted successfully!');
    }
}
