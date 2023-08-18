<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class ResrouceService extends BaseService
{
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
        parent::__construct();
    }

    public function getAllPermissions()
    {
        return $this->permissionRepository->getAll();
    }
}
