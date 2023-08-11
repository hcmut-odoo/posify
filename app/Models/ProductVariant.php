<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_variants';
    protected $fillable = ['product_id', 'size', 'color', 'stock_qty'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
