<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketCancellationMail extends Mailable
{
    use Queueable, SerializesModels;


    public $id;

    public $spid;

    public function __construct($id, $spid)
    {
        $this->id = $id;
        $this->spid = $spid;
    }

    public function build()
    {

        return $this->subject('Inquiry Received')
            ->view('emails/ticket_cancellation')
            ->with('id', $this->id)
            ->with('spid', $this->spid);
    }
}
