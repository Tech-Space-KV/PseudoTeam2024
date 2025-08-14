<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InquiryReceived extends Mailable
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

        return $this->subject('New Inquiry Received!')
            ->view('emails/inquiry_received')
            ->with('data', $this->data)
            ->with('user', $this->user);
    }
}
