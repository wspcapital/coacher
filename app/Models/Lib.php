<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lib
 * @package App\Models
 */
class Lib extends Model
{
    /**
     * @var string
     */
    protected $table = 'libs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'asset_id'
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asset()
    {
        return $this->belongsTo(Assets::class);
    }

    /**
     * @param $query
     * @param $keyword
     * @return mixed
     */
    public function scopeSearch($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("title", "LIKE", "%$keyword%")
                      ->orWhere("description", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }
}
