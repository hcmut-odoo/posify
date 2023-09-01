<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\Permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PermissionRepository
{
    public function get($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            return $permission;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found permission has ID: $id");
        }
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
