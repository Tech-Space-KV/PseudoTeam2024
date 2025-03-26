<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReferAndEarnMail extends Mailable
{
    use Queueable, SerializesModels;


    public $link;

  
    public function __construct($link)
    {
        $this->link = $link;
    }

    public function build()
    {
        return $this->subject('PseudoTeam Referal Mail')
                    ->view('emails/send_referandearn_mail')
                    ->with('data', $this->link);
    }

}
