<?php

namespace App\Mail\Intranet;

use Illuminate\Bus\Queueable,
    Illuminate\Mail\Mailable,
    Illuminate\Queue\SerializesModels;

class LearningReady extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->user)
            ->from('info@pinper.com', 'Pinnacle-Performance')
            ->subject('Pinnacle Video Learning Modules are available')
            ->view('emails.intranet.learning-ready');
    }
}
