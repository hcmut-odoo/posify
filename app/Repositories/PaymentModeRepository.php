<?php

namespace App\Repositories;

use App\Models\PaymentMode;
use Illuminate\Support\Facades\DB;

class PaymentModeRepository
{
    public function get($id)
    {
        return PaymentMode::find($id);
    }

    public function findByName($name)
    {
        return PaymentMode::where('name', $name)->firstOrFail();
    }

    public function create($name)
    {
        return PaymentMode::create([
            'name' => $name
        ]);
    }

    public function remove($id)
    {
        return PaymentMode::where('id', $id)->delete();
    }

    public function getAll()
    {
        return PaymentMode::get();
    }

    public function pagination($perPage, $page)
    {
        return PaymentMode::paginate($perPage, ['*'], 'page', $page);
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
            return DB::table('payment_modes')
                ->where('id', $data['id'])
                ->update($updateData);
        }

        return false;
    }
}
