<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use Notifiable;

    protected $fillable = ['user_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
