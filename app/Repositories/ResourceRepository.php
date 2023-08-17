<?php

namespace App\Repositories;

use App\Models\Resource;

class ResourceRepository
{
    public function findById($id)
    {
        return Resource::find($id);
    }

    public function findByName($name)
    {
        return Resource::where('name', $name)->first();
    }

    public function remove($id)
    {
        return Resource::where('id', $id)->delete();
    }

    public function create($name)
    {
        return Resource::create([
            'name' => $name
        ]);
    }

    public function getAll()
    {
        return Resource::all();
    }

    public function pagination($perPage, $page)
    {
        return Resource::paginate($perPage, ['*'], 'page', $page);
    }
}
