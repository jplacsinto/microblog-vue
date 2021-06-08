<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * Model for user
 * @author  JP <jose03@simplexi.com.ph>
 * @version 1.0
 * @since   2021. 06. 04
 */
class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * hidden columns
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * get all posts from the user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
