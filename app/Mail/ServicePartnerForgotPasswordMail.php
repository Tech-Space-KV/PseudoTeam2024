<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServicePartnerForgotPasswordMail extends Mailable
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
            ->view('emails.service_partner_forgot_password')
            ->with([
                'resetLink' => $this->resetLink,
                'name' => $this->name,
            ]);
    }
}