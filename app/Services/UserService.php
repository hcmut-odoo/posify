<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService extends BaseService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    public function getById($id)
    {
        return $this->userRepository->get($id);
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }
}
