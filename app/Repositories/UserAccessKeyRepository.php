<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\UserAccessKey;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserAccessKeyRepository
{
    public function findById($id)
    {
        try {
            $userAccessKey = UserAccessKey::findOrFail($id);
            return $userAccessKey;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found user access key has ID: $id");
        }
    }

    public function remove($id)
    {
        return UserAccessKey::where('id', $id)->delete();
    }

    public function create($name)
    {
        return UserAccessKey::create([
            'name' => $name
        ]);
    }

    public function getAll()
    {
        return UserAccessKey::all();
    }

    public function pagination($perPage, $page)
    {
        return UserAccessKey::paginate($perPage, ['*'], 'page', $page);
    }
}
