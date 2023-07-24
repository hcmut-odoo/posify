<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'user_group_id'];

    public function roleGroup()
    {
        return $this->hasMany(RoleGroup::class);
    }
}
