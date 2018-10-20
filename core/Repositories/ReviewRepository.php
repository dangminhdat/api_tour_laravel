<?php

namespace Core\Repositories;

use App\Review;

class ReviewRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Review $model)
    {
        $this->model = $model;
    }

    public function paginate()
    {
        $reviews = $this->model->where(["deleted_at" => 0])->get()->toArray();
        foreach ($reviews as $s => $review) {
        	unset($reviews[$s]['deleted_at']);
        }
        return $reviews;
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $model = $this->model->where(["deleted_at" => 0, "id_user" => $id]);
        return $model->update($data);
    }

    public function destroy($id)
    {
        $model = $this->find($id);
        return $model->destroy($id);
    }

    public function findWhere($condition)
    {
        $model = $this->model->where($condition);
        return $model->first();
    }
}