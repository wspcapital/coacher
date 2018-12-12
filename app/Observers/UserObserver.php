<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 25.02.17
 * Time: 11:50
 */

namespace App\Observers;

use App\Models\User,
    App\Notifications\VCoach\NewAccountNotification;

/**
 * Class UserObserver
 * @package App\Observers
 */
class UserObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(User $user)
    {
        $user->notify(new NewAccountNotification());
    }
}
