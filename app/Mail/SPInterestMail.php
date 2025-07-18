<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SPInterestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;

    public $serviceProvider;

    public $reason;

    public function __construct($serviceProvider, $project, $reason )
    {
        $this->serviceProvider = $serviceProvider;
        $this->project = $project;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->subject('Service Provider Interested in Project')
            ->view('emails/sp_interest_mail')
            ->with('serviceProvider', $this->serviceProvider)
            ->with('project', $this->project)
            ->with('reason', $this->reason);
    }
}
