<?php

namespace App\Repositories;

use App\Models\UserAccessKey;

class UserAccessKeyRepository
{
    public function findById($id)
    {
        return UserAccessKey::find($id);
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
