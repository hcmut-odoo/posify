<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'resources';
    protected $fillable = ['name'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
