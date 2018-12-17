<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActiveOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var $data
     */
    private $data;

    /**
     * Create a new message instance.
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.order')->text('mails.order_text')->with('data', $this->data);
    }
}
