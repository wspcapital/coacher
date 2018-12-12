<?php

namespace App\Models;

use Laratrust\LaratrustRole;

/**
 * Class Role
 * @package App\Models
 */
class Role extends LaratrustRole
{
    /**
     * @var string
     */
    protected $table = 'roles';

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @var array
     */
    protected $hidden = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roleUsers()
    {
        return $this->hasMany(RoleUser::class);
    }
}
