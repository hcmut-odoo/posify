<?php

namespace App\Repositories;

use App\Models\PermissionActionGroup;

class PermissionActionGroupRepository
{
    public function findById($id)
    {
        return PermissionActionGroup::find($id);
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
