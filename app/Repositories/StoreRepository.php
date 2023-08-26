<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\Store;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreRepository
{
    public function get($id)
    {
        try {
            $store = Store::findOrFail($id);
            return $store;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found store has ID: $id");
        }
    }

    public function findByName($name)
    {
        return Store::where('name', $name)->first();
    }

    public function create($name, $status, $phone, $openTime, $imageUrl, $address)
    {
        return Store::create([
            'name' => $name,
            'status' => $status,
            'address' => $address,
            'open_time' => $openTime,
            'phone' => $phone,
            'image_url' => $imageUrl
        ]);
    }

    public function remove($id)
    {
        return Store::where('id', $id)->delete();
    }

    public function getAll()
    {
        return Store::get();
    }

    public function pagination($perPage, $page)
    {
        return Store::paginate($perPage, ['*'], 'page', $page);
    }

    public function update($data)
    {
        $fields = ['name', 'status', 'phone', 'image_url', 'open_time', 'address'];
        $updateData = [];

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $updateData[$field] = $data[$field];
            }
        }

        if (!empty($updateData)) {
            return DB::table('stores')
                ->where('id', $data['id'])
                ->update($updateData);
        }

        return false;
    }
}
