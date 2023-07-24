<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name, description, permission'];

    public function roleGroup()
    {
        return $this->hasMany(RoleGroup::class);
    }
}
