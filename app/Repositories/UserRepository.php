<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function get($id)
    {
        try {
            $user = User::findOrFail($id);
            return $user;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException("Not found user has ID: $id");
        }
    }

    public function getByEmail($email)
    {
        return User::find($email, 'email');
    }

    public function create($email, $name, $role, $address, $phoneNumber, $hashedPassword)
    {
        return User::create([
            'email' => $email,
            'name' => $name,
            'role' => $role,
            'address' => $address,
            'phone_number' => $phoneNumber,
            'password' => $hashedPassword,
        ]);
    }

    public function remove($id)
    {
        return User::where('id', $id)->delete();
    }

    public function getAll()
    {
        return User::get();
    }

    public function pagination($perPage, $page)
    {
        return User::paginate($perPage, ['*'], 'page', $page);
    }

    public function update($data)
    {
        $fields = ['name', 'role', 'email', 'password', 'address', 'phone_number'];
        $updateData = [];

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $updateData[$field] = $data[$field];
            }
        }

        $updateData['updated_at'] = now();

        if (!empty($updateData)) {
            return DB::table('users')
                ->where('id', $data['id'])
                ->update($updateData);
        }

        return false;
    }

    public function getUserAddress($id)
    {
        return User::find($id, ['address', 'phone_number', 'created_at', 'updated_at']);
    }
}
