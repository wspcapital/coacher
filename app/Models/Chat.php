<?php

namespace App\Models;

use App\Http\Controllers\Traits\CustomFunction,
    Illuminate\Database\Eloquent\Model;

/**
 * Class Chat
 * @package App\Models
 */
class Chat extends Model
{
    use CustomFunction;

    /**
     * @var string
     */
    protected $table = 'chats';

    /**
     * @var array
     */
    protected $fillable = [
        'author',
        'addressee',
        'message',
        'review'
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userAuthor()
    {
        return $this->hasOne(User::class, 'id', 'author');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userAddressee()
    {
        return $this->hasMany(User::class, 'id', 'addressee');
    }
}
