<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InquirySent extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $data; 
    /**
     * Create a new message instance.
     */
    public function __construct($user , $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    public function build()
    {

        return $this->subject('Your Inquiry Has Been Raised!')
            ->view('emails/inquiry_sent')
            ->with('data', $this->data)
            ->with('user', $this->user);
    }
}
