<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use App\Services\Contracts\UserServiceInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
	private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Creating user
     *
     * @param $data    data of the user   
     *
     * @return User data
     */
    public function create($data)
    {
    	$data = array_merge($data, [
            'password' => bcrypt($data['password'])
        ]);

        return $this->userRepository->create($data);
    }
}
