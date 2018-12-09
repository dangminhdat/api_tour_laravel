<?php

namespace Core\Repositories;

use App\TypeTour;

/**
 * Class TypeTourRepository
 */
class TypeTourRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * [__construct description]
     * @param TypeTour $model [description]
     */
    public function __construct(TypeTour $model)
    {
        $this->model = $model;
    }

    /**
     * ALl
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
     * Updates
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
