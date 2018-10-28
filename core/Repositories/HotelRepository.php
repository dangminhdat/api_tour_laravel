<?php

namespace Core\Repositories;

use App\Hotel;

class HotelRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Hotel $model)
    {
        $this->model = $model;
    }

    public function paginate()
    {
        $hotels = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($hotels as $s => $hotel) {
        	unset($hotels[$s]['deleted_at']);
        }
        return $hotels;
    }

    public function find($id)
    {
        $hotel = $this->model->where(["deleted_at" => 0, "id" => $id])->first();
        unset($hotel['deleted_at']);
        return $hotel;
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