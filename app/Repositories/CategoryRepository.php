<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryRepository
{
    public function get($id)
    {
        try {
            $category = Category::findOrFail($id);
            return $category;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found category has ID: $id");
        }
    }

    public function findByName($name)
    {
        return Category::where('name', $name)->first();
    }

    public function create($name)
    {
        return Category::create(['name' => $name]);
    }

    public function remove($id)
    {
        return Category::where('id', $id)->delete();
    }

    public function getAll()
    {
        return Category::all();
    }

    public function pagination($perPage, $page)
    {
        return Category::paginate($perPage, ['*'], 'page', $page);
    }

    public function update($data)
    {
        $fields = ['name'];
        $updateData = [];

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $updateData[$field] = $data[$field];
            }
        }

        $updateData['updated_at'] = now();

        if (!empty($updateData)) {
            return DB::table('categories')
                ->where('id', $data['id'])
                ->update($updateData);
        }

        return false;
    }
}
