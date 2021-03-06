<?php

namespace Core\Repositories;

use App\Formality;

class FormalityRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Formality $model)
    {
        $this->model = $model;
    }

    public function paginate()
    {
        return $this->model->all();
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