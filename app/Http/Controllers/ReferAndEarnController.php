<?php

namespace App\Http\Controllers;

use App\Mail\ReferAndEarnMail;
use App\Models\ProjectOwners;
use App\Models\ReferralTable;
use App\Models\ServiceProvider;
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
        $userName = $projectOwner->pown_name;

        // $link = 'Pseudoteam.com/public/referal-registration/'.$customer_id.'/'.$userName;
        $link = 'Pseudoteam.com';

        ReferralTable::create([
            'rfrls_user_id' => session('user_id'),
            'rfrls_email_id' => $request->input('friend_email'),
            'rfrls_promo_code' => $projectOwner->pown_username,
            'rfrls_user_type'=> 'customer',
        ]);

        \Log::info('Working till here! ' . $projectOwner->pown_promo_code);

        Mail::to($email)->send(new ReferAndEarnMail($link , $projectOwner->pown_name , $projectOwner->pown_promo_code));

        return redirect()->back()->with('success', 'Invitation sent successfully!');

    }

    public function spSendMail(Request $request) 
    {
        $servicePartner = session('sp_user_id');

        if(!$servicePartner)
        {
            return redirect()->back()->with('error', 'Customer id not found!');
        }

        $servicePartner = ServiceProvider::where('sprov_id' , $servicePartner)->first();

        $email = $request->input('friend_email');
        $message = $request->input('message');
        $userName = $servicePartner->sprov_name;

        ReferralTable::create([
            'rfrls_user_id' => session('sp_user_id'),
            'rfrls_email_id' => $request->input('frend_email'),
            'rfrls_user_type'=> 'SP',
        ]);

        $link = 'Pseudoteam.com';

        Mail::to($email)->send(new ReferAndEarnMail($link ,$servicePartner->sprov_name , $servicePartner->pown_promo_code));    

        return redirect()->back()->with('success', 'Invitation sent successfully!');

    }
}
