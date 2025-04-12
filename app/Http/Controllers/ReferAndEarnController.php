<?php

namespace App\Http\Controllers;

use App\Mail\ReferAndEarnMail;
use App\Models\ProjectOwners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReferAndEarnController extends Controller
{
    public function sendMail(Request $request) 
    {

        $customer_id = session('user_id');

        if(!$customer_id)
        {
            return redirect()->back()->with('error', 'Customer id not found!');
        }

        $projectOwner = ProjectOwners::where('pown_id' , $customer_id)->first();

        $email = $request->input('friend_email');
        $message = $request->input('message');
        $userName = 'sanskar';

        $link = 'Pseudoteam.com/referal-registration/'.$customer_id.'/'.$userName;

        Mail::to($email)->send(new ReferAndEarnMail($link));

        return redirect()->back()->with('success', 'Invitation sent successfully!');

    }
}
