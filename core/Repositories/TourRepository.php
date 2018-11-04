<?php

namespace Core\Repositories;

use App\Tour;

class TourRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Tour $model)
    {
        $this->model = $model;
    }

    public function paginate()
    {
        $tours = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($tours as $key => $tour) {
            $details = $tour->detail_tour->first();
            $type = $tour->type_tour->name;
            if (!$details) {
                unset($tours[$key]);
                continue;
            } 
            unset($tours[$key]['id_type_tour']);
            unset($tours[$key]['type_tour']);
            unset($tours[$key]['programs']);
            unset($tours[$key]['note']);
            unset($tours[$key]['detail_tour']);
            unset($tours[$key]['date_created']);
            unset($tours[$key]['deleted_at']);
            $tours[$key]['date_depart'] = $details->date_depart;
            $tours[$key]['price_adults'] = $details->price_adults;
            $tours[$key]['price_childs'] = $details->price_childs;
            $tours[$key]['time_depart'] = $details->time_depart;
            $tours[$key]['slot'] = $details->slot;
            $tours[$key]['type_tour'] = $type;
        }
        return $tours;
    }

    public function find($id){}

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
        $model = $this->model->find($id);
        return $model->destroy($id);
    }

    public function findWhere($condition)
    {
        $model = $this->model->where($condition);
        return $model->first();
    }

    public function tour_by_location($id)
    {
        $result = array();
        $tours = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($tours as $key => $tour) {
            $details = $tour->detail_tour->first();
            $type = $tour->type_tour->name;
            // get data by location
            $item = 0;
            $checks = $tour->location;
            
            foreach ($checks as $check) {
                if (!$check->deleted_at && $check->id == $id)
                {
                    break;
                }
                else
                {
                    $item++;
                }
            }
            if ($item === count($checks) || count($checks) === 0 || !$details) {
                unset($tours[$key]);
                continue;
            }
            unset($tours[$key]['location']);
            unset($tours[$key]['programs']);
            unset($tours[$key]['note']);
            unset($tours[$key]['detail_tour']);
            unset($tours[$key]['date_created']);
            unset($tours[$key]['deleted_at']);
            unset($tours[$key]['id_type_tour']);
            unset($tours[$key]['type_tour']);
            $tours[$key]['date_depart'] = $details->date_depart;
            $tours[$key]['price_adults'] = $details->price_adults;
            $tours[$key]['price_childs'] = $details->price_childs;
            $tours[$key]['time_depart'] = $details->time_depart;
            $tours[$key]['slot'] = $details->slot;
            $tours[$key]['type_tour'] = $type;
         
            $result[] = $tours[$key];
        }
        return $result;
    }

    public function tour_by_sales()
    {
        $resutl = array();
        $tours = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($tours as $key => $tour) {
            $details = $tour->detail_tour->first();
            $type = $tour->type_tour->name;
            if ($tour->discount === 0 || !$details) {
                unset($tours[$key]);
                continue;
            }
            unset($tours[$key]['programs']);
            unset($tours[$key]['note']);
            unset($tours[$key]['detail_tour']);
            unset($tours[$key]['date_created']);
            unset($tours[$key]['deleted_at']);
            unset($tours[$key]['id_type_tour']);
            unset($tours[$key]['type_tour']);
            $tours[$key]['date_depart'] = $details->date_depart;
            $tours[$key]['price_adults'] = $details->price_adults;
            $tours[$key]['price_childs'] = $details->price_childs;
            $tours[$key]['time_depart'] = $details->time_depart;
            $tours[$key]['slot'] = $details->slot;
            $tours[$key]['type_tour'] = $type;


            $result[] = $tours[$key];
        }
        return $result;
    }

    public function tour_of_type($id)
    {
        $resutl = array();
        $tours = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($tours as $key => $tour) {
            if ($tour->id_type_tour != $id) {
                unset($tours[$key]);
                continue;
            }
            $details = $tour->detail_tour->first();
            $type = $tour->type_tour->name;
            if (!$details) {
                unset($tours[$key]);
                continue;
            }
            unset($tours[$key]['programs']);
            unset($tours[$key]['note']);
            unset($tours[$key]['detail_tour']);
            unset($tours[$key]['date_created']);
            unset($tours[$key]['deleted_at']);
            unset($tours[$key]['id_type_tour']);
            unset($tours[$key]['type_tour']);
            $tours[$key]['date_depart'] = $details->date_depart;
            $tours[$key]['price_adults'] = $details->price_adults;
            $tours[$key]['price_childs'] = $details->price_childs;
            $tours[$key]['time_depart'] = $details->time_depart;
            $tours[$key]['slot'] = $details->slot;
            $tours[$key]['type_tour'] = $type;

            $result[] = $tours[$key];
        }
        return $result;
    }
}