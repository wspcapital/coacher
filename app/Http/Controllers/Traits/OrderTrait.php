<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 06.01.17
 * Time: 13:05
 */

namespace App\Http\Controllers\Traits;

use App\Models\BookingParticipants,
    Illuminate\Support\Facades\Auth;
use App\Models\Order;

trait OrderTrait
{
    /*public function getUserOrder(string $type)
    {
        $order = [];
        foreach (BookingParticipants::where('user_id', Auth::user()->id)->get() as $participant) {
            foreach ($participant->orders->where('type', $type) as $oneOrder) {
                array_push($order, $oneOrder);
            }
        }
        return $order;
    }*/

    public function getUserOrder($type)
    {
        return Order::whereHas('BookingParticipants', function ($query) use ($type) {
            $query->where('user_id', Auth::user()->id);
        })->where('type', $type)->get();
    }

    public function getScheduled()
    {
        $order = Order::whereHas('BookingParticipants', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->where('type', 'Session')->orderBy('due_at', 'desc')->first();
        return $order->due_at ?? null;
    }
}
