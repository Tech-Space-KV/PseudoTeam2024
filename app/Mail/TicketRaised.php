<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketRaised extends Mailable
{
    use Queueable, SerializesModels;

    public $ticketTitle;
    public $ticketDescription;
    public $customerId;

    // Constructor to initialize the properties
    public function __construct($ticketTitle, $ticketDescription, $customerId)
    {
        $this->ticketTitle = $ticketTitle;
        $this->ticketDescription = $ticketDescription;
        $this->customerId = $customerId;
    }

    public function build()
    {
        // Compose the email with the ticket data
        $email = $this->view('emails.ticket_raised_mail')
                      ->subject('A New Ticket Has Been Raised')
                      ->with([
                          'ticketTitle' => $this->ticketTitle,
                          'ticketDescription' => $this->ticketDescription,
                          'customerId' => $this->customerId,
                      ]);

        return $email;
    }
}
