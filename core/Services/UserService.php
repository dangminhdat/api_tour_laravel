<?php

namespace Core\Services;

use Core\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        return $this->repository = $repository;
    }

    public function paginate()
    {
        return $this->repository->paginate()->toArray();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function store($data)
    {
        return $this->repository->store($data);
    }

    public function update($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }

    /**
     * Service lgin
     * 
     * @param  string $username
     * @param  string $passwrd
     * @return boolean
     */
    public function login($username, $password)
    {
        // Find username
        $user = $this->repository->login($username);
        if (!empty($user) && Hash::check($password, $user->password)) {
            // Update remember_token
            $user->remember_token = str_random(50);
            return ($user->save())? $user->remember_token : false;
        }
        return false;
    }
}