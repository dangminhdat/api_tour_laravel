<?php

namespace Core\Repositories;

use App\PersonOrder;

/**
 * Class PersonOrderRepository
 */
class PersonOrderRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * [__construct description]
     * @param PersonOrder $model [description]
     */
    public function __construct(PersonOrder $model)
    {
        $this->model = $model;
    }

    /**
     * All
     * @return array
     */
    public function paginate()
    {
        $person = $this->model->where(['deleted_at' => 0])->orderBy('id', 'DESC')->get();
        foreach ($person as $key => $value) {
        	unset($person[$key]->deleted_at);
        }
        return $person;
    }

    /**
     * Find
     * @param int $id
     * @return array
     */
    public function find($id)
    {
    	$person = $this->model->where(['deleted_at' => 0, 'id' => $id])->first();
    	unset($person->deleted_at);
        return $person;
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
        $model = $this->model->where(['id' => $id, 'deleted_at' => 0, 'status' => 1]);
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
     * Select tour order of user
     * @param int $id
     * @return array
     */
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
