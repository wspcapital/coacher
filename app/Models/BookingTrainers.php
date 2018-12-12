<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BookingTrainers
 * @package App\Models
 */
class BookingTrainers extends Model
{
    /**
     * @var string
     */
    protected $table = 'booking_trainers';

    /**
     * @var array
     */
    protected $fillable = [
        ///delete
        'id',
        'created_at',
        'updated_at',
        'hotel_book',
        'hotel_name',
        'hotel_address',
        'flight_book',
        'flight_info',
        'car_rental_book',
        'car_rental',
        'note',


        'booking_id',
        'user_id'
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookingParticipants()
    {
        return $this->hasOne(BookingParticipants::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
