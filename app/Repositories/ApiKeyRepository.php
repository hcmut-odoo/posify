<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\ApiKey;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApiKeyRepository
{
    public function get($id)
    {
        try {
            $apiKey = ApiKey::findOrFail($id);
            return $apiKey;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found api key has ID: $id");
        }
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
