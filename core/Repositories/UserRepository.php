<?php

namespace Core\Repositories;

use App\User;

class UserRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function paginate()
    {
        $paginate = array();
        $users = $this->model->where("deleted_at", 0)->orderBy('id', 'DESC')->get();
        foreach ($users as $key => $user) {
            $userF = $this->model->where(["id" => $user['id'], "deleted_at" => 0])->first();
            $arr = array_merge($userF->toArray(), $userF->user_detail->toArray());
            $arr['id_group'] = $userF->group->first()->id;
            unset($arr['deleted_at']);
            unset($arr['id_user']);
            unset($arr['remember_token']);
            $paginate[] = $arr;
        }
        return $paginate;
    }

    public function find($id)
    {
        // get user by id
        $user = $this->model->where(["deleted_at" => 0, "id" => $id])->first();
        // get data user detail
        $user_detail = $user->user_detail;
        unset($user_detail['id']);
        unset($user_detail['id_user']);
        $userR = array_merge($user->toArray(), $user_detail->toArray());
        $userR['id_group'] = $user->group->first()->id;
        unset($userR['user_detail']);
        unset($userR['deleted_at']);
        unset($userR['remember_token']);

        return $userR;
    }

    public function store($data)
    {
        $store = $this->model->create($data);
        $store->group()->attach($data['id_group']);
        return $store;
    }

    public function update($id, $data)
    {
        $model = $this->model->where(["deleted_at" => 0, "id" => $id]);
        if (!empty($data['id_group'])) {
            $model->first()->group()->detach();
            $model->first()->group()->attach($data['id_group']);
            unset($data['id_group']);
        }
        $update = $model->update($data);
        return $update;
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

    public function review_by_user($id)
    {
        $user = $this->model->where(["id" => $id, "deleted_at" => 0])->first();
        $reviews = $user->review;
        $result = array();
        foreach ($reviews as $key => $review) {
            if (!$review->deleted_at) {
                $reviews[$key]['name_tour'] = $review->tour->name;
                unset($reviews[$key]['deleted_at']);
                unset($reviews[$key]['id_user']);
                unset($reviews[$key]['tour']);

                $result[] = $reviews[$key];
            }
        }
        return $result;
    }
}