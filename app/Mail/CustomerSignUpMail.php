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

    public $verificationLink;
    public $userName;

    public function __construct($verificationLink, $name)
    {
        $this->verificationLink = $verificationLink;
        $this->userName = $name;
    }

    public function build()
    {
        return $this->subject('New Customer Sign Up')
                    ->view('emails/customer_sign_up_mail')
                    ->with([
                        'verificationLink' => $this->verificationLink,
                        'name' => $this->userName
                    ]);
    }           
}
