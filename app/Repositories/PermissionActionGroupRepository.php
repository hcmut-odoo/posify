<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\PermissionActionGroup;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PermissionActionGroupRepository
{
    public function get($id)
    {
        try {
            $permissionActionGroup = PermissionActionGroup::findOrFail($id);
            return $permissionActionGroup;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found permission action group has ID: $id");
        }
    }

    public function findByActionIdAndWebServiceKeyId($actionId, $webServiceKeyId)
    {
        return PermissionActionGroup::where('action_id', $actionId)
            ->where('web_service_key_id', $webServiceKeyId)
            ->first();
    }

    public function remove($id)
    {
        return PermissionActionGroup::where('id', $id)->delete();
    }

    public function create($actionId, $webServiceKeyId)
    {
        return PermissionActionGroup::create([
            'action_id' => $actionId,
            'web_service_key_id' => $webServiceKeyId
        ]);
    }

    public function getAll()
    {
        return PermissionActionGroup::all();
    }

    public function pagination($perPage, $page)
    {
        return PermissionActionGroup::paginate($perPage, ['*'], 'page', $page);
    }

    public function getActionIdsByWebserviceKeyId($webServiceKeyId)
    {
        return PermissionActionGroup::where('web_service_key_id', $webServiceKeyId)->get()->toArray();
    }
}
