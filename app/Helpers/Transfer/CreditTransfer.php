<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 03.02.17
 * Time: 12:00
 */

namespace App\Helpers\Transfer;

use App\Models\Booking,
    App\Models\BookingCredits;

class CreditTransfer extends Transfer
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @param $user
     * @return mixed
     */
    public static function transfer($user)
    {
        $transfer = new CreditTransfer($user);
        $transfer->saveCredit();
    }

    public function saveCredit()
    {
        if (is_numeric($this->user->sessions)) {
            $bookingId = $this->getLastBooking();
            if ($bookingId != null) {
                BookingCredits::create([
                    'credited_user_id' => 10,
                    'booking_id' => $bookingId,
                    'type' => 'Session',
                    'amount' => $this->user->sessions,
                    'user_id' => $this->user->id
                ]);
                BookingCredits::create([
                    'credited_user_id' => 10,
                    'booking_id' => $bookingId,
                    'type' => 'Vcoach',
                    'amount' => $this->user->vcoaches,
                    'user_id' => $this->user->id
                ]);
            }
        }
    }

    public function getLastBooking()
    {
        return Booking::whereHas('bookingParticipants', function ($q) {
            $q->where('user_id', $this->user->id);
        })->orderBy('created_at', 'desc')->first()->id ?? null;
    }
}
