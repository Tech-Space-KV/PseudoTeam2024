<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProjectUploadedMailCopy extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    public $name;

    public $projectTitle;

    /**
     * Create a new message instance.
     */
    public function __construct($projectTitle, $name, $email)
    {
        $this->email = $email;
        $this->name = $name;
        $this->projectTitle = $projectTitle;
    }


    public function build()
    {
        return $this->subject('Project Uploaded Successfully')
            ->view('emails/project_uploaded_mail_copy')
            ->with('email', $this->email)
            ->with('name', $this->name)
            ->with('projectTitle', $this->projectTitle);
    }
}
