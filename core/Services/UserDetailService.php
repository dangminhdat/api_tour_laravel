<?php

namespace Core\Services;

use Core\Repositories\UserDetailRepository;
use Illuminate\Support\Facades\Hash;

class UserDetailService implements ServiceInterface
{
    protected $repository;

    public function __construct(UserDetailRepository $repository)
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

    public function findEmail($email)
    {
        return $this->repository->findWhere(["email" => $email]);
    }
}