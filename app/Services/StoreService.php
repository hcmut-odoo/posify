<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Exceptions\DeleteFailedException;
use App\Exceptions\DuplicateEntryException;
use App\Exceptions\InvalidParameterException;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateFailedException;
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

    public function findById($id)
    {
        return $this->storeRepository->get($id);
    }

    public function updateStore($data)
    {
        $storeId = $data['id'];
        if (!$this->storeRepository->get($storeId)) {
            throw new NotFoundException("Not found store has ID: $storeId");
        }
        if ($this->storeRepository->update($data)) {
            return $this->storeRepository->get($storeId);
        } else {
            throw new UpdateFailedException("Update failed store record has ID: $storeId");
        }
    }

    public function createStore($data)
    {
        $name = $data['name'];
        $status = $data['status'];
        $phone = $data['phone'];
        $imageUrl = $data['image_url'];
        $openTime = $data['open_time'];
        $address = $data['address'];

        if (!$this->storeRepository->findByName($name)) {
            throw new DuplicateEntryException("Name `$name` already exist in store records");
        }
        return $this->storeRepository->create($name, $status, $phone, $openTime, $imageUrl, $address);
    }

    public function deleteStore($id)
    {
        if(!validate_id($id)) {
            throw new InvalidParameterException("Invalid store ID $id");
        }
        if(!$this->storeRepository->get($id)) {
            throw new InvalidParameterException("Not found store has ID: $id");
        }
        if (!$this->storeRepository->remove($id)) {
            throw new DeleteFailedException("Failed to delete store has ID: $id");
        }
    }
}
