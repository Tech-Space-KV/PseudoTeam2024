<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetLink;
    
    public $name;  

    public function __construct($resetLink, $name)
    {
        $this->resetLink = $resetLink;
        $this->name = $name;
    }

    public function build()
    {
        return $this->subject('Reset Your Password')
        ->view('emails.customer_forgot_password')
        ->with(['resetLink' => $this->resetLink, 'name' => $this->name]);
    }
}
