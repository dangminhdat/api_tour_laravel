<?php

namespace Core\Repositories;

use App\User;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function paginate()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $model = $this->find($id);
        return $model->update($data);
    }

    public function destroy($id)
    {
        $model = $this->find($id);
        return $model->destroy($id);
    }

    /**
     * Select username use eloquent
     * 
     * @param  string $username
     * @return object $model
     */
    public function login($username)
    {
        $model = $this->model
            ->where("username", $username);
        return $model->first();
    }

}