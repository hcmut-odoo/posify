<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\RoleGroup;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleGroupRepository
{
    public function get($id)
    {
        try {
            $resource = RoleGroup::findOrFail($id);
            return $resource;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found role group has ID: $id");
        }
    }

    public function getByGroupId($groupId)
    {
        return RoleGroup::where('group_id', $groupId)
            ->select('role_groups.action_id')
            ->get()
            ->toArray();
    }

    public function remove($id)
    {
        return RoleGroup::where('id', $id)->delete();
    }

    public function create($groupId, $actionId)
    {
        return RoleGroup::create([
            'group_id' => $groupId,
            'action_id' => $actionId
        ]);
    }

    public function getAll()
    {
        return RoleGroup::all();
    }

    public function pagination($perPage, $page)
    {
        return RoleGroup::paginate($perPage, ['*'], 'page', $page);
    }
}
