<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model,
    Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\{
    HasMedia,
    HasMediaConversions
};

/**
 * Class Assets
 * @package App\Models
 */
class Assets extends Model implements HasMedia, HasMediaConversions
{

    use HasMediaTrait;

    /**
     * @var string
     */
    protected $table = 'assets';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        ///delete
        'id',

        'user_id',
        'type'
    ];

    /**
     * @var array
     */
    protected $hidden = ['converted'];

    /**
     * @var array
     */
    protected $dates = [
        'created_at'
    ];

    /**
     * Video Preview
     */
    public function registerMediaConversions()
    {
        $this->addMediaConversion('preview')
            ->setManipulations(['w' => 290, 'h' => 160])
            ->setExtractVideoFrameAtSecond(1)
            ->performOnCollections('video');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function orderAssets()
    {
        return $this->hasOne(OrderAssets::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookingAssets()
    {
        return $this->hasOne(BookingAssets::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userAssets()
    {
        return $this->hasOne(UserAssets::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lib()
    {
        return $this->hasOne(Lib::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function docVideos()
    {
        return $this->belongsTo(DocVideo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getDocVideos()
    {
        return $this->hasOne(DocVideo::class, 'file_id', 'id');
    }

    /**
     * scope delete video
     *
     * @param $query
     * @param integer $id
     * @return mixed
     */
    public function scopeDeleteFile($query, $id)
    {
        return $query->find($id)->delete();
    }
}
