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
            try {
                $user = $this->userService->createUser($data);
                Session::flash('message', 'User was created successfully!');

                return redirect()->route('admin.user.view', ['id' => $user->id]);
            } catch (\Exception $e) {
                Session::flash('message', 'Failed to create user!');

                return redirect()->route('admin.user.create.get');
            }
        }

        return view('/admin/users/create_user');
    }

    public function updateUser(Request $request, $id)
    {
        if($request->getMethod() === 'POST') {
            $data = $request->only(['id', 'name', 'role', 'email', 'password', 'address', 'phone_number']);
            $id = $id ?? $data['id'];

            try {
                $user = $this->userService->updateUser($data);
                Session::flash('message', 'User was updated successfully!');

                return redirect()->route('admin.user.update.get', ['id' => $id]);
            } catch (\Exception $e) {
                Session::flash('message', 'Failed to updated user!');

                return redirect()->route('admin.user.update.get', ['id' => $id]);
            }
        }

        $user = $this->userService->findById($id);
        return view('/admin/users/user_update', [
            'user' => $user
        ]);
    }

    public function deleteUser(Request $request, $id)
    {
        try {
            $this->userService->deleteUser($id);
            Session::flash('message', 'User was deleted successfully!');
        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
        }

        return redirect()->back();
    }
}
