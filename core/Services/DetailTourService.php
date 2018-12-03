<?php

namespace Core\Services;

use Core\Repositories\DetailTourRepository;
use Illuminate\Support\Facades\Hash;

class DetailTourService implements ServiceInterface
{
    protected $repository;

    public function __construct(DetailTourRepository $repository)
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

    public function detail_day_other($id)
    {
        return $this->repository->detail_day_other($id);
    }

    public function change_order($id)
    {
        return $this->repository->change_order($id);
    }

    public function get($id)
    {
        return $this->repository->get($id);
    }
}