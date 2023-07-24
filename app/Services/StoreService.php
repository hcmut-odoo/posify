<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\StoreRepository;

class StoreService extends BaseService
{
    private $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
        parent::__construct();
    }

    public function getAll()
    {
        return $this->storeRepository->getAll();
    }

    public function getById($id)
    {
        return $this->storeRepository->get($id);
    }
}
