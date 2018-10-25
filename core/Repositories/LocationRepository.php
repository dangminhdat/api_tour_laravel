<?php

namespace Core\Repositories;

use App\Location;

class LocationRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Location $model)
    {
        $this->model = $model;
    }

    public function paginate()
    {
        $locations = $this->model->where(["deleted_at" => 0])->get()->toArray();
        foreach ($locations as $s => $location) {
        	unset($locations[$s]['deleted_at']);
        }
        return $locations;
    }

    public function find($id)
    {
        $location = $this->model->where(["deleted_at" => 0, "id" => $id])->first();
        unset($location['deleted_at']);
        return $location;
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
        $model = $this->model->find($id);
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