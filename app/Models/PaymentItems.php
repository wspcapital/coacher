<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentItems
 * @package App\Models
 */
class PaymentItems extends Model
{
    /**
     * @var string
     */
    protected $table = 'payment_items';

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
    public function items()
    {
        return $this->belongsTo(Payment::class);
    }
}
