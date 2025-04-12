<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerSignUpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        
    }

    public function build()
    {
        return $this->subject('New Customer Sign Up')
                    ->view('emails/customer_sign_up_mail');
    }
}
