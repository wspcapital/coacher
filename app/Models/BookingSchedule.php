<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingSchedule extends Model
{
    protected $table = 'booking_schedules';

    protected $fillable = [
        'booking_id',
        'booking_day',
        'start',
        'end'
    ];

    protected $hidden = [];
}
