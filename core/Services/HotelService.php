<?php

namespace Core\Services;

use Core\Repositories\HotelRepository;

/**
 * Class HotelService
 */
class HotelService implements ServiceInterface
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * [__construct description]
     * @param HotelRepository $repository [description]
     */
    public function __construct(HotelRepository $repository)
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
     * @param string $name
     * @return array
     */
    public function findName($name)
    {
        return $this->repository->findWhere(["name" => $name]);
    }
}
