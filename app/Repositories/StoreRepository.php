<?php

namespace App\Repositories;

use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreRepository
{
    public function get($id)
    {
        return Store::find($id);
    }

    public function remove($id)
    {
        return Store::where('id', $id)->delete();
    }

    public function getAll()
    {
        return Store::get();
    }

    public function pagination($perPage, $page)
    {
        return Store::paginate($perPage, ['*'], 'page', $page);
    }
}
