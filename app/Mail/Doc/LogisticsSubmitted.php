<?php

namespace App\Mail\Doc;

use Illuminate\Bus\Queueable,
    Illuminate\Mail\Mailable,
    Illuminate\Queue\SerializesModels,
    Illuminate\Contracts\Queue\ShouldQueue,
    App\Http\Controllers\Traits\CustomFunction;

class LogisticsSubmitted extends Mailable
{
    use Queueable, SerializesModels, CustomFunction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
            ->subject('Logistics Submission')
            ->view('emails.doc.logistics-submitted')
            ->with(['booking' => $this->event, 'country'=>$this->country(), 'state' => $this->state()]);
    }
}
