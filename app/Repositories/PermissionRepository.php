<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository
{
    public function findById($id)
    {
        return Permission::find($id);
    }

    public function remove($id)
    {
        return Permission::where('id', $id)->delete();
    }

    public function create($name)
    {
        return Permission::create([
            'name' => $name
        ]);
    }

    public function getAll()
    {
        return Permission::all();
    }

    public function pagination($perPage, $page)
    {
        return Permission::paginate($perPage, ['*'], 'page', $page);
    }
}
