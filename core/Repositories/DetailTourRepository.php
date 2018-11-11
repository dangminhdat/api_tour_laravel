<?php

namespace Core\Repositories;

use App\DetailTour;

class DetailTourRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(DetailTour $model)
    {
        $this->model = $model;
    }

    public function paginate()
    {
        
    }

    public function find($id)
    {
        $details = $this->model->where(["deleted_at" => 0, "id" => $id])->first();
        $location = array();
        $hotel = array();
        $tour = $details->tour;
        $type = $tour->type_tour->id;
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
        foreach ($tour->location as $detailL) {
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
        $detail['price_childs'] = $details->price_childs;
        $detail['time_depart'] = $details->time_depart;
        $detail['address_depart'] = $details->address_depart;
        $detail['slot'] = $details->slot;
        $detail['booked'] = $details->booked;

        // image
        $image = 'url';

        unset($tour['detail_tour']);
        unset($tour['location']);
        unset($tour['deleted_at']);
        unset($tour['id_type_tour']);
        unset($tour['type_tour']);
        $tour['id_type_tour'] = $type;
        $tour['detail'] = $detail;
        $tour['location'] = $location;
        $tour['guide'] = $guide;
        $tour['hotel'] = $hotel;
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

    public function detail_day_other($id)
    {
    	$result = array();
        $details = $this->model->where(["deleted_at" => 0, "id" => $id])->first();
        $detail = $details->tour->detail_tour;
        foreach ($detail as $key => $detailC) {
        	$hotel = array();
        	$hotels = $detailC->hotel;
        	$guide = $details->guide;
	        // guide
	        if ($detailC->id == $id || !$hotels || !$guide || $guide->deleted_at) {
	            continue;
	        } else {
	            unset($guide->deleted_at);
	        }
        	foreach ($hotels as $detailH) {
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
        	unset($detail[$key]['deleted_at']);
        	unset($detail[$key]['id_image']);
        	unset($detail[$key]['id_guide']);
        	unset($detail[$key]['id_hotel']);
        	unset($detail[$key]['id_tour']);
        	unset($detail[$key]['hotel']);

        	$detail[$key]['guide'] = $guide;
        	$detail[$key]['hotel'] = $hotel;

        	$result[] = $detail[$key];
        }
    	return $result;
    }
}