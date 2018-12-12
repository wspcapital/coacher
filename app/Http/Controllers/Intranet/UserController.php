<?php

namespace App\Http\Controllers\Intranet;

use App\Http\Requests\{
    UserCreateRequest,
    UserUpdateRequest
};
use App\Models\{
    Role,
    User
};
use App\Models\Traits\{
    UserTrait,
    LaratrustCustomTrait
};
use Illuminate\Support\Facades\{
    Auth, View
};
use App\Http\Controllers\Controller,
    MercurySeries\Flashy\Flashy;

/**
 * Class UserController
 * @package App\Http\Controllers\Intranet
 */
class UserController extends Controller
{
    use UserTrait,
        LaratrustCustomTrait;

    /**
     * @return View
     */
    public function getAllUsers()
    {
        return view('intranet.users');
    }

    /**
     *
     * @return View
     */
    public function getNewUser()
    {
        return view('intranet.new-user')->with(['roles' => Role::all()]);
    }

    /**
     * Return one user
     *
     * @param User $user
     * @return View
     */
    public function getOneUser(User $user)
    {
        $bookingArray = [];
        $user->bookingParticipant->each(function ($item, $key) use (&$bookingArray) {
            $bookingArray[$item->booking->start_date->format('ym')][] = $item->booking;
        });
        //dd($this->getAssistantListArray());
        return view('intranet.user')->with([
            'roles' => Role::all(),
            'user' => $user,
            'assistants' => $this->getAssistantListArray(),
            'bookings' => $bookingArray,
            'credits' => $user->credits
        ]);
    }

    /**
     * Update User
     *
     * @param UserUpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveUser(UserUpdateRequest $request, User $user)
    {
        if (!empty($request->file)) {
            $user->saveAvatar($request->file);
        }
        $data = $request->except('bio', 'file');
        if ($request->bio) {
            $data['data'] = json_encode(['bio' => $request->bio]);
        } else {
            $data['data'] = json_encode(['bio' => null]);
        }

        if ($request->assistant_id) {
            $user->addAssistant($request->assistant_id);
        }
        $user->update($data);
        if ($request->role) {
            $user->updateRoles($request->role);
        }
        Flashy::message('User update');

        return redirect()->back();
    }

    /**
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addUser(UserCreateRequest $request)
    {
        // dd($request->all());
        $data = $request->except('_token', 'role');
        //dd($data);
        $user = $this->createUser($data);

        $user->updateRoles($request->input('role'));

        Flashy::message('User create');
        return redirect()->route('user', $user->id);
    }

    /**
     * Delete user
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser(User $user)
    {
        $user->delete();

        Flashy::message('User Delete');
        return redirect()->route('users');
    }

    /**
     * @return mixed
     */
    public function getProfile()
    {
        return view('intranet.profile')->with('user', Auth::user());
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function debug(User $user)
    {
        Auth::login($user);

        return redirect()->route('portal');
    }
}
