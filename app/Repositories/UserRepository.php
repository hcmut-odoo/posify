<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function get($id)
    {
        return DB::table('users')->where('id', $id)->get();
    }

    public function remove($id)
    {
        return DB::table('users')->where('id', $id)->delete();
    }

    public function getAll()
    {
        return DB::table('users')->get();
    }

    public function pagination($perPage, $page)
    {
        return DB::table('users')->paginate($perPage, ['*'], 'page', $page);
    }
}
