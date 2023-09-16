<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'products';
    protected $fillable = ['name', 'description', 'price', 'image_url', 'category_id', 'tax_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
