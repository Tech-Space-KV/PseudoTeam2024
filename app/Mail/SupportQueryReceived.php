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

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function build()
    {
        return $this->subject('New Support Query')
        ->view('emails/support_query_mail')
        ->with('query' , $this->query);
    }
}
