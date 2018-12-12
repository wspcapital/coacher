<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 01.02.17
 * Time: 13:12
 */

namespace App\Http\ViewComposers;

use App\Models\BookingParticipants;
use App\Models\User,
    Illuminate\Contracts\View\View,
    Illuminate\Support\Facades\Auth;

class PortalComposer
{
    protected $user;

    public function __construct(User $user)
    {
        // Dependencies automatically resolved by service container...
        $this->user = Auth::user();
    }

    public function compose(View $view)
    {
        $b = BookingParticipants::where('user_id', $this->user->id)->with(['orders' => function ($query) {
            $query->where('type', 'Video')->get();
        }])->get();

        $vpr = [];
        foreach ($b as $one) {
            foreach ($one->orders as $order) {
                if ($order->orderAssets->count() > 0) {
                    //'//video' => $order->getVCoachVideo(),
                    if ($order->getVpr() != null) {
                        $vpr[] = $order->getVpr();
                    }
                }
            }
        }
        $view->with([
            'user' => $this->user,
            'vprs' => $vpr
        ]);
    }
}
