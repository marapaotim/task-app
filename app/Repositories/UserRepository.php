<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
