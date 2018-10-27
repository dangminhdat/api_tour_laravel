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
        $tours = $this->model->where(["deleted_at" => 0])->get();
        foreach ($tours as $key => $tour) {
            $details = $tour->detail_tour;
            $tours[$key]['date_depart'] = $details->date_depart;
            $tours[$key]['price_adults'] = $details->price_adults;
            $tours[$key]['price_childs'] = $details->price_childs;
            $tours[$key]['time_depart'] = $details->time_depart;
            $tours[$key]['slot'] = $details->slot;
            unset($tours[$key]['programs']);
            unset($tours[$key]['note']);
            unset($tours[$key]['detail_tour']);
            unset($tours[$key]['date_created']);
            unset($tours[$key]['deleted_at']);
        }
        return $tours;
    }

    public function find($id)
    {
        $tour = $this->model->where(["deleted_at" => 0, "id" => $id])->first();
        $location = array();
        $hotel = array();
        $details = $tour->detail_tour;
        $guide = $details->guide;
        // guide
        if ($guide->deleted_at) {
            $guide = null;
        } else {
            unset($guide->deleted_at);
        }
        // hotel
        foreach ($details->hotel as $detailH) {
            if (!$detailH->deleted_at) {
                $arr = array();
                $arr['id'] = $detailH->id;
                $arr['name'] = $detailH->name;
                $arr['price_room'] = $detailH->price_room;
                $arr['address'] = $detailH->address;
                $arr['phone'] = $detailH->phone;
                $arr['website'] = $detailH->website;
                $hotel[] = $arr;
            }
        }
        // location
        foreach ($details->location as $detailL) {
            if (!$detailL->deleted_at) {
                $arr = array();
                $arr['id'] = $detailL->id;
                $arr['name'] = $detailL->name;
                $location[] = $arr;
            }
        }
        // detail
        $detail['id'] = $details->id;
        $detail['date_depart'] = $details->date_depart;
        $detail['price_adults'] = $details->price_adults;
        $detail['time_depart'] = $details->time_depart;
        $detail['address_depart'] = $details->address_depart;
        $detail['slot'] = $details->slot;

        // image
        $image = 'url';

        $tour['detail'] = $detail;
        $tour['location'] = $location;
        $tour['guide'] = $guide;
        $tour['hotel'] = $hotel;
        unset($tour['detail_tour']);
        return $tour;
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
        $tours = $this->model->where(["deleted_at" => 0])->get();
        foreach ($tours as $key => $tour) {
            $details = $tour->detail_tour;
            // get data by location
            $item = 0;
            $checks = $details->location;
            
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
            if ($item === count($checks) || count($checks) === 0) {
                unset($tours[$key]);
                continue;
            }
            $details = $tour->detail_tour;
            $tours[$key]['date_depart'] = $details->date_depart;
            $tours[$key]['price_adults'] = $details->price_adults;
            $tours[$key]['price_childs'] = $details->price_childs;
            $tours[$key]['time_depart'] = $details->time_depart;
            $tours[$key]['slot'] = $details->slot;
            unset($tours[$key]['programs']);
            unset($tours[$key]['note']);
            unset($tours[$key]['detail_tour']);
            unset($tours[$key]['date_created']);
            unset($tours[$key]['deleted_at']);
        }
        return $tours;
    }

    public function tour_by_sales()
    {
        $tours = $this->model->where(["deleted_at" => 0])->get();
        foreach ($tours as $key => $tour) {
            if ($tour->discount === 0) {
                unset($tours[$key]);
                continue;
            }
            $details = $tour->detail_tour;
            $tours[$key]['date_depart'] = $details->date_depart;
            $tours[$key]['price_adults'] = $details->price_adults;
            $tours[$key]['price_childs'] = $details->price_childs;
            $tours[$key]['time_depart'] = $details->time_depart;
            $tours[$key]['slot'] = $details->slot;
            unset($tours[$key]['programs']);
            unset($tours[$key]['note']);
            unset($tours[$key]['detail_tour']);
            unset($tours[$key]['date_created']);
            unset($tours[$key]['deleted_at']);
        }
        return $tours;
    }

    public function tour_of_type($id)
    {
        $tours = $this->model->where(["deleted_at" => 0])->get();
        foreach ($tours as $key => $tour) {
            $details = $tour->detail_tour;
            if ($details->id_type_tour != $id) {
                unset($tours[$key]);
                continue;
            }
            $details = $tour->detail_tour;
            $tours[$key]['date_depart'] = $details->date_depart;
            $tours[$key]['price_adults'] = $details->price_adults;
            $tours[$key]['price_childs'] = $details->price_childs;
            $tours[$key]['time_depart'] = $details->time_depart;
            $tours[$key]['slot'] = $details->slot;
            unset($tours[$key]['programs']);
            unset($tours[$key]['note']);
            unset($tours[$key]['detail_tour']);
            unset($tours[$key]['date_created']);
            unset($tours[$key]['deleted_at']);
        }
        return $tours;
    }
}