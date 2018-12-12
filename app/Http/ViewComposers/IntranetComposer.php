<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 23.01.2017
 * Time: 22:19
 */

namespace App\Http\ViewComposers;

use App\Models\Booking,
    App\Models\Order,
    App\Models\User,
    Illuminate\Support\Facades\Auth,
    Illuminate\View\View;

class IntranetComposer
{
    protected $user;

    public function __construct(User $user)
    {
        // Dependencies automatically resolved by service container...
        $this->user = Auth::user();
    }

    public function compose(View $view)
    {
        $today = date('Y-m');

        $workshopCount = Booking::whereHas('bookingTrainers', function ($q) {
            $q->where('user_id', $this->user->id);
        })->whereRaw("DATE_FORMAT(`start_date`,'%Y-%m') = '{$today}'")
            ->count();

        $coachingCount = Order::where('order_trainer_id', $this->user->id)->where('status', '<',
            3)->where('status', '>', 0)->where('source', '!=', 'Bulk')->count();

        $view->with([
            'user' => $this->user,
            'workshopCount' => $workshopCount,
            'coachingCount' => $coachingCount
        ]);
    }
}
