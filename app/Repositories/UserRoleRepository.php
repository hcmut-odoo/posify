<?php

namespace App\Repositories;

use App\Models\UserRole;
use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRoleRepository
{
    public function get($id)
    {
        try {
            $user = UserRole::findOrFail($id);
            return $user;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found user has ID: $id");
        }
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
