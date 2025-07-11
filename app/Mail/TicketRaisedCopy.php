<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketRaisedCopy extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $description;
    public $ticketId;
    public $email;
    public $name; 

    // Constructor to initialize the properties
    public function __construct($ticketId, $name, $email, $ticketTitle, $ticketDescription)
    {
        $this->ticketId = $ticketId;
        $this->name = $name;
        $this->title = $ticketTitle;
        $this->description = $ticketDescription;
        $this->email = $email;
    }

    public function build()
    {
        // Compose the email with the ticket data
        $email = $this->view('emails.ticket_raised_mail_copy')
            ->subject('A New Ticket Has Been Raised')
            ->with([
                'title' => $this->title,
                'description' => $this->description,
                'customerId' => $this->email,
                'ticketId' => $this->ticketId,
                'name' => $this->name,
            ]);

        return $email;
    }
}
