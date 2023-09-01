<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\WebServiceKey;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WebServiceKeyRepository
{
    public function findById($id)
    {
        try {
            $webServiceKey = WebServiceKey::findOrFail($id);
            return $webServiceKey;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found web service key has ID: $id");
        }
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
