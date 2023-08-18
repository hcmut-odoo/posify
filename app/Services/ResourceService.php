<?php

namespace App\Services;

use App\Repositories\ResourceRepository;

class ResrouceService extends BaseService
{
    private $resourceRepository;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
        parent::__construct();
    }

    public function getAllResources()
    {
        return $this->resourceRepository->getAll();   
    }
}
