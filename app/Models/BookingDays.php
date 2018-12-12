<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BookingDays
 * @package App\Models
 */
class BookingDays extends Model
{
    /**
     * @var string
     */
    protected $table = 'booking_days';

    /**
     * @var array
     */
    protected $fillable = [
        'booking_id',
        'booking_date',
        'lesson_id',
        'time_start',
        'time_end',
        'title',
        'subtitle',
        'color'
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
