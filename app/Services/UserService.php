<?php

namespace App\Services;

use App\Exceptions\DeleteFailedException;
use App\Repositories\UserRepository;
use App\Exceptions\InvalidParameterException;
use App\Exceptions\NotFoundException;
use App\Exceptions\DuplicateEntryException;
use App\Exceptions\UpdateFailedException;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    public function findById($id)
    {
        if(!validate_id($id) ) {
            throw new InvalidParameterException("Invalid user ID: $id");
        }
        $user = $this->userRepository->get($id);
        if (!$user) {
            throw new NotFoundException("Not found user has ID: $id");
        }
        return $user;
    }

    public function createUser($data)
    {
        $name = $data['name'];
        $role = $data['role'];
        $address = $data['address'];
        $phoneNumber = $data['phone_number'];
        $email = $data['email'];
        $password = $data['password'];
        if ($this->userRepository->getByEmail($email)) {
            throw new DuplicateEntryException("Email $email is already exist");
        }
        $hashedPassword = Hash::make($password);
        return $this->userRepository->create($email, $name, $role, $address, $phoneNumber, $hashedPassword);
    }

    public function updateUser($data)
    {
        $id = $data['id'];
        $email = $data['email'];

        $user = $this->userRepository->get($id);
        if (!$user) {
            throw new NotFoundException("Not found user");
        }

        if (isset($email)) {
            $existingUser = $this->userRepository->getByEmail($email);
            if ($existingUser && $existingUser->id !== $id) {
                throw new DuplicateEntryException("Email $email is already in use");
            }
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        if ($this->userRepository->update($data)) {
            return $this->userRepository->get($id);
        } else {
            throw new UpdateFailedException("Update failed user record has ID: $id");
        }
    }

    public function deleteUser($id)
    {
        if(!validate_parameter($id)) {
            throw new InvalidParameterException("Invalid user ID");
        }
        if(!$this->userRepository->get($id)) {
            throw new NotFoundException("Not found user");
        }
        if (!$this->userRepository->remove($id)) {
            throw new DeleteFailedException("Failed to delete user has ID: $id");
        }
    }
}
