<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use App\Mail\InquiryMail;
use App\Mail\SendQueryMailCopy;
use App\Mail\SupportQueryReceived;
use App\Models\Project;
use App\Models\ProjectOwner;
use App\Models\ServiceProvider;
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

        $queryRefId = $request->firstName . '-' . time();

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

        if (session('user_id')) {
            $user = ProjectOwner::where('pown_id', session('user_id'))->first();

            if ($user) {
                Mail::to('info@pseudoteam.com')->send(new SupportQueryReceived($user->pown_name, $user->pown_email, $query['query']));
            }
        } elseif (session('sp_user_id')) {
            $sp = ServiceProvider::where('sprov_id', session('sp_user_id'))->first();

            if ($sp) {
                Mail::to('info@pseudoteam.com')->send(new SupportQueryReceived($sp->sprov_name, $sp->sprov_email, $query['query']));
            }
        } else {
            \Log::warning('Support query submitted without authenticated user or service provider.');
            return redirect()->back()->with('error', 'You must be logged in to submit a support query.');
        }

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

        // \Log::info('Inquiry Data: ', $data);    

        Mail::to('info@pseudoteam.com')->send(new InquiryMail($data));

        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully!');

    }

    public function contactUs(Request $request)
    {
        \Log::info('Contact Us Request: ', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ];

        Mail::to('info@pseudoteam.com')->send(new ContactUsMail($data));

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
    public function spContactUs(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ];

        Mail::to('info@pseudoteam.com')->send(new ContactUsMail($data));

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
