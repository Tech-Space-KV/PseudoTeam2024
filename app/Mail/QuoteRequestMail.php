<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteRequestMail extends Mailable
{
    use Queueable, SerializesModels;


    public $formData;
    public $selectedServices;
    public $selectedSpares;

    public function __construct($formData, $selectedServices, $selectedSpares)
    {
        $this->formData = $formData;
        $this->selectedServices = $selectedServices;
        $this->selectedSpares = $selectedSpares;
    }
    public function build()
    {
        return $this->subject('New Quote Request')
            ->view('emails.quote_request_mail');
    }
}
