<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderAssets
 * @package App\Models
 */
class OrderAssets extends Model
{
    /**
     * @var string
     */
    protected $table = 'order_assets';

    /**
     * @var array
     */
    protected $fillable = [
        'category_id',
        'orders_id',
        'assets_id'
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @var array
     */
    protected $dates = [
        'created_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assets()
    {
        return $this->belongsTo(Assets::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
