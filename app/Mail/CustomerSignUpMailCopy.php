<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerSignUpMailCopy extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $userName;
    public $date;

    public function __construct($email, $name, $date)
    {
        $this->email = $email;
        $this->userName = $name;
        $this->date = $date;
    }

    public function build()
    {
        return $this->subject('New Customer Signup - Notification')
                    ->view('emails/customer_sign_up_mail_copy')
                    ->with([
                        'verificationLink' => $this->email,
                        'name' => $this->userName,
                        'date' => $this->date
                    ]);
    }   
}
