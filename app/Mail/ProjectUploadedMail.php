<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProjectUploadedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public $name;

    public $projectTitle;

    /**
     * Create a new message instance.
     */
    public function __construct($data, $name , $projectTitle)
    {
        $this->data = $data;
        $this->name = $name;
        $this->projectTitle = $projectTitle;
    }


    public function build()
    {

        \Log::info('(2)Sending Project Uploaded Mail', [
            'data' => $this->data,
        ]);

        return $this->subject('Project Uploaded Successfully')
                    ->view('emails/project_uploaded_mail')
                    ->with('data', $this->data)
                    ->with('name', $this->name)
                    ->with('projectTitle', $this->projectTitle);
    }
}
