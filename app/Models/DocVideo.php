<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DocVideo
 * @package App\Models
 */
class DocVideo extends Model
{
    /**
     * @var string
     */
    protected $table = 'doc_videos';

    /**
     * @var array
     */
    protected $fillable = [
        'file_id',
        'doc_id',
    ];

    /**
     * @var array
     */
    protected $hidden =[];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function docAssets()
    {
        return $this->hasOne(Assets::class, 'id', 'doc_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function docVideo()
    {
        return $this->belongsTo(Assets::class);
    }
}
