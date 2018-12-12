<?php

namespace App\Mail\VCoach;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewAccount extends Mailable
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
            ->from('info@pinper.com', 'Pinnacle-Performance')
            ->to($this->user['email'])
            ->view('emails.vcoach.new-account');
        /*Mail::send('emails.vcoach.new-account', compact('user'), function ($message) use ($user) {
            $message->subject('Your Portal Account has been created')->to($user->email);
        });*/
    }
}
