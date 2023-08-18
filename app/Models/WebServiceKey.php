<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebServiceKey extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'web_service_keys';
    protected $fillable = ['api_key_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
