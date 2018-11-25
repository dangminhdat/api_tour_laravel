<?php

namespace Core\Services;

use Core\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserService implements ServiceInterface
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        return $this->repository = $repository;
    }

    public function paginate()
    {
        return $this->repository->paginate();
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

    public function findWhere($condition)
    {
        return $this->repository->findWhere($condition);
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
        $user = $this->repository->findWhere(["username" => $username, "deleted_at" => 0, "active" => 1]);
        if (!empty($user) && Hash::check($password, $user->password)) {
            // Update remember_token
            $user->remember_token = JWTAuth::attempt(['username' => $username, 'password' => $password]);
            return ($user->save())? $user->remember_token : false;
        }
        return false;
    }

    public function review_by_user($id)
    {
        return $this->repository->review_by_user($id);
    }
}