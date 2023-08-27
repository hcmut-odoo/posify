<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\Tax;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class TaxRepository
{
    public function get($id)
    {
        try {
            $store = Tax::findOrFail($id);
            return $store;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found tax has ID: $id");
        }
    }

    public function findByName($name)
    {
        return Tax::where('name', $name)->first();
    }

    public function create($name, $value)
    {
        return Tax::create([
            'name' => $name,
            'value' => $value
        ]);
    }

    public function remove($id)
    {
        return Tax::where('id', $id)->delete();
    }

    public function getAll()
    {
        return Tax::get();
    }

    public function pagination($perPage, $page)
    {
        return Tax::paginate($perPage, ['*'], 'page', $page);
    }

    public function update($data)
    {
        $fields = ['name', 'value'];
        $updateData = [];

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $updateData[$field] = $data[$field];
            }
        }

        if (!empty($updateData)) {
            return DB::table('taxes')
                ->where('id', $data['id'])
                ->update($updateData);
        }

        return false;
    }
}
