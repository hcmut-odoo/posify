<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
    }

    public function profile(Request $request)
    {
        $user = Auth::user();

        try {
            if ($request->isMethod('POST')) {
                $data = $this->validate($request, [
                    'name' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string', 'max:255'],
                    'phone_number' => ['required', 'regex:/^0[1-9][0-9]{7,14}$/'],
                    'email' => ['required', 'string', 'email', 'max:255'],
                ]);

                $data["id"] = $user->id;
                $this->userService->updateUser($data);

                Session::flash('message', "Profile was updated successfully");
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Session::flash('message', "An error occurred: " . $e->getMessage());
        }

        return view('profile', [
            'user' => $user
        ]);
    }

}
