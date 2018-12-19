<?php

namespace Core\Repositories;

use App\Review;

/**
 * Class ReviewRepository
 */
class ReviewRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * [__construct description]
     * @param Review $model [description]
     */
    public function __construct(Review $model)
    {
        $this->model = $model;
    }

    /**
     * All
     * @return array
     */
    public function paginate()
    {
        $reviews = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($reviews as $key => $review) {
            $reviewF = $this->model->where(["id" => $review["id"]])->first();
            $reviews[$key]['email'] = $reviewF->user->user_detail->email;
            $reviews[$key]['name'] = $reviewF->user->user_detail->fullname;
            $reviews[$key]['name_tour'] = $reviewF->tour->name;
            unset($reviews[$key]['id_tour']);
            unset($reviews[$key]['id_user']);
            unset($reviews[$key]['deleted_at']);
        }
        return $reviews;
    }

    /**
     * Find
     * @param int $id
     * @return array
     */
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

    /**
     * Select review of tour
     * @param int $id
     * @return array
     */
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
