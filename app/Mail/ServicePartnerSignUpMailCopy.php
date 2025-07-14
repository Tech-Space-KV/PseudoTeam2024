<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServicePartnerSignUpMailCopy extends Mailable
{
    use Queueable, SerializesModels;
   
    public $email;
    public $userName;
    public $date;

        public function __construct($name,$email, $date)
        {
            $this->email = $email;
            $this->userName = $name;
            $this->date = $date;
        }

    public function build()
    {
        return $this->subject('New Service Partner Signup - Notification')
            ->view('emails/service_partner_sign_up_mail_copy')
            ->with([
                'email' => $this->email,
                'name' => $this->userName,
                'date' => $this->date
            ]);
    }
}
