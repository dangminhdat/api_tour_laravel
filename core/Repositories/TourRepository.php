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

            $tours[$key]['detail'] = $detail;
            $tours[$key]['location'] = $location;
            $tours[$key]['guide'] = $guide;
            $tours[$key]['hotel'] = $hotel;
            unset($tours[$key]['detail_tour']);
        }
        return $tours;
    }

    public function find($id)
    {
        $review = $this->model->where(["deleted_at" => 0, "id" => $id])->first();
       
        return $review;
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
                if (!$check->deleted_at && $check->id === $id)
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

            $tours[$key]['detail'] = $detail;
            $tours[$key]['location'] = $location;
            $tours[$key]['guide'] = $guide;
            $tours[$key]['hotel'] = $hotel;
            unset($tours[$key]['detail_tour']);
            unset($tours[$key]['deleted_at']);
        }
        return $tours;
    }
}