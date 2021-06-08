<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model for post
 * @author  JP <jose03@simplexi.com.ph>
 * @version 1.0
 * @since   2021. 06. 04
 */
class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * guarded columns
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * get author that owns the post
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
