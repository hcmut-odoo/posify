<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Store extends Model
{
    protected $fillable = ['name', 'status', 'phone', 'image_url', 'open_time', 'address'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
