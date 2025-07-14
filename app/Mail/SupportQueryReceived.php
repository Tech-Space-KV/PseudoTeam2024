<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SupportQueryReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $query;

    public $name;
    public $email;

    public function __construct($name , $email, $query)
    {
        $this->query = $query;
        $this->name = $name;
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('New Help Query Received')
        ->view('emails/support_query_mail')
        ->with('query' , $this->query)
        ->with('name' , $this->name)
        ->with('email' , $this->email);
    }
}
