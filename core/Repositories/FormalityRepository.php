<?php

namespace Core\Repositories;

use App\Formality;

/**
 * Class FormalityRepository
 */
class FormalityRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * [__construct description]
     * @param Formality $model [description]
     */
    public function __construct(Formality $model)
    {
        $this->model = $model;
    }

    /**
     * All
     * @return array
     */
    public function paginate()
    {
        return $this->model->all();
    }

    /**
     * Find
     * @param int $id
     * @return array
     */
    public function find($id)
    {
        return $this->model->find($id);
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
        $model = $this->model->find($id);
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
}
