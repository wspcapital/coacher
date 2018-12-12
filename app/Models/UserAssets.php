<?php

namespace App\Models;

use App\Http\Controllers\Traits\CustomFunction,
    Illuminate\Database\Eloquent\Model;

/**
 * Class UserAssets
 * @package App\Models
 */
class UserAssets extends Model
{
    use CustomFunction;

    /**
     * @var string
     */
    protected $table = 'user_assets';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'asset_id',
        'type',
        'title',
        'category_id',
        'description',
        'blocked',
        'expires'
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
    public function asset()
    {
        return $this->belongsTo(Assets::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    /**
     * scope return all workshop video
     *
     * @param $query
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function scopeAllWorkshopVideo($query, $id)
    {
        return $this->getCategoryVideo($query, $id, 2);
    }

    /**
     * scope return all learning video
     *
     * @param $query
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function scopeAllLearningVideo($query, $id)
    {
        return $this->getCategoryVideo($query, $id, 3);
    }

    /**
     * scope return all learning video
     *
     * @param $query
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function scopeAllWebinarVideo($query, $id)
    {
        return $this->getCategoryVideo($query, $id, 4);
    }

    /**
     * Returns all video one category
     *
     * @param $query
     * @param int $userId
     * @param int $categoryId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCategoryVideo($query, $userId, $categoryId)
    {
        return $query->where('user_id', $userId)->where('category_id', $categoryId)
            ->where('blocked', '0')->with(['asset.media', 'asset.getDocVideos.docAssets.media'])->get();
    }
}
