<?php

namespace Core\Services;

use Core\Repositories\TourRepository;
use Illuminate\Support\Facades\Hash;

class TourService implements ServiceInterface
{
    protected $repository;

    public function __construct(TourRepository $repository)
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

    public function tour_by_location($id)
    {
        return $this->repository->tour_by_location($id);
    }

    public function tour_by_sales()
    {
        return $this->repository->tour_by_sales();
    }

    public function tour_of_type($id)
    {
        return $this->repository->tour_of_type($id);
    }

    public function updateTour($id, $data)
    {
        return $this->repository->updateTour($id, $data);
    }

    public function find_tour_detail($id)
    {
        return $this->repository->find_tour_detail($id);
    }
}