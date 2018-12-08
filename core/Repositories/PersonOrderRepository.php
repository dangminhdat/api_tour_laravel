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
    	$person = $this->model->where(['deleted_at' => 0, 'id_user' => $id])->orderBy('id', 'DESC')->get();
        foreach ($person as $key => $value) {
            $details = $value->detail_tour;
            $tour = $details->tour;
            if ($details->deleted_at) {
                unset($person[$key]);
                continue;
            }
            $sum = $details->price_childs * $value->num_childs + $details->price_adults * $value->num_adults;
            unset($person[$key]->deleted_at);
            unset($person[$key]->deleted_at);
            unset($person[$key]->id_detail_tour);
            unset($person[$key]->id_user);
        	unset($person[$key]->detail_tour);
            $person[$key]['name_tour'] = $tour->name;
            $person[$key]['price_total'] = $sum;
            $person[$key]['discount'] = $tour->discount;
            $person[$key]['total'] = $sum - $sum * $tour->discount / 100;
        }
        return $person;
    }
}