<?php

namespace App\Repositories;

use App\Models\UserGroup;

class UserGroupRepository
{
    public function get($id)
    {
        return UserGroup::find($id);
    }

    public function remove($id)
    {
        return UserGroup::where('id', $id)->delete();
    }

    public function create($name, $description, $permission)
    {
        return UserGroup::create([
            'name' => $name,
            'description' => $description,
            'permission' => $permission
        ]);
    }

    public function getAll()
    {
        return UserGroup::all();
    }

    public function pagination($perPage, $page)
    {
        return UserGroup::paginate($perPage, ['*'], 'page', $page);
    }
}
