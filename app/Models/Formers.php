<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Formers
 * @package App\Models
 */
class Formers extends Model
{
    /**
     * @var string
     */
    protected $table = 'formers';

    /**
     * @var array
     */
    protected $fillable = [
        'former_id',
        'user_id',
        'comment',
        'type'
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @param $order
     * @return mixed
     */
    public function scopeSaveBeforeOrderTrainer($query, $order)
    {
        return $this->createBeforeTrainer($order, 'Order_trainer');
    }

    /**
     * @param $order
     * @param $type
     * @return mixed
     */
    public function createBeforeTrainer($order, $type)
    {
        return Formers::updateOrCreate(['former_id' => $order->id], [
            'former_id' => $order->id,
            'user_id' => $order->order_trainer_id,
            'type' => $type
        ]);
    }
}
