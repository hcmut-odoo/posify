<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\Resource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ResourceRepository
{
    public function findById($id)
    {
        try {
            $resource = Resource::findOrFail($id);
            return $resource;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found resource has ID: $id");
        }
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
