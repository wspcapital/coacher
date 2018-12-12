<?php

namespace App\Models;

use App\Http\Controllers\Traits\CustomFunction,
    Illuminate\Database\Eloquent\Model,
    App\Models\Traits\DataTrait,
    Carbon\Carbon;

/**
 * Class Order
 * @package App\Models
 */
class Order extends Model
{
    use CustomFunction,
        DataTrait;

    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        ///delete
        'id',
        'created_at',
        'updated_at',

        'booking_participants_id',
        'order_trainer_id',
        'due_at',
        'timezone',
        'source',
        'status',
        'type',
        'data',
        'admin_notes',
        'coach_notes'
    ];

    /**
     * @var array
     */
    protected $appends = [
        'due_at'
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
        'due_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookingParticipants()
    {
        return $this->belongsTo(BookingParticipants::class);
    }

    /**
     * @param $value
     */
    public function setDueAtAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['due_at'] = date('Y-m-d H:i:s', strtotime($value));
        }
    }

    /**
     * @param $value
     * @return false|null|string
     */
    public function getDueAtAttribute($value)
    {
        if (!$value) {
            return null;
        }

        return Carbon::parse($value)->format('m/d/y h:i a');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderAssets()
    {
        return $this->hasMany(OrderAssets::class, 'orders_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookingParticipant()
    {
        return $this->belongsTo(BookingParticipants::class, 'booking_participants_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderTrainer()
    {
        return $this->belongsTo(User::class, 'order_trainer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function beforeTrainer()
    {
        return $this->hasOne(Formers::class, 'former_id');
    }

    /**
     * Return order status
     *
     * @return string
     */
    public function getStatus()
    {
        $status = [
            0 => 'Activated',
            1 => 'Assigned',
            2 => 'Date Set',
            3 => 'Completed'
        ];

        return $status[$this->status];
    }

    /**
     * @param string $key
     * @return null
     */
    public function getIna(string $key)
    {
        //dd($this->getData('ina'));
        return $this->getData('ina')->$key ?? null;
    }

    /**
     * @param string $key
     * @return null
     */
    public function getData(string $key)
    {
        //dd($this->data->ina);
        return $this->data->$key ?? null;
    }

    /**
     * @return mixed
     */
    public function getVCoachVideo()
    {
        return $this->orderAssets()->where('category_id', '1')->with(['assets', 'orders'])->first();
    }

    /**
     * @return null
     */
    public function getVpr()
    {
        return $this->orderAssets()->where('category_id', '5')->with(['assets'])->first() ?? null;
    }

    /**
     * @return mixed
     */
    public function saveBeforeOrderTrainer()
    {
        return Formers::saveBeforeOrderTrainer($this);
    }

    /**
     * @param $query
     * @param $keyword
     * @return mixed
     */
    public function scopeSearch($query, $keyword)
    {
        if ($keyword != '') {
            $arrayKeyword = array_diff(explode(' ', trim($keyword)), array(''));
            $query->where(function ($query) use ($arrayKeyword) {
                $query->whereHas('bookingParticipant.user', function ($q) use ($arrayKeyword) {
                    foreach ($arrayKeyword as $k => $v) {
                        $q->where('first_name', "LIKE", "%$v%")
                            ->orWhere('last_name', "LIKE", "%$v%")
                            ->orWhere('company', "LIKE", "%$v%");
                    }
                });
            })->orWhere(function ($query) use ($arrayKeyword) {
                $query->whereHas('orderTrainer', function ($q) use ($arrayKeyword) {
                    foreach ($arrayKeyword as $k => $v) {
                        $q->where('first_name', "LIKE", "%$v%")
                            ->orWhere('last_name', "LIKE", "%$v%");
                    }
                });
            })->orWhere(function ($query) use ($arrayKeyword) {
                $query->whereHas('bookingParticipant.booking.rm', function ($q) use ($arrayKeyword) {
                    foreach ($arrayKeyword as $k => $v) {
                        $q->where('first_name', "LIKE", "%$v%")
                            ->orWhere('last_name', "LIKE", "%$v%");
                    }
                });
            });
        }
        return $query;
    }
    /*  public function scopeSedarch($query, $keyword)
      {
          if ($keyword != '') {
              $query->where(function ($query) use ($keyword) {
                  $query->where("first_name", "LIKE", "%$keyword%")
                      ->orWhere("last_name", "LIKE", "%$keyword%")
                      ->orWhere("company", "LIKE", "%$keyword%");
              });
          }
          return $query;
      }*/
}
