<?php

namespace App\Repositories;

use App\Models\ApiKey;

class ApiKeyRepository
{
    public function get($id)
    {
        return ApiKey::find($id);
    }

    public function getByKey($key)
    {
        return ApiKey::where('key', $key)->first();
    }

    public function remove($id)
    {
        return ApiKey::where('id', $id)->delete();
    }

    public function create($key, $userId)
    {
        return ApiKey::create([
            'key' => $key,
            'user_id' => $userId
        ]);
    }

    public function getAll()
    {
        return ApiKey::all();
    }

    public function pagination($perPage, $page)
    {
        return ApiKey::paginate($perPage, ['*'], 'page', $page);
    }
}
