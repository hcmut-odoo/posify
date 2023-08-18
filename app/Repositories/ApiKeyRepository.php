<?php

namespace App\Repositories;

use App\Models\ApiKey;
use Carbon\Carbon;

class ApiKeyRepository
{
    public function get($id)
    {
        return ApiKey::find($id);
    }

    public function getByKey($key)
    {
        return ApiKey::where('value', $key)->first();
    }

    public function remove($id)
    {
        return ApiKey::where('id', $id)->delete();
    }

    public function create($key, $description)
    {
        $currentDate = Carbon::now();
        $nextTwoMonths = $currentDate->addMonths(2);

        return ApiKey::create([
            'value' => $key,
            'description' => $description,
            'expired_at' => $nextTwoMonths
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
