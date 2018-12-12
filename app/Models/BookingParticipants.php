<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model,
    App\Models\Traits\DataTrait;

/**
 * Class BookingParticipants
 * @package App\Models
 */
class BookingParticipants extends Model
{
    use DataTrait;

    /**
     * @var string
     */
    protected $table = 'booking_participants';

    /**
     * @var array
     */
    protected $fillable = [
        ///delete
        'id',
        'created_at',
        'updated_at',
        'data',
        'type',
        'share_hash',

        'booking_id',
        'booking_trainers_id',
        'user_id'
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     *
     */
    public static function boot()
    {
        parent::boot();
        self::dataBoot();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookingTrainer()
    {
        return $this->belongsTo(BookingTrainers::class, 'booking_trainers_id', 'id');
    }

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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function credits()
    {
        return $this->hasMany(BookingCredits::class, 'booking_participant_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
