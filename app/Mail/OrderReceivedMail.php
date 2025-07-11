<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name; 
    public $email;
    public $orderNo;
    public $date;
    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $orderNo, $date)
    {
        $this->orderNo = $orderNo;
        $this->name = $name;
        $this->email = $email;
        $this->date = $date;

    }

    public function build()
    {

        return $this->subject('Order Received from Customer!')
            ->view('emails/order_received_mail')
            ->with('data', $this->orderNo)
            ->with('name', $this->name)
            ->with('email', $this->email)
            ->with('date', $this->date);

    }

}
