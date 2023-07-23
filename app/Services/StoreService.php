<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\StoreRepository;

class StoreService
{
    private $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function getAll()
    {
        return $this->storeRepository->getAll();
    }
}
