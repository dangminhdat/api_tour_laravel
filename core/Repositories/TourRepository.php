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
        $check = false;
        $tours = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($tours as $key => $tour) {
            $details = $tour->detail_tour;
            // print_r($details);exit;
            foreach ($details as $k => $v) {
                if (!$v->deleted_at) {
                    $check = true;
                    $details = $v;
                    break;
                }
            }
            $type = $tour->type_tour->id;
            $details = $details->first();
            unset($tours[$key]['id_type_tour']);
            unset($tours[$key]['type_tour']);
            unset($tours[$key]['programs']);
            unset($tours[$key]['note']);
            unset($tours[$key]['detail_tour']);
            unset($tours[$key]['date_created']);
            unset($tours[$key]['deleted_at']);
            if (!$details || !$check) {
                $tours[$key]['id_detail'] = null;
                $tours[$key]['date_depart'] = null;
                $tours[$key]['price_adults'] = 0;
                $tours[$key]['price_childs'] = 0;
                $tours[$key]['time_depart'] = null;
                $tours[$key]['slot'] = 0;
                $tours[$key]['booked'] = 0;
                $tours[$key]['id_type_tour'] = $type;
                continue;
            } 
            $tours[$key]['id_detail'] = $details->id;
            $tours[$key]['date_depart'] = $details->date_depart;
            $tours[$key]['price_adults'] = $details->price_adults;
            $tours[$key]['price_childs'] = $details->price_childs;
            $tours[$key]['time_depart'] = $details->time_depart;
            $tours[$key]['slot'] = $details->slot;
            $tours[$key]['booked'] = $details->booked;
            $tours[$key]['id_type_tour'] = $type;
        }
        return $tours;
    }

    public function find($id)
    {
        $tour = $this->model->where(['deleted_at' => false, 'id' => $id])->first();
        return $tour;
    }

    public function store($data)
    {
        // $upload = public_path()."/uploads/";
        // if(!is_dir($upload)) {
        //     mkdir($upload);
        // }
        // $ext = $data['images']->getClientOriginalExtension('images');
        // $name   = str_slug($data['name'],'-')."-".date("Y-m-d-H-i-s").'.'.$ext;
        // $data['images']->move($upload, $name);
        // $result = [
        //     'name'          => $data['name'],
        //     'number_days'   => $data['number_days'],
        //     'item_tour'     => $data['item_tour'],
        //     'date_created'  => $data['date_created'],
        //     'discount'      => $data['discount'],
        //     'programs'      => $data['programs'],
        //     'note'          => $data['note'],
        //     'id_type_tour'  => $data['id_type_tour'],
        //     'images'        => "/uploads/".$name
        // ];
        // if ($data['images']->isValid('images')) {
        //     return false;
        // }
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $model = $this->model->where(["deleted_at" => 0, "id" => $id]);
        return $model->update($data);
    }

    public function destroy($id)
    {
        $model = $this->model->where(["deleted_at" => 0, "id" => $id])->first();
        if (!$model) return false;
        $details = $model->detail_tour;
        foreach ($details as $key => $value) {
            $details[$key]->update(['deleted_at' => true ]);
        }
        return $model->update(['deleted_at' => true ]);
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
            $type = $tour->type_tour->id;
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
            $tours[$key]['id_detail'] = $details->id;
            $tours[$key]['date_depart'] = $details->date_depart;
            $tours[$key]['price_adults'] = $details->price_adults;
            $tours[$key]['price_childs'] = $details->price_childs;
            $tours[$key]['time_depart'] = $details->time_depart;
            $tours[$key]['slot'] = $details->slot;
            $tours[$key]['booked'] = $details->booked;
            $tours[$key]['id_type_tour'] = $type;
         
            $result[] = $tours[$key];
        }
        return $result;
    }

    public function tour_by_sales()
    {
        $result = array();
        $tours = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($tours as $key => $tour) {
            $details = $tour->detail_tour->first();
            $type = $tour->type_tour->id;
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
            $tours[$key]['id_detail'] = $details->id;
            $tours[$key]['date_depart'] = $details->date_depart;
            $tours[$key]['price_adults'] = $details->price_adults;
            $tours[$key]['price_childs'] = $details->price_childs;
            $tours[$key]['time_depart'] = $details->time_depart;
            $tours[$key]['slot'] = $details->slot;
            $tours[$key]['booked'] = $details->booked;
            $tours[$key]['id_type_tour'] = $type;


            $result[] = $tours[$key];
        }
        return $result;
    }

    public function tour_of_type($id)
    {
        $result = array();
        $tours = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($tours as $key => $tour) {
            if ($tour->id_type_tour != $id) {
                unset($tours[$key]);
                continue;
            }
            $details = $tour->detail_tour->first();
            $type = $tour->type_tour->id;
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
            $tours[$key]['id_detail'] = $details->id;
            $tours[$key]['date_depart'] = $details->date_depart;
            $tours[$key]['price_adults'] = $details->price_adults;
            $tours[$key]['price_childs'] = $details->price_childs;
            $tours[$key]['time_depart'] = $details->time_depart;
            $tours[$key]['slot'] = $details->slot;
            $tours[$key]['booked'] = $details->booked;
            $tours[$key]['id_type_tour'] = $type;

            $result[] = $tours[$key];
        }
        return $result;
    }

    public function updateTour($id, $data)
    {
        $result = array();
        if (isset($data['images'])) {
            $upload = public_path()."/uploads/";
            if(!is_dir($upload)) {
                mkdir($upload);
            }
            $ext = $data['images']->getClientOriginalExtension('images');
            $name = str_slug($data['name'],'-')."-".date("Y-m-d-H-i-s").'.'.$ext;
            $data['images']->move($upload, $name);
            $result["images"] = "/uploads/".$name;   
            if ($data['images']->isValid('images')) {
                return false;
            }
        }
        
        $result["name"] = $data['name'];
        $result["number_days"] = $data['number_days'];
        $result["item_tour"] = $data['item_tour'];
        $result["discount"] = $data['discount'];
        $result["programs"] = $data['programs'];
        $result["note"] = $data['note'];
        $result["id_type_tour"] = $data['id_type_tour'];

        $model = $this->model->where(["deleted_at" => 0, "id" => $id]);
        return $model->update($result);
    }

    public function find_tour_detail($id)
    {
        $result = array();
        $tour = $this->model->where(["id" => $id, "deleted_at" => false ])->first();
        foreach ($tour->detail_tour as $key => $details) {
            if ($details->deleted_at) {
                continue;
            }
            $detail = array();
            $hotel = array();
            $guide = $details->guide;

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

            $detail['guide'] = $guide;
            $detail['hotel'] = $hotel;

            $result[] = $detail;
        }
        return array_reverse($result);
    }

    public function upload_image($data)
    {
        $upload = public_path()."/uploads/";
        if(!is_dir($upload)) {
            mkdir($upload);
        }
        $ext = explode('.',$data['images']['name']);
        $ext = $ext[count($ext) - 1];
        $tmp = $data['images']['tmp_name'];
        $name = uniqid()."-".date("Y-m-d-H-i-s").'.'.$ext;
        if(@move_uploaded_file($tmp, $upload.$name)) {
            return "/uploads/".$name;
        }
        return false;
    }

    public function five_tour_latest()
    {
        $check = false;
        $tours = $this->model->where(["deleted_at" => 0])->orderBy('id', 'DESC')->get();
        foreach ($tours as $key => $tour) {
            $details = $tour->detail_tour;
            // print_r($details);exit;
            foreach ($details as $k => $v) {
                if (!$v->deleted_at) {
                    $check = true;
                    $details = $v;
                    break;
                }
            }
            $type = $tour->type_tour->id;
            $details = $details->first();
            unset($tours[$key]['id_type_tour']);
            unset($tours[$key]['type_tour']);
            unset($tours[$key]['programs']);
            unset($tours[$key]['note']);
            unset($tours[$key]['detail_tour']);
            unset($tours[$key]['date_created']);
            unset($tours[$key]['deleted_at']);
            if (!$details || !$check) {
                unset($tours[$key]);
                continue;
            } 
            $tours[$key]['id_detail'] = $details->id;
            $tours[$key]['date_depart'] = $details->date_depart;
            $tours[$key]['price_adults'] = $details->price_adults;
            $tours[$key]['price_childs'] = $details->price_childs;
            $tours[$key]['time_depart'] = $details->time_depart;
            $tours[$key]['slot'] = $details->slot;
            $tours[$key]['booked'] = $details->booked;
            $tours[$key]['id_type_tour'] = $type;
        }
        if (count($tours->toArray()) > 5) {
            $tours = array_slice($tours->toArray(), 0, 5);
        }
        return $tours;
    }

    public function search_tour($data)
    {
        $date = array();
        $result = array();
        $location = array();
        $tours = $this->model->where(['deleted_at' => 0])->get();
        foreach ($tours as $key => $tour) {
            $details = $tour->detail_tour;
            if (!$details) {
                continue;
            }
            
            if (isset($data['date'])) {
                foreach ($details as $d => $detail) {
                    if (strtotime($detail->date_depart) == strtotime($data['date'])) {
                        $type = $tour->type_tour->id;
                        unset($tours[$key]['id_type_tour']);
                        unset($tours[$key]['type_tour']);
                        unset($tours[$key]['programs']);
                        unset($tours[$key]['note']);
                        unset($tours[$key]['detail_tour']);
                        unset($tours[$key]['date_created']);
                        unset($tours[$key]['deleted_at']);
                        $tours[$key]['id_detail'] = $detail->id;
                        $tours[$key]['date_depart'] = $detail->date_depart;
                        $tours[$key]['price_adults'] = $detail->price_adults;
                        $tours[$key]['price_childs'] = $detail->price_childs;
                        $tours[$key]['time_depart'] = $detail->time_depart;
                        $tours[$key]['slot'] = $detail->slot;
                        $tours[$key]['booked'] = $detail->booked;
                        $tours[$key]['id_type_tour'] = $type;

                        $date[] = $tours[$key];
                        break;
                    }
                }
            }

             // location
            if (isset($data['location'])) {
                foreach ($tour->location as $locations) {
                    if (!$locations->deleted_at && $data['location'] == $locations->id) {
                        $detail = $tour->detail_tour->first();
                        $type = $tour->type_tour->id;
                        unset($tours[$key]['id_type_tour']);
                        unset($tours[$key]['type_tour']);
                        unset($tours[$key]['programs']);
                        unset($tours[$key]['note']);
                        unset($tours[$key]['detail_tour']);
                        unset($tours[$key]['date_created']);
                        unset($tours[$key]['deleted_at']);
                        unset($tours[$key]['location']);
                        $tours[$key]['id_detail'] = $detail->id;
                        $tours[$key]['date_depart'] = $detail->date_depart;
                        $tours[$key]['price_adults'] = $detail->price_adults;
                        $tours[$key]['price_childs'] = $detail->price_childs;
                        $tours[$key]['time_depart'] = $detail->time_depart;
                        $tours[$key]['slot'] = $detail->slot;
                        $tours[$key]['booked'] = $detail->booked;
                        $tours[$key]['id_type_tour'] = $type;

                        $location[] = $tours[$key];
                        break;
                    }
                }
            }
        }
        if (isset($data['location']) && isset($data['date'])) {
            $result = array_intersect_assoc($date,$location);
        }

        if (isset($data['location']) && !isset($data['date'])) {
            $result = $location;
        }

        if (!isset($data['location']) && isset($data['date'])) {
            $result = $date;
        }
        @usort($result, function ($a, $b) {
            // if ($a['booked'] == $b['booked']) return 0;
            return $a['id'] < $b['id'];
        });
        return $result;
    }
}