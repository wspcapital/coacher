<?php
/**
 * Created by PhpStorm.
 * User: silivanov
 * Date: 18.01.17
 * Time: 13:46
 */

namespace App\Models\Traits;

use App\Models\Booking,
    App\Models\Order,
    App\Models\BookingCredits;

/**
 * Class CreditsTrait
 * @package App\Models\Traits
 */
trait CreditsTrait
{
    /**
     * Returns the number of vcoaches
     *
     * @return int
     */
    public function getVCoaches(): int
    {
        return $this->getAmountCredits('VCoach', $this->getLastBookingId());
    }

    /**
     * Returns the number of sessions
     *
     * @return int
     */
    public function getSessions(): int
    {
        return $this->getAmountCredits('Session', $this->getLastBookingId());
    }

    /**
     * Returns the number of booking sessions
     *
     * @param integer $bookingId
     * @return int
     */
    public function getBookingSessions($bookingId): int
    {
        return $this->getAmountCredits('Session', $bookingId);
    }

    /**
     * Returns the number of booking vcoaches
     *
     * @param integer $bookingId
     * @return int
     */
    public function getBookingVCoaches($bookingId): int
    {
        return $this->getAmountCredits('VCoach', $bookingId);
    }

    /**
     * Returns the number of vcoaches used
     *
     * @return int
     */
    public function getUsedVCoaches(): int
    {
        return $this->getUsedCredit('Video');
    }

    /**
     * Returns the number of sessions used
     *
     * @return int
     */
    public function getUsedSessions(): int
    {
        return $this->getUsedCredit('Session');
    }

    /**
     * Returns the sum of sessions
     *
     * @return int
     */
    public function getTotalSessions(): int
    {
        return $this->getSessions() + $this->getUsedSessions();
    }

    /**
     * Returns the sum of vcoaches
     *
     * @return int
     */
    public function getTotalVCoaches(): int
    {
        return $this->getVCoaches() + $this->getUsedVCoaches();
    }


    /**
     * Return amount credit
     *
     * @param string $type
     * @param int $bookingId
     * @return int
     */
    private function getAmountCredits(string $type, $bookingId): int
    {
        if ($bookingId == null) {
            return 0;
        } else {
            return $this->getCredits($type, $bookingId)->amount ?? 0;
        }

    }

    /**
     * Return collection credit
     *
     * @param string $type
     * @param int $bookingId
     * @return int| \Illuminate\Database\Eloquent\Collection
     */
    public function getCredits(string $type, int $bookingId)
    {
        $credits = $this->credits()->where('type', $type)->where('booking_id', $bookingId);
        if ($credits->count() == 0) {
            return 0;
        } else {
            return $credits->orderBy('created_at', 'desc')->first();
        }
    }

    /**
     * Returns the number of credits used
     *
     * @param $type
     * @return int
     */
    public function getUsedCredit($type): int
    {
        return Order::where('type', $type)->whereHas('bookingParticipants', function ($q) {
            $q->where('user_id', $this->id)->where('booking_id', $this->getLastBookingId());
        })->count();
    }

    /**
     * Return last booking id or null
     *
     * @return null | integer
     */
    public function getLastBookingId()
    {
        return Booking::whereHas('bookingParticipants', function ($q) {
                $q->where('user_id', $this->id);
        })->orderBy('created_at', 'desc')->first()->id ?? null;
    }

    /**
     * Add vcoaches
     *
     * @param $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response|static
     */
    public function addVcoaches($request)
    {
        if (is_numeric($request->vcoaches)) {
            return $this->addCredits('vcoach', $request->except('_token'), $request->vcoaches);
        } else {
            return response('The vcoach must be a number.', 503);
        }
    }

    /**
     * Add sessions
     *
     * @param $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response|static
     */
    public function addSessions($request)
    {
        if (is_numeric($request->sessions)) {
            return $this->addCredits('session', $request->except('_token'), $request->sessions);
        } else {
            return response('The session must be a number.', 503);
        }
    }

    /**
     * Create credit
     *
     * @param string $type
     * @param array $data
     * @param integer $quantity
     * @return static
     */
    private function addCredits(string $type, array $data, int $quantity)
    {
        $data['credited_user_id'] = $this->id;
        $data['type'] = $type;
        $data['amount'] = $quantity;

        return BookingCredits::create($data);
    }

    /**
     * Use one vcoach credit
     *
     * @return static
     */
    public function useVCoach()
    {
        return $this->useCredit('vcoach');
    }

    /**
     * Use one session credit
     *
     * @return static
     */
    public function useSession()
    {
        return $this->useCredit('session');
    }

    /**
     * Use one credit
     *
     * @param string $type
     * @return static
     */
    public function useCredit(string $type)
    {
        $credit = $this->getCredits($type, $this->getLastBookingId());
        return $this->addCredits($type, $credit->toArray(), $credit->amount - 1);
    }
}
