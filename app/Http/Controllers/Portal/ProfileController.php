<?php

namespace App\Http\Controllers\Portal;

use App\Models\User,
    Illuminate\Http\Request,
    App\Http\Controllers\Controller,
    Illuminate\Support\Facades\Auth,
    MercurySeries\Flashy\Flashy;

class ProfileController extends Controller
{
    /**
     * Return user profile
     *
     * @param Request $request
     * @return $this
     */
    public function getIndex()
    {
        return view('portal.profile')->with([
            'user' => User::find(Auth::user()->id)
        ]);
    }

    /**
     * Update User
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveUser(Request $request)
    {
        $user = User::find($request->user_id);
        $user->update($request->all());
        //$user->updateRoles($request->role);
        Flashy::message('Profile update');

        return redirect()->back();
    }
}
