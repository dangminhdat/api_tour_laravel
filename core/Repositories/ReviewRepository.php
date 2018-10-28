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
        $reviews = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($reviews as $key => $review) {
            $reviewF = $this->model->findOrFail($review['id']);
            $reviews[$key]['email'] = $reviewF->user->user_detail->email;
            $reviews[$key]['name'] = $reviewF->user->user_detail->fullname;
            $reviews[$key]['name_tour'] = $reviewF->tour->name;
            unset($reviews[$key]['id_tour']);
            unset($reviews[$key]['id_user']);
            unset($reviews[$key]['deleted_at']);
        }
        return $reviews;
    }

    public function find($id)
    {
        $review = $this->model->where(["deleted_at" => 0, "id" => $id])->first();
        $review['email'] = $review->user->user_detail->email;
        $review['name'] = $review->user->user_detail->fullname;
        $review->name_tour = $review->tour->name;
        unset($review->deleted_at);
        unset($review->tour);
        unset($review->id_tour);
        unset($review->user);
        unset($review->id_user);
        return $review;
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

    public function findWhere($condition)
    {
        $model = $this->model->where($condition);
        return $model->first();
    }

    public function review_by_tour($id)
    {
        $reviews = $this->model->where(["deleted_at" => 0, "id_tour" => $id])->orderBy('id', 'DESC')->get();
        foreach ($reviews as $key => $review) {
            $reviews[$key]['email'] = $review->user->user_detail->email;
            $reviews[$key]['name'] = $review->user->user_detail->fullname;
            $reviews[$key]['name_tour'] = $review->tour->name;
            unset($reviews[$key]['id_tour']);
            unset($reviews[$key]['id_user']);
            unset($reviews[$key]['user']);
            unset($reviews[$key]['tour']);
            unset($reviews[$key]['deleted_at']);
        }
        return $reviews;
    }
}