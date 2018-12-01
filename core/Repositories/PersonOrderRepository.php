<?php

namespace Core\Repositories;

use App\PersonOrder;

class PersonOrderRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(PersonOrder $model)
    {
        $this->model = $model;
    }

    public function paginate()
    {
        $person = $this->model->where(['deleted_at' => 0])->orderBy('id', 'DESC')->get();
        foreach ($person as $key => $value) {
        	unset($person[$key]->deleted_at);
        }
        return $person;
    }

    public function find($id)
    {
    	$person = $this->model->where(['deleted_at' => 0, 'id' => $id])->first();
    	unset($person->deleted_at);
        return $person;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $model = $this->model->where(['id' => $id, 'deleted_at' => 0, 'status' => 1]);
        return $model->update($data);
    }

    public function destroy($id)
    {
        $model = $this->model->find($id);
        return $model->destroy($id);
    }

    public function get_tour_of_user($id)
    {
    	$person = $this->model->where(['id_user' => $id])->orderBy('id', 'DESC')->get();
        foreach ($person as $key => $value) {
        	unset($person[$key]->deleted_at);
        }
        return $person;
    }
}