<?php

namespace App\Mail\Portal;

use Illuminate\Bus\Queueable,
    Illuminate\Mail\Mailable,
    Illuminate\Queue\SerializesModels,
    Illuminate\Support\Facades\Auth;

class VCoachSessionRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;

    /**
     * VCoachSessionRequest constructor.
     * @param $order
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->user = Auth::user();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@pinper.com', 'Pinnacle-Performance')
            ->to(['vcoachadmin@pinper.com','gleon@pinper.com','sbaculi@pinper.com'])
            ->subject('Your Virtual Coach is now assigned')
            ->view('emails.portal.vcoach-session-request');
    }
}
