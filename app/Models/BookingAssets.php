<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BookingAssets
 * @package App\Models
 */
class BookingAssets extends Model
{
    /**
     * @var string
     */
    protected $table = 'booking_assets';

    /**
     * @var array
     */
    protected $fillable = [
        'booking_id',
        'asset_id',
        'expires',
        'blocked',
        'category_id'
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assets()
    {
        return $this->belongsTo(Assets::class, 'asset_id', 'id');
    }
}
