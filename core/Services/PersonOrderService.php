<?php

namespace Core\Services;

use Core\Repositories\PersonOrderRepository;

class PersonOrderService implements ServiceInterface
{
    protected $repository;

    public function __construct(PersonOrderRepository $repository)
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

    public function get_tour_of_user($id)
    {
        return $this->repository->get_tour_of_user($id);
    }
}