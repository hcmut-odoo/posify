<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if ($request->has('password')) {
                $user->password = bcrypt($request->input('password'));
            }

            if ($user->save()) {
                $updateSuccess = true;
            }
        }

        return view('profile', [
            'user' => $user,
            'updateSuccess' => $updateSuccess,
        ]);
    }


}
