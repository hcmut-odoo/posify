<?php

namespace App\Repositories;

use App\Models\UserRole;

class UserRoleRepository
{
    public function get($id)
    {
        return UserRole::find($id);
    }

    public function getByUserId($userId)
    {
        return UserRole::where('user_id', $userId)->first();;
    }

    public function remove($id)
    {
        return UserRole::where('id', $id)->delete();
    }

    public function create($userId, $groupId)
    {
        return UserRole::create([
            'user_id' => $userId,
            'group_id' => $groupId
        ]);
    }

    public function getAll()
    {
        return UserRole::all();
    }

    public function pagination($perPage, $page)
    {
        return UserRole::paginate($perPage, ['*'], 'page', $page);
    }
}
