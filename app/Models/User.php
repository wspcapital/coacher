<?php

namespace App\Models;

use App\Models\Traits\{
    UserTrait,
    LaratrustCustomTrait,
    CreditsTrait,
    DataTrait
};
use App\Mail\Intranet\{
    SessionCoachAssigned,
    VideoCoachAssigned
};
use Illuminate\Foundation\Auth\User as Authenticatable,
    Laratrust\Traits\LaratrustUserTrait,
    App\Http\Controllers\Traits\CustomFunction,
    Illuminate\Support\Facades\Mail,
    Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
    use LaratrustUserTrait,
        LaratrustCustomTrait,
        UserTrait,
        CustomFunction,
        CreditsTrait,
        DataTrait,
        Notifiable;

    //  Searchable;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        /// deleted !!!!!!!!
        'id',
        'created_at',
        'updated_at',
        'workshop_expires_at',
        'session_at',
        'login_at',
        'password',
        'passtext',
        'asset_id',


        'first_name',
        'last_name',
        'email',
        'company',
        'title',
        'website',
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'phone',
        'fax',
        'country',
        'blocked',
        'lang',
        'color',
        'data'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'passtext',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'login_at'
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
    public function bookingParticipant()
    {
        return $this->hasMany(BookingParticipants::class)->latest('created_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookingTrainer()
    {
        return $this->belongsTo(BookingTrainers::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function credits()
    {
        return $this->hasMany(BookingCredits::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function assistant()
    {
        return $this->hasOne(UserAssistants::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function formers()
    {
        return $this->hasMany(Formers::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function assets()
    {
        return $this->hasOne(Assets::class, 'id', 'asset_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatAuthor()
    {
        return $this->belongsTo(Chat::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatAddressee()
    {
        return $this->belongsTo(Chat::class);
    }

    /**
     * @param $assistantId
     */
    public function addAssistant($assistantId)
    {
        UserAssistants::updateOrCreate(['user_id' => $this->id], [
            'assistant_user_id' => $assistantId,
            'user_id' => $this->id
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function userAssets()
    {
        return $this->belongsToMany(UserAssets::class, 'id', 'user_id');
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @param $query
     * @param $keyword
     * @return mixed
     */
    public function scopeSearch($query, $keyword)
    {
        $arg = explode(' ', trim($keyword));
        // dd($arg);
        if ($keyword != '') {
            if (count($arg) > 1) {
                $query->where(function ($query) use ($arg) {
                    $query->where("first_name", "LIKE", "%$arg[0]%")
                        ->where("last_name", "LIKE", "%$arg[1]%")
                        ->orWhere("first_name", "LIKE", "%$arg[1]%")
                        ->where('last_name', "LIKE", "%$arg[0]%")
                        ->orWhereHas('bookingParticipant.booking.rm', function ($query) use ($arg) {
                            $query->where('first_name', 'like', "%$arg[0]%")
                                ->where('last_name', 'like', "%$arg[1]%")
                                ->orWhere('first_name', 'like', "%$arg[1]%")
                                ->where('last_name', 'like', "%$arg[0]%");
                        })
                        ->orWhereHas('bookingParticipant.bookingTrainer.user', function ($query) use ($arg) {
                            $query->where('first_name', 'like', "%$arg[0]%")
                                ->where('last_name', 'like', "%$arg[1]%")
                                ->orWhere('first_name', 'like', "%$arg[1]%")
                                ->where('last_name', 'like', "%$arg[0]%");
                        });
                });
            } else {
                $query->where(function ($query) use ($keyword) {
                    $query
                        ->where("first_name", "LIKE", "%$keyword%")
                        ->orWhere("last_name", "LIKE", "%$keyword%")
                        ->orWhere("company", "LIKE", "%$keyword%")
                        ->orWhere('email', "LIKE", "%$keyword%")
                        ->orWhereHas('bookingParticipant.booking.rm', function ($query) use ($keyword) {
                            $query->where('first_name', 'like', "%$keyword%");
                        })
                        ->orWhereHas('bookingParticipant.bookingTrainer.user', function ($query) use ($keyword) {
                            $query->where('first_name', 'like', "%$keyword%");
                        });
                });
            }
        }
        return $query;
    }

    /**
     * @param $query
     * @param $keyword
     * @return mixed
     */
    public function scopeCheckBlock($query)
    {
        return $query->where('blocked', "0");
    }


    /* E-MAILS */

    /**
     * @param string $type
     */
    public function sendCoachAssignedForUserMail($type = 'Session')
    {
        if ($type == 'Video') {
            Mail::to($this)->send(new VideoCoachAssigned($this));
        } else {
            Mail::to($this)->send(new SessionCoachAssigned($this));
        }
    }
}
