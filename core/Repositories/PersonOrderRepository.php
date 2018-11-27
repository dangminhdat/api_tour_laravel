<?php

namespace Core\Repositories;

use App\PersonOrder;

class PersonOrderRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(PersonOrder $model)
    {
        $this->model = $model;
    }

    public function paginate()
    {
        $person = $this->model->where(['deleted_at' => 0])->get();
        return $person;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $model = $this->model->find($id);
        return $model->update($data);
    }

    public function destroy($id)
    {
        $model = $this->model->find($id);
        return $model->destroy($id);
    }
}