<?php

namespace Core\Repositories;

use App\UserDetail;

/**
 * Class UserDetailRepository
 */
class UserDetailRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * [__construct description]
     * @param UserDetail $model [description]
     */
    public function __construct(UserDetail $model)
    {
        $this->model = $model;
    }

    /**
     * All
     * @return array
     */
    public function paginate()
    {
        return $this->model->all()->toArray();
    }

    /**
     * Find
     * @param int $id
     * @return array
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
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
        $model = $this->model->where(["deleted_at" => 0, "id_user" => $id]);
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
     * Edit profile
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function edit_profile($id, $data)
    {
        $model = $this->model->where(["deleted_at" => 0, "id" => $id]);
        if (isset($data['avatar'])) {
            $upload = public_path()."/uploads/";
            if(!is_dir($upload)) {
                mkdir($upload);
            }
            $ext = explode('.',$data['avatar']['name']);
            $ext = $ext[count($ext) - 1];
            $tmp = $data['avatar']['tmp_name'];
            $name = uniqid()."-".date("Y-m-d-H-i-s").'.'.$ext;
            if(@move_uploaded_file($tmp, $upload.$name)) {
                $data['avatar'] = "/uploads/".$name;
            }
        }
        $update = $model->update($data);
        return $update;
    }
}
