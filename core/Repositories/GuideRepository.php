<?php

namespace Core\Repositories;

use App\Guide;

class GuideRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Guide $model)
    {
        $this->model = $model;
    }

    public function paginate()
    {
        $guides = $this->model->where(["deleted_at" => 0])->get()->toArray();
        foreach ($guides as $s => $guide) {
        	unset($guides[$s]['deleted_at']);
        }
        return $guides;
    }

    public function find($id)
    {
        $guide = $this->model->where(["deleted_at" => 0, "id" => $id])->first();
        unset($guide['deleted_at']);
        return $guide;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $model = $this->model->where(["deleted_at" => 0, "id" => $id]);
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
    public function findWhere($condition)
    {
        $model = $this->model->where($condition);
        return $model->first();
    }
}