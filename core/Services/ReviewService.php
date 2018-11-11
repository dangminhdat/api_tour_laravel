<?php

namespace Core\Services;

use Core\Repositories\ReviewRepository;
use Illuminate\Support\Facades\Hash;

class ReviewService implements ServiceInterface
{
    protected $repository;

    public function __construct(ReviewRepository $repository)
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

    public function review_by_tour($id)
    {
        return $this->repository->review_by_tour($id);
    }
}