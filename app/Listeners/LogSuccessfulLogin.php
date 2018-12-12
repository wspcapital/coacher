<?php

namespace App\Listeners;

use App\Models\User,
    Carbon\Carbon,
    Illuminate\Auth\Events\Login,
    Illuminate\Support\Facades\Auth;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        User::where('id', Auth::user()->id)->update([
            'login_at' => Carbon::now()
        ]);
    }
}
