<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserAssistants
 * @package App\Models
 */
class UserAssistants extends Model
{
    /**
     * @var string
     */
    protected $table = 'user_assistants';

    /**
     * @var array
     */
    protected $fillable = [
        ///delete
        'created_at',
        'updated_at',

        'assistant_user_id',
        'user_id',
        'comment'
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
