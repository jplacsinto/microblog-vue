<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Eloquent\BaseEloquentRepository;
use App\Repositories\UserRepositoryInterface;

/**
 * User Repository
 * @author  JP <jose03@simplexi.com.ph>
 * @version 1.0
 * @since   2021. 06. 04
 */
class UserRepository extends BaseEloquentRepository implements UserRepositoryInterface
{

    /**
     * main constructor
     *
     * @param User $oModel
     */
    public function __construct(User $oModel)
    {
        $this->oModel = $oModel;
    }
}
