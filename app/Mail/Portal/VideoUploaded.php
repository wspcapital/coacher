<?php

namespace App\Mail\Portal;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class VideoUploaded extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param $order
     * @return void
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
            ->to(['admin@pinper.com', 'vcoach@pinper.com'])
            ->subject('A new virtual coach video is finalized and needs a coach')
            ->view('emails.portal.video-uploaded');
    }
}
