<?php

namespace Core\Services;

use Core\Repositories\TourRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Class TourService
 */
class TourService implements ServiceInterface
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * [__construct description]
     * @param TourRepository $repository [description]
     */
    public function __construct(TourRepository $repository)
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
     * Select tour by location
     * @param int $id
     * @return array
     */
    public function tour_by_location($id)
    {
        return $this->repository->tour_by_location($id);
    }

    /**
     * Select tour sales
     * @return array
     */
    public function tour_by_sales()
    {
        return $this->repository->tour_by_sales();
    }

    /**
     * Select tour of type
     * @param int $id
     * @return array
     */
    public function tour_of_type($id)
    {
        return $this->repository->tour_of_type($id);
    }

    /**
     * Update tour
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateTour($id, $data)
    {
        return $this->repository->updateTour($id, $data);
    }

    /**
     * Select tour detail
     * @param int $id
     * @return array
     */
    public function find_tour_detail($id)
    {
        return $this->repository->find_tour_detail($id);
    }

    /**
     * Upload image
     * @param array $data
     * @return mixed
     */
    public function upload_image($data)
    {
        return $this->repository->upload_image($data);
    }

    /**
     * Select 5 tour latest
     * @return array
     */
    public function five_tour_latest()
    {
        return $this->repository->five_tour_latest();
    }

    /**
     * Select search tour
     * @param array $data
     * @return array
     */
    public function search_tour($data)
    {
        return $this->repository->search_tour($data);
    }

    /**
     * Add tour
     * @param array $data
     */
    public function add($data)
    {
        return $this->repository->add($data);
    }
}
