<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model,
    Illuminate\Support\Facades\DB;

/**
 * Class Coupon
 * @package App\Models
 */
class Coupon extends Model
{
    /**
     * @var string
     */
    protected $table = 'coupons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'code',
        'discount',
        'vcoaches',
        'sessions'
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'discount' => 'integer',
        'vcoaches' => 'integer',
        'sessions' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * @param $value
     */
    public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = (bool)$value;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Check if coupon is available for use.
     *
     * @return boolean
     */
    public function checkAvailable()
    {
        return $this->is_active == true;
    }

    /**
     * Set `is_active` field to false.
     *
     * @return boolean
     */
    public function deactivate()
    {
        if ($this->is_active) {
            $this->is_active = false;
            return $this->save();
        }

        return true;
    }

    /**
     * @param $data
     * @param int $count
     */
    public function generateCoupon($data, $count = 1)
    {
        do {
            $coupons = [];
            for ($i = 0; $i < $count; $i++) {
                $coupons[] = $this->generateCouponCode();
            }
            $existCode = DB::table('coupons')
                ->whereIn('code', $coupons)
                ->pluck('code');
        } while ($existCode->count() != 0);
        DB::transaction(function () use (&$coupons, &$data) {
            $data = array_except($data, ['code']);
            foreach ($coupons as $code) {
                Coupon::create(compact('code') + $data);
            }
        });
    }

    /**
     * @return string
     */
    protected function generateCouponCode()
    {
        $length = 16;
        $pool = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        $code = implode('-', str_split(substr(str_shuffle(str_repeat($pool, $length)), 0, $length), 4));

        return $code;
    }

    /**
     * @return string
     */
    public function getTypeClass()
    {
        switch ($this->type) {
            case 'discount':
                return 'info';
            case 'free':
                return 'primary';
            default:
                return 'default';
        }
    }
}
