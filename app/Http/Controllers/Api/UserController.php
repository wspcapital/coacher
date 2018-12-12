<?php

namespace App\Http\Controllers\Api;

use App\Notifications\Intranet\{
    ResetPasswordNotification,
    SendAccountNotification
};
use App\Models\Traits\UserTrait,
    App\Models\User,
    App\Http\Controllers\Controller,
    Illuminate\Support\Facades\Input;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    use UserTrait;

    /**
     * Return all users
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllUsers()
    {
        $users = User::checkBlock()->with([
            'bookingParticipant.bookingTrainer.user',
            'bookingParticipant.booking.rm',
            'roles'
        ])->paginate(25);

        return $this->getRelationUsers($users);
    }

    /**
     * Search  users
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function searchUsers()
    {
        $users = User::checkBlock()->search(trim(Input::get('q')))->paginate(20);

        return $this->getRelationUsers($users);
    }

    /**
     * Return relation users
     * @param $users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getRelationUsers($users)
    {
        foreach ($users as $user) {
            $user->trainer = $user->getTrainer();
            $user->rm = $user->getRm();
            if ($user->roles->first() != null) {
                $user->role = $user->roles->first()->display_name;
            }
        }

        return $users;
    }

    /**
     * @param User $user
     */
    public function sendAccount(User $user)
    {
        $user->notify(new SendAccountNotification());
    }

    /**
     * @param User $user
     */
    public function sendEmail(User $user)
    {
        $password = $this->generatePassword(8);
        $user->password = bcrypt($password);
        $user->passtext = $password;
        $user->save();

        $user->notify(new ResetPasswordNotification());
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function blockUser(User $user)
    {
        //dd($user);
        $user -> blocked = $user->blocked == "1" ? "0" : "1";
        $user->save();

        return response()->success('Block user', $user->blocked);
    }
}
