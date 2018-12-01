<?php

namespace Core\Repositories;

use App\Location;

class LocationRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Location $model)
    {
        $this->model = $model;
    }

    public function paginate()
    {
        $locations = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($locations as $s => $location) {
        	unset($locations[$s]['deleted_at']);
        }
        return $locations;
    }

    public function find($id)
    {
        $location = $this->model->where(["deleted_at" => 0, "id" => $id])->first();
        unset($location['deleted_at']);
        return $location;
    }

    public function store($data)
    {
        $upload = public_path()."/uploads/";
        if(!is_dir($upload)) {
            mkdir($upload);
        }
        $ext = $data['image']->getClientOriginalExtension('image');
        $name   = str_slug($data['name'],'-')."-".date("Y-m-d-H-i-s").'.'.$ext;
        $data['image']->move($upload, $name);
        $result = [
            'name'  => $data['name'],
            'image' => "/uploads/".$name
        ];
        if ($data['image']->isValid('image')) {
            return false;
        }
        return $this->model->create($result);
    }

    public function update($id, $data)
    {
        $model = $this->model->where(["id" => $id, "deleted_at" => false]);
        return $model->update($data);
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

    public function updateLocation($id, $data)
    {
        $result = array();
        if (isset($data['image'])) {
            $upload = public_path()."/uploads/";
            if(!is_dir($upload)) {
                mkdir($upload);
            }
            $ext = $data['image']->getClientOriginalExtension('image');
            $name   = str_slug($data['name'],'-')."-".date("Y-m-d-H-i-s").'.'.$ext;
            $data['image']->move($upload, $name);
            $result["image"] = "/uploads/".$name;   
            if ($data['image']->isValid('image')) {
                return false;
            }
        }
        
        $result['name'] = $data['name'];

        $model = $this->model->where(["deleted_at" => 0, "id" => $id]);
        return $model->update($result);
    }

    public function favorite_four_location()
    {
        $locations = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($locations as $s => $location) {
            $booked = 0;
            $tour = $location->tour;
            foreach ($tour as $key => $value) {
                $details = $tour[$key]->detail_tour;
                foreach ($details as $k => $v) {
                   $booked += $v->booked;
                }
            }
            unset($locations[$s]['deleted_at']);
            unset($locations[$s]['tour']);
            $locations[$s]['booked'] = $booked;
        }
        $loca = $locations->toArray();
        @usort($loca, function ($a, $b) {
            // if ($a['booked'] == $b['booked']) return 0;
            return $a['booked'] < $b['booked'];
        });
        if (count($loca) > 4) {
            $loca = array_slice($loca, 0, 5);
        }
        return $loca;
    }
}