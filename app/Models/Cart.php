<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cart extends Model
{
    use Notifiable, HasFactory;

    protected $fillable = ['user_id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
