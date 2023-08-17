<?php

namespace App\Repositories;

use App\Models\WebServiceKey;

class WebServiceKeyRepository
{
    public function findById($id)
    {
        return WebServiceKey::find($id);
    }

    public function remove($id)
    {
        return WebServiceKey::where('id', $id)->delete();
    }

    public function create($apiKeyId)
    {
        return WebServiceKey::create([
            'api_key_id' => $apiKeyId
        ]);
    }

    public function getAll()
    {
        return WebServiceKey::all();
    }

    public function pagination($perPage, $page)
    {
        return WebServiceKey::paginate($perPage, ['*'], 'page', $page);
    }

    public function findByApiKeyId($apiKeyId)
    {
        return WebServiceKey::where('api_key_id', $apiKeyId)->first();
    }
}
