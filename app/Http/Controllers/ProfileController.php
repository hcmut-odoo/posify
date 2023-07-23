<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->middleware('auth');
        $this->profileService = $profileService;
    }

    public function profile(Request $request)
    {
        $updateSuccess = false;
        $user = Auth::user();

        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8|confirmed',
            ]);

            $updateSuccess = $this->profileService->updateProfile($user, $request);

            if ($updateSuccess) {
                $updateSuccess = true;
            }
        }

        return view('profile', [
            'user' => $user,
            'updateSuccess' => $updateSuccess,
        ]);
    }
}
