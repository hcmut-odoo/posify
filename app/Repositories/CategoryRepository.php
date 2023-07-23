<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryRepository
{
    public function get($id)
    {
        return Category::where('id', $id)->get();
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
}
