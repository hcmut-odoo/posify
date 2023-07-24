<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class ProfileService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function updateProfile($user, $requestData)
    {
        $user->name = $requestData->input('name');
        $user->email = $requestData->input('email');

        if ($requestData->has('password')) {
            $user->password = bcrypt($requestData->input('password'));
        }

        return $user->save();
    }
}
