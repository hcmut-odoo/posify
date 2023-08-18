<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionActionGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'permission_action_groups';
    protected $fillable = ['action_id', 'web_service_key_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
