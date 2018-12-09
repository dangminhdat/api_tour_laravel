<?php

namespace Core\Services;

use Core\Repositories\ReviewRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Class ReviewService
 */
class ReviewService implements ServiceInterface
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * [__construct description]
     * @param ReviewRepository $repository [description]
     */
    public function __construct(ReviewRepository $repository)
    {
        return $this->repository = $repository;
    }

    /**
     * All
     * @return array
     */
    public function paginate()
    {
        return $this->repository->paginate();
    }

    /**
     * Find
     * @param int $id
     * @return array
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Store
     * @param array $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->repository->store($data);
    }

    /**
     * Update
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Destroy
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }

    /**
     * Select
     * @param array $condition
     * @return array
     */
    public function findWhere($condition)
    {
        return $this->repository->findWhere($condition);
    }

    /**
     * Select review of tour
     * @param int $id
     * @return array
     */
    public function review_by_tour($id)
    {
        return $this->repository->review_by_tour($id);
    }
}
