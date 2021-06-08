<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Eloquent\BaseEloquentRepository;
use App\Repositories\PostRepositoryInterface;

/**
 * Post Repository
 * @author  JP <jose03@simplexi.com.ph>
 * @version 1.0
 * @since   2021. 06. 04
 */
class PostRepository extends BaseEloquentRepository implements PostRepositoryInterface
{

    /**
     * main constructor
     * @param Post $oModel
     */
    public function __construct(Post $oModel)
    {
        $this->oModel = $oModel;
    }

    // repository methods starts here
}
