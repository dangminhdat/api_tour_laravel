<?php

namespace Core\Services;

use Core\Repositories\LocationRepository;

class LocationService implements ServiceInterface
{
    protected $repository;

    public function __construct(LocationRepository $repository)
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

    public function updateLocation($id, $data)
    {
        return $this->repository->updateLocation($id, $data);
    }

    public function favorite_four_location()
    {
        return $this->repository->favorite_four_location();
    }
}