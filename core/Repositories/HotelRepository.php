<?php

namespace Core\Repositories;

use App\Hotel;

/**
 * Class HotelRepository
 */
class HotelRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * [__construct description]
     * @param Hotel $model [description]
     */
    public function __construct(Hotel $model)
    {
        $this->model = $model;
    }

    /**
     * All
     * @return array
     */
    public function paginate()
    {
        $hotels = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($hotels as $s => $hotel) {
        	unset($hotels[$s]['deleted_at']);
        }
        return $hotels;
    }

    /**
     * Find
     * @param int $id
     * @return array
     */
    public function find($id)
    {
        $hotel = $this->model->where(["deleted_at" => 0, "id" => $id])->first();
        unset($hotel['deleted_at']);
        return $hotel;
    }

    /**
     * Store
     * @param array $data
     * @return mixed
     */
    public function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * Update
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $model = $this->model->where(["deleted_at" => 0, "id" => $id]);
        return $model->update($data);
    }

    /**
     * Destroy
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        return $model->destroy($id);
    }

    /**
     * Select
     * @param array $condition
     * @return array
     */
    public function findWhere($condition)
    {
        $model = $this->model->where($condition);
        return $model->first();
    }
}
