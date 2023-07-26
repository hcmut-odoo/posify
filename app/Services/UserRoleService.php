<?php

namespace App\Services;

use App\Repositories\UserRoleRepository;

class UserRoleService extends BaseService
{
    private $userRoleRepository;

    public function __construct(UserRoleRepository $userRoleRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
        parent::__construct();
    }

    public function getAll()
    {
        return $this->userRoleRepository->getAll();
    }

    public function findById($id)
    {
        return $this->userRoleRepository->get($id);
    }

    public function getByUserId($userId)
    {
        return $this->userRoleRepository->getByUserId($userId);
    }
}
