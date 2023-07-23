<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function __construct()
    {
    }

    public function getAllUsers()
    {
        return User::all();
    }
}
