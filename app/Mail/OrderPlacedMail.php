<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderNo;

    public $name;  
    /**
     * Create a new message instance.
     */
    public function __construct($orderNo, $name)
    {
        $this->orderNo = $orderNo;
        $this->name = $name;
    }

    public function build()
    {

        return $this->subject('Order Has Been Raised!')
            ->view('emails/order_placed_mail')
            ->with('data', $this->orderNo)
            ->with('name', $this->name);

    }
}
