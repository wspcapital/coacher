<?php

namespace App\Models;

use App\Http\Controllers\Traits\CustomFunction,
    Illuminate\Database\Eloquent\Model;

/**
 * Class BookingCredits
 * @package App\Models
 */
class BookingCredits extends Model
{
    use CustomFunction;

    /**
     * @var string
     */
    protected $table = 'booking_credits';

    /**
     * @var array
     */
    protected $fillable = [
        'credited_user_id',
        'type',
        'booking_id',
        'user_id',
        'amount',
        'comment'
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creditor()
    {
        return $this->hasOne(User::class, 'id', 'credited_user_id');
    }
}
