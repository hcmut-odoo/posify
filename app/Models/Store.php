<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'status', 'phone', 'image_url', 'open_time', 'address'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
