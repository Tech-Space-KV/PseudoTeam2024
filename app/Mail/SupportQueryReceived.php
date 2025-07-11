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

    public function __construct($query , $name)
    {
        $this->query = $query;
        $this->name = $name;
    }

    public function build()
    {
        return $this->subject('New Support Query')
        ->view('emails/support_query_mail')
        ->with('query' , $this->query)
        ->with('name' , $this->name);
    }
}
