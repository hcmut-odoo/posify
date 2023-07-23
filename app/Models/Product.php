<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'price', 'image_url', 'category_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
