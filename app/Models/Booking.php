<?php

namespace App\Models;

use App\Http\Controllers\Traits\CustomFunction,
    Illuminate\Database\Eloquent\Model,
    App\Models\Traits\DataTrait;

/**
 * Class Booking
 * @package App\Models
 */
class Booking extends Model
{
    use CustomFunction,
        DataTrait;

    /**
     * @var string
     */
    protected $table = 'bookings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //// Delete
        'id',
        "created_at",
        "updated_at",

        'start_date',
        'end_date',
        'booker_user_id',
        'rm_user_id',
        'type',
        'title',
        'company',
        'company_website',
        'company_contact',
        'client_phone',
        'client_email',
        'details',
        'location_name',
        'location_city',
        'location_state',
        'location_address',
        'location_zip',
        'location_country',
        'preport',
        'cap_required',
        'gna',
        'evaluation',
        'customwb',
        'pdp',
        'ina_type',
        'workbook',
        'part',
        'vcoaches',
        'sessions',
        'pdpship',
        'noteship',
        'pdptrack',
        'generalnote',
        'readybook',
        'event_hotels',
        'travelnotes',
        'accommodations',
        'corporate_rate',
        'transfer',
        'expenses',
        'expenses_complete',
        'materials',
        'site_contact_fname',
        'site_contact_lname',
        'site_contact_phone',
        'site_contact_email',
        'shipping',
        'restaurants'
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'start_date',
        'end_date'
    ];

    /**
     * @var array
     */
    public $types = [
        'Workshop',
        'Rouser',
        'Tradeshow',
        'Webinar',
        'ELS',
        'ELS + Workshop'
    ];

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
    public function rm()
    {
        return $this->belongsTo(User::class, 'rm_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function booker()
    {
        return $this->belongsTo(User::class, 'booker_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function bookingParticipants()
    {
        return $this->hasMany(BookingParticipants::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function bookingTrainers()
    {
        return $this->hasMany(BookingTrainers::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function bookingDays()
    {
        return $this->hasMany(BookingDays::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function bookingSchedules()
    {
        return $this->hasMany(BookingSchedule::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookingAssets()
    {
        return $this->hasMany(BookingAssets::class);
    }

    /**
     * Search
     *
     * @param $query
     * @param $keyword
     * @return mixed
     */
    public function scopeSearch($query, $keyword)
    {
        if ($keyword != '') {
            $query->where(function ($query) use ($keyword) {
                $query->where("company", "LIKE", "%$keyword%")
                    ->orWhere("company_contact", "LIKE", "%$keyword%")
                    ->orWhere("location_city", "LIKE", "%$keyword%")
                    ->orWhere("location_country", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }
}
