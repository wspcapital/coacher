<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lesson
 * @package App\Models
 */
class Lesson extends Model
{
    /**
     * @var string
     */
    protected $table = 'lessons';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'time',
        'pdf'
    ];

    /**
     * @var array
     */
    protected $hidden = [];
}
