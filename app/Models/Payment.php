<?php

namespace App\Models;

use App\Http\Controllers\Traits\CurrencyTrait,
    Illuminate\Database\Eloquent\Model,
    Illuminate\Support\Facades\Config;

/**
 * Class Payment
 * @package App\Models
 */
class Payment extends Model
{
    use CurrencyTrait;

    /**
     * @var string
     */
    protected $table = 'payments';

    /**
     * @var array
     */
    protected $fillable = [];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(PaymentItems::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * @return string
     */
    public function getAmountFormatAttribute()
    {
        $symbol = Config::get('payment.currencies.' . $this->attributes['currency'] . '.symbol');
        $this->setCurrencySymbol($symbol);

        return $this->currencyIntFormat($this->attributes['amount'], true);
    }

    /**
     * @return string
     */
    public function getStatusClass()
    {
        switch ($this->status) {
            case 'succeeded':
                return 'success';
            case 'failed':
                return 'danger';
            case 'unpaid':
            default:
                return 'default';
        }
    }
}
