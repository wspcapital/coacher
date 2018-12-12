<?php

namespace App\Mail\Intranet;

use App\Models\Traits\UserTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAccount extends Mailable
{
    use Queueable,
        SerializesModels,
        UserTrait;

    public $user;
    public $password;
    /**
     * Create a new message instance.
     *
     * @param  $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user= $user;
        if ($user->passtext) {
            $this->password = $user->passtext;
        } else {
            $this->password = $this->generatePassword(8);
            $this->user->password = bcrypt($this->password);
            $this->user->passtext = $this->password;
            $this->user->save();
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('portal@pinper.com')
            ->subject('Your Pinnacle Learning Portal is ready!')
            ->view('emails.intranet.send-account');
    }
}