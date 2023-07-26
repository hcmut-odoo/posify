<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = $this->userService->getAll();

        return view('/admin/users/users', [
            'users' => $users
        ]);
    }

    public function viewUser(Request $request, $id)
    {
        $user = $this->userService->findById($id);

        return view('/admin/users/user_detail', [
            'user' => $user
        ]);
    }

    public function createUser(Request $request)
    {
        if($request->getMethod() === 'POST') {
            $data = $request->only(['name', 'role', 'email', 'password', 'address', 'phone_number']);
            $user = $this->userService->createUser(...array_values($data));

            if ($user) {
                Session::flash('message', 'User was created successfully!');
            } else {
                Session::flash('message', 'Failed to create user!');
            }
            return redirect()->back();
        }

        return view('/admin/users/create_user');
    }

    public function updateUser(Request $request, $id)
    {
        if($request->getMethod() === 'POST') {
            $data = $request->only(['name', 'role', 'email', 'password', 'address', 'phone_number']);
            $user = $this->userService->updateUser(...array_values($data));

            if ($user) {
                Session::flash('message', 'User was updated successfully!');
            } else {
                Session::flash('message', 'Failed to update user!');
            }
            return redirect()->back();
        }

        $user = $this->userService->findById($id);
        return view('/admin/users/user_update', [
            'user' => $user
        ]);
    }

    public function deleteUser(Request $request, $id)
    {
        $isDeleted = $this->userService->deleteUser($id);
        if ($isDeleted) {
            Session::flash('message', 'User was deleted successfully!');
        } else {
            Session::flash('message', 'Failed to delete user!');
        }

        return redirect()->back();
    }
}
