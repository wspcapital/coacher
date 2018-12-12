<?php

namespace App\Mail\Intranet;

use App\Models\BookingTrainers;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

/**
 * Class NewAttachment
 * @package App\Mail\Intranet
 */
class NewAttachment extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingAssets;
    public $user;
    /**
     * NewAttachment constructor.
     * @param $bookingAssets
     */
    public function __construct($bookingAssets)
    {
        $this->user = Auth::user();
        $this->bookingAssets = $bookingAssets;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('info@pinper.com', 'Pinnacle-Performance')
            ->subject('File Sharing Notification')
            ->view('emails.intranet.new-attachment');
    }
}
