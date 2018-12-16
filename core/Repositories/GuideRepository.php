<?php

namespace Core\Repositories;

use App\Guide;

/**
 * Class GuideRepository
 */
class GuideRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * [__construct description]
     * @param Guide $model [description]
     */
    public function __construct(Guide $model)
    {
        $this->model = $model;
    }

    /**
     * All
     * @return array
     */
    public function paginate()
    {
        $guides = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($guides as $s => $guide) {
        	unset($guides[$s]['deleted_at']);
        }
        return $guides;
    }

    /**
     * Find
     * @param int $id
     * @return array
     */
    public function find($id)
    {
        $guide = $this->model->where(["deleted_at" => 0, "id" => $id])->first();
        unset($guide['deleted_at']);
        return $guide;
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
