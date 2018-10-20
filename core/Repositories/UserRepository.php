<?php

namespace Core\Repositories;

use App\User;
use App\UserDetail;

class UserRepository implements RepositoryInterface
{
    protected $model;
    protected $model_detail;

    public function __construct(User $model, UserDetail $detail)
    {
        $this->model = $model;
        $this->model_detail = $detail;
    }

    public function paginate()
    {
        $paginate = array();
        $user_detail = $this->model_detail->where("deleted_at", 0)->get()->toArray();
        foreach ($user_detail as $key => $value) {
            $arr = array_merge($this->model->where(["id" => $value['id_user'], "deleted_at" => 0])->first()->toArray(), $value);
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
        $user = array_merge($user->toArray(), $user_detail->toArray());
        unset($user['user_detail']);
        unset($user['deleted_at']);
        unset($user['remember_token']);

        return $user;
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
        $model = $this->find($id);
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