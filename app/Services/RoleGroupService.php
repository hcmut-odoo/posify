<?php

namespace App\Services;

use App\Repositories\RoleGroupRepository;

class RoleGroupService extends BaseService
{
    private $roleGroupRepository;

    public function __construct(RoleGroupRepository $roleGroupRepository)
    {
        $this->roleGroupRepository = $roleGroupRepository;
        parent::__construct();
    }

    public function getAll()
    {
        return $this->roleGroupRepository->getAll();
    }

    public function getById($id)
    {
        return $this->roleGroupRepository->get($id);
    }
}
