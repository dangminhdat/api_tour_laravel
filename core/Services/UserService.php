<?php

namespace Core\Services;

use Core\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * Class UserService
 */
class UserService implements ServiceInterface
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * [__construct description]
     * @param UserRepository $repository [description]
     */
    public function __construct(UserRepository $repository)
    {
        return $this->repository = $repository;
    }

    /**
     * All
     * @return array
     */
    public function paginate()
    {
        return $this->repository->paginate();
    }

    /**
     * Find
     * @param int $id
     * @return array
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Store
     * @param array $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->repository->store($data);
    }

    /**
     * Update
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Destroy
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }

    /**
     * Select
     * @param array $condition
     * @return array
     */
    public function findWhere($condition)
    {
        return $this->repository->findWhere($condition);
    }

    /**
     * Login
     * @param string $username
     * @param string $passwrd
     * @return mixed
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

    /**
     * Select review of user
     * @param int $id
     * @return array
     */
    public function review_by_user($id)
    {
        return $this->repository->review_by_user($id);
    }
}
