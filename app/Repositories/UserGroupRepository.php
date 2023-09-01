<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\UserGroup;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserGroupRepository
{
    public function get($id)
    {
        try {
            $userGroup = UserGroup::findOrFail($id);
            return $userGroup;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found user group has ID: $id");
        }
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
