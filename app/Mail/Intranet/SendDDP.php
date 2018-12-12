<?php

namespace App\Mail\Intranet;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDDP extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('portal@pinper.com')
            ->subject('Your Pinnacle Workshop Diagnostic and Development Plan is ready')
            ->view('emails.intranet.send-ddp')
            ->with(['user' => $this->event]);
    }
}
