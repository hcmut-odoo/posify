<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryRepository
{
    public function get($id)
    {
        return Category::find($id);
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

        if (!empty($updateData)) {
            return DB::table('categories')
                ->where('id', $data['id'])
                ->update($updateData);
        }

        return false;
    }
}
