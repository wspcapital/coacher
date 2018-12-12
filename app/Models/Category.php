<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Models
 */
class Category extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'title',
        'description',
        'type',
        'blocked'
    ];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lib()
    {
        return $this->hasMany(Lib::class);
    }

    /**
     * @return mixed
     */
    public function getChildrenCategory()
    {
        return Category::where('parent_id', $this->id)->get();
    }

    /**
     * @return mixed
     */
    public function getParentCategory()
    {
        return Category::where('id', $this->parent_id)->first();
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeAllWorkshopVideo($query, $id)
    {
        return $this->getCategoryVideo($query, $id, 2);
    }
}
