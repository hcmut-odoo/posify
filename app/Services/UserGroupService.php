<?php

namespace App\Services;

use App\Repositories\UserGroupRepository;

class UserGroupService extends BaseService
{
    private $userGroupRepository;

    public function __construct(UserGroupRepository $userGroupRepository)
    {
        $this->userGroupRepository = $userGroupRepository;
        parent::__construct();
    }

    public function getAll()
    {
        return $this->userGroupRepository->getAll();
    }

    public function findById($id)
    {
        return $this->userGroupRepository->get($id);
    }
}
